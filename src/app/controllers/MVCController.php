<?php
namespace App\Controller;

include __DIR__ . "/../utils/queryParams.php";

use App\Modal\MVCModal;
use App\Abstraction\View;
use App\Util\Image;

class MVCController{

    public function __construct(protected $mvcModal = new MVCModal() ){

    }
    public function index(): View{
        $title = 'MVC Project';
        $runString = "Note: This website is a live demo designed to showcase the benefits of implementing the Model-View-Controller (MVC) architectural pattern in our development process.";
        return  View::make('index', ['pageTitle'=>"$title", 'run_string' =>$runString]);
    }
    public function posts():View{
        $search = $_GET[SEARCH] ?? "";
        $posts = $this->mvcModal->getBySearch($search);
        if($posts['status'] == 'error'){
             echo 'something wrong';
            exit;
        }
        $title = "Explore ". count($posts['data']) . " post(s)";
        $marquee = "Test THE CRUD between Modal and View which is controlled by controller";
        if(isset($_GET[ID]) && isset($_GET[ACTION_POST])){
            $title = 'post id:' . $_GET['id'];
            if ($_GET[ACTION_POST] == 'edit'){
                $title = "Editing " . $title;
                $marquee = "Whatever you want to edit, you don't do SQL Injection, right? right?...";
            }
            if($_GET[ACTION_POST] == 'delete'){
                $title = "Deleting ".$title;
                $marquee = "Oh that not important!!!!. Remember you can't take it back:)";
            }
        }
        return View::make('posts', ['posts' => $posts['data'], 'pageTitle' => $title, 'run_string' => $marquee]);
    }
    public function create():View{
        $title = "What is your posts?";
        return View::make('create', ['pageTitle' => $title,'run_string' => 'Give us your Picture and describe your feeling, we here to listen!']);
    }
    public function store(){
        $data = $_POST;
        $fileName = Image::create($_FILES[IMAGE] ?? []);
        if(boolval($fileName)){
            $data[IMAGE] = $fileName;
        }
        $post = $this->mvcModal->add($data);
        var_dump($post);
        var_dump($_FILES[IMAGE]);
        if($post['status'] == 'success'){
            $alert['status'] = 'success';
            $alert['title'] = 'Successfully';
            $alert['description'] = 'You have successfully added the product with heading: ' . $data[HEADING];
        }else{
            $alert['status'] = 'warning';
            $alert['title'] = 'Opp!';
            $alert['description'] = 'Ensure you have correctly input the form!';
        }
        setcookie(ALERT, serialize($alert), time() + 1);
        header('location:' . $_SERVER['HTTP_REFERER']);
    }

    public function update(){
        $data = $_POST;
        $oldData = $this->mvcModal->get($data[ID])['data'];
        if(!$oldData){
            echo 'fuck';
            exit;
        }

        if(isset($_FILES[IMAGE]) && file_exists($_FILES[IMAGE]['tmp_name'])){
            $fileName = Image::update($oldData[IMAGE], $_FILES[IMAGE] ?? []);
            if(boolval($fileName)){
                $data[IMAGE] = $fileName;
            }
        }

        $post = $this->mvcModal->patch($data);
        header('location:' . removeParamsWithoutURI($_SERVER['HTTP_REFERER'], [ID, ACTION_POST]));
    }
    public function remove(){
        $id = $_POST[ID] ?? "";

        $originalPost = $this->mvcModal->get($id)['data'];
        if($originalPost){
            var_dump('yes');
            Image::delete($originalPost[IMAGE]);
        }
        $data = $this->mvcModal->delete($_POST);
        if($data['status'] == 'error'){
            exit;
        }
        header('location:' . removeParamsWithoutURI($_SERVER['HTTP_REFERER'], [ID, ACTION_POST]));
    }
}
