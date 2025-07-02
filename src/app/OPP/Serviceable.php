<?php 

namespace App\OPP;

interface Serviceable 
{
    public function performService();
    public function getServiceCost();
}