<?php 

declare(strict_types=1);

namespace App\PaymentGateway\Paddle;

use App\Enums\Status;
use App\Notification\Email;


// Import the Transaction class from the Stripe namespace and alias it as StripeTransaction
use PaymentGateway\Stripe\Transaction as StripeTransaction;

class Transaction {

    public static int $count = 0;
    private static int $count2 = 0;

    //private string $status = 'pending';
    private string $status;

    public function __construct(
        public float $amount, 
        public string $description
    )
    {
        $this->setStatus(Status::PENDING);

        self::$count++;
        self::$count2++;

        var_dump(new CustomerProfile());
        echo '<br>';
        var_dump(new Email());
        echo '<br>';

        /**
         * Dumps the result of exploding a comma-separated string using the explode() function.
         *
         * The backslash (\) before 'explode' is used to reference the global PHP function,
         * ensuring that the global 'explode' function is called even if there is a namespaced
         * function with the same name. This avoids potential naming conflicts within namespaces.
         *
         * @see https://www.php.net/manual/en/function.explode.php
         */
        var_dump(\explode(',','hello , world'));
        echo '<br>';

        var_dump(Status::DECLINED);
        echo '<br>';
    }

    public function setStatus(string $status): self
    {
        if(! isset(Status::ALL_STATUS[$status])) {
            throw new \InvalidArgumentException('Invalid status');
        }
        $this->status = $status;

        return $this;
    }

    public static function getCount(): int {
        // $this->amount; You cannot use $this in a static method context.
        return self::$count2;
    }

    public function process()
    {
        /**
         * Uses array_map with a static anonymous function (closure).
         *
         * The `static` keyword in the closure prevents access to the `$this` variable from the parent scope.
         * This means that `$this` cannot be used inside the closure, which is useful for callbacks or static contexts
         * where instance context is not needed or should not be accessed.
         *
         * In this example, attempting to assign `$this->amount = 35;` inside the static closure will result in an error,
         * because `$this` is not available. This helps to avoid accidental use of instance properties or methods
         * within static callbacks.
         */
        // array_map(static function(){
        //     $this->amount = 35;
        // }, [1]);

        echo "Processing paddle transaction....";
    }

}