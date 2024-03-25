<?php


require __DIR__.'/vendor/autoload.php';
try{
    session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

define("VIEW_PATH", __DIR__ . '/app/views');
define("IMAGE_PATH", __DIR__ . '/app/assets/public/images');
//define prevent Magic string
define("PAGINATION", 'paginationPage');
define("SEARCH", 'search');
define("ACTION_POST", 'action_post');
//services columns
define("HEADING", 'heading');
define("DESCRIPTION", 'description');
define("IMAGE", 'image');
define("ID", 'id');
define("ALERT", 'user_action_alert');



$router = new App\Abstraction\Router();

    $router
        ->get("/", [App\Controller\MVCController::class, 'index'])
        ->get('/posts/create', [App\Controller\MVCController::class, 'create'])
        ->post('/create', [App\Controller\MVCController::class, 'store'])
        ->post('/update', [App\Controller\MVCController::class, 'update'])
        ->post('/remove', [App\Controller\MVCController::class, 'remove'])
        ->get('/posts', [App\Controller\MVCController::class, 'posts']);
echo $router->resolve($_SERVER['REQUEST_URI'],strtolower($_SERVER['REQUEST_METHOD']));
    session_destroy();
}catch(App\Abstraction\Exception\RouteNotFoundException $e){
    header("HTTP/1.0 404 Not Found");
    echo App\Abstraction\View::make('errors/404', ['error' => $e, 'pageTitle' => "ERROR :)", 'run_string' => 'I guess, you do not need to go to network setting. Whatever the error is we just throw 404 status sorry:)']);
}
