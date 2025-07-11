<?php 

declare(strict_types=1);

namespace App\PaymentGateway\Stripe;

class Transaction {
    private float $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function process() {
        echo "Processing \${$this->amount} transaction <br/>";
    }

    // We can use the private property $amount here 
    //because $transaction is an instance of the same class (Transaction).
    // In PHP, private properties and methods are accessible within the same class, 
    // even from another instance.
    public function copyFrom(Transaction $transaction) {
        var_dump($transaction->amount);
    }
}