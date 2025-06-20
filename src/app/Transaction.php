<?php 

declare(strict_types=1);

namespace App;

class Transaction {
    // The first (commented-out) constructor uses traditional property declarations and assignments:
    // private float $amount;
    // private string $description;

    // public function __construct(float $amount, string $description)
    // {
    //     $this->amount = $amount;
    //     $this->description = $description;
    // }

    // The second (active) constructor uses PHP 8's constructor property promotion:
    public function __construct(
        private float $amount, 
        private string $description
    )   {
        // Properties are automatically declared and assigned
        echo $this->amount;
        echo '<br>';
        echo $amount;
        echo '<br>';
    }

    // Difference:
    // - The first style requires you to declare properties and assign them in the constructor.
    // - The second style (constructor property promotion) combines declaration and assignment in 
    //   the constructor parameters, making the code shorter and more readable.
    // ref : https://wiki.php.net/rfc/constructor_promotion

    /////////////////////////////////////////////////

    public function addTax(float $rate): Transaction{
        $this->amount += $this->amount * $rate / 100;

        return $this;
    }

    public function applyDiscount(float $rate): Transaction {
        $this->amount -= $this->amount * $rate / 100;

        return $this;
    }

    public function getAmount(): float {
        return $this->amount;
    }

    public function __destruct()
    {
        echo 'Destruct ' . $this->description . '<br>';
    }
}