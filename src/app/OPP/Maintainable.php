<?php 

namespace App\OPP;

interface Maintainable 
{
    public function performMaintenance();
    public function getMaintenanceStatus();
}