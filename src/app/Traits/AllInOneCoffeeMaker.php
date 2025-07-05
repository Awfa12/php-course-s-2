<?php

namespace App\Traits;

class AllInOneCoffeeMaker extends CoffeeMaker{
    use LatteTrait;
    use CappuccinoTrait {
        CappuccinoTrait::makeCappuccino as public;
    }

}

/* Traits :
* Method Precedence:
* If a class uses multiple traits that define the same method, the last trait used takes precedence.
* In this case, if both LatteTrait and CappuccinoTrait had a method named makeCoffee(), the one in CappuccinoTrait would be used.
*
* Conflict Resolution:
* If two traits define the same method, you can resolve the conflict by explicitly specifying which trait's method to use in the class.
* For example, if both LatteTrait and CappuccinoTrait had a method named makeCoffee(), you could use:
* class AllInOneCoffeeMaker extends CoffeeMaker {
*     use LatteTrait, CappuccinoTrait {
*         LatteTrait::makeCoffee insteadof CappuccinoTrait;
*     }
* }
* This would use the makeCoffee() method from LatteTrait, while still allowing you to use CappuccinoTrait's other methods.
* with Aliasing:
* You can also alias methods from traits to avoid conflicts. For example:
* class AllInOneCoffeeMaker extends CoffeeMaker {   
*     use LatteTrait, CappuccinoTrait {
*         CappuccinoTrait::makeCoffee as makeOriginalCappuccino;
*     }
* }
* This would allow you to call makeOriginalCappuccino() to use the method from CappuccinoTrait, while still having access to LatteTrait's methods.
*
*/