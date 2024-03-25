<?php
namespace App\Abstraction\Exception;
class ViewNotFoundException extends \Exception{
    protected $message = 'No File was found';
}
