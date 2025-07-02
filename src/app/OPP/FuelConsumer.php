<?php 

namespace App\OPP;

interface FuelConsumer 
{
    public function addFuel($amount);
    public function getFuelLevel();
    public function calculateFuelConsumption($distance);
}