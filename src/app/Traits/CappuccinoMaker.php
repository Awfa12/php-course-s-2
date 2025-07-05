<?php 

namespace App\Traits;

class CappuccinoMaker extends CoffeeMaker
{
    use CappuccinoTrait {
        CappuccinoTrait::makeCappuccino as public;
    }
      
}