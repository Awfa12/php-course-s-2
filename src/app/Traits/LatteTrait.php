<?php 


namespace App\Traits;

trait LatteTrait
{
    
    // If you need to use the properties from traits, you need to declare them in your class with the same value, type, and visibility.
    private string $latteType = "Regular Latte";

    public static string $milkType;

    public function makeLatte()
    {
        echo static::class . " is making latte with type: " . $this->latteType . "<br>";
    }  

    public function setLatteType(string $type): static
    {
        $this->latteType = $type;

        return $this;
    }
}