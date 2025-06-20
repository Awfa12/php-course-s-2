<?php 

declare(strict_types=1);

namespace App\PaymentGateway\Paddle;

use App\Notification\Email;


// Import the Transaction class from the Stripe namespace and alias it as StripeTransaction
use PaymentGateway\Stripe\Transaction as StripeTransaction;

class Transaction {

    public function __construct()
    {
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
    }

}