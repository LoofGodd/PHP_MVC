<?php
namespace App\Abstraction;

use App\Abstraction\Exception\ViewNotFoundException;

class View{
    public function __construct(protected $view, protected $params=[]){
    }
    public static function make(string $view, array $params=[]):static{
        return new static($view, $params);
    }
    public function render():string{
        $viewPath =VIEW_PATH . '/' . $this->view . '.php';
        if(! file_exists($viewPath)){
            throw new ViewNotFoundException();
        }
        extract($this->params);
        $contentView = VIEW_PATH . '/' .$this->view . ".php";
        ob_start();
        include VIEW_PATH . '/layout.php';
        return ob_get_clean();
    }
    public function __toString():string{
        return $this->render();
    }

}
