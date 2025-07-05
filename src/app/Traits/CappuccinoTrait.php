<?php 


namespace App\Traits;

trait CappuccinoTrait
{
    use LatteTrait; // Include LatteTrait to inherit its methods

    private function makeCappuccino()
    {
        echo static::class . " is making cappuccino" . "<br>";
    } 
}