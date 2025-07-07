<?php


namespace App\ErrorH;

class RouteNotFoundException extends \Exception
{
    protected $message = 'Error 404: The requested route was not found.';  

}