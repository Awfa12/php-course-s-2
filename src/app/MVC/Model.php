<?php 

namespace App\MVC;

use App\App;
use App\DB2;

abstract class Model 
{
    protected DB2 $db;
    public function __construct(){
        $this->db = App::db();
    }
    
}