<?php 

namespace App\MVC;

use App\App;
use App\DB;

abstract class Model 
{
    protected DB $db;
    public function __construct(){
        $this->db = App::db();
    }
    
}