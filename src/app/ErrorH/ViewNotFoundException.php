<?php


namespace App\ErrorH;

class ViewNotFoundException extends \Exception
{
    protected $message = 'Error 404: The requested view was not found.';  

}