<?php

declare(strict_types=1); // Enforce strict type checking

require_once '../app/Transaction.php'; // Include the Transaction class

// --- Classes & Objects ---

// Create a new Transaction object with amount 100 and description 'Transaction 1'
$transaction = new App\Transaction(100, 'Transaction 1');

// Add 8% tax to the transaction
$transaction->addTax(8);
// Apply a 10% discount to the transaction
$transaction->applyDiscount(10);

// Output the final amount after tax and discount
var_dump($transaction->getAmount());

echo '<br>';

// Create a new Transaction object and chain addTax and applyDiscount methods
$transaction1 = (new App\Transaction(100, 'Transaction 1'))
        ->addTax(8)
        ->applyDiscount(10);

// Create another Transaction object with different values and chain methods
$transaction2 = (new App\Transaction(200, 'Transaction 2'))
        ->addTax(8)
        ->applyDiscount(15);

// Output the final amounts for both transactions
var_dump($transaction1->getAmount(), $transaction2->getAmount());

echo '<br>';

// --- Working with JSON ---

// JSON string
$str = '{"a":1,"b":2,"c":3}';

// Decode JSON string to associative array
$arr = json_decode($str, true);

// Output the resulting array
var_dump($arr);

echo '<br>';

// --- Working with stdClass objects ---

// Create a new stdClass object
$obj = new \stdClass();

// Add properties to the object
$obj->a = 1;
$obj->b = 2;

// Output the object
var_dump($obj);

echo '<br>';

// --- Casting arrays to objects ---

// Create an indexed array
$arr2 = [1, 2, 3];
// Cast the array to an object
$obj2 = (object) $arr2;

// Access the property with key 1 (second element)
var_dump($obj2->{1});

echo '<br>';

// --- Casting scalars to objects ---

// Cast integer to object; value is stored in 'scalar' property
$obj3 = (object) 1;
var_dump($obj3->scalar);
echo '<br>';

// Cast boolean to object; value is stored in 'scalar' property
$obj4 = (object) false;
var_dump($obj4->scalar);
echo '<br>';

// Cast null to object; results in an empty object
$obj5 = (object) null;
var_dump($obj5);
echo '<br>';

///////////////////////////////////////////////////////

/**
 * Outputs the ID of the payment profile associated with the customer of a transaction.
 *
 * This line uses PHP's null-safe operator (`?->`) to safely access nested properties
 * without causing an error if any intermediate property is null. Specifically:
 * - `$transaction->customer?` checks if the `customer` property exists and is not null.
 * - If `customer` is not null, it then attempts to access `paymentProfile?`.
 * - If `paymentProfile` is also not null, it finally accesses the `id` property.
 * - If any of the properties in the chain (`customer` or `paymentProfile`) are null,
 *   the entire expression evaluates to null, and nothing is echoed.
 *
 * This approach prevents runtime errors that would occur if you tried to access a property
 * of a null object, making the code more robust and concise when dealing with potentially
 * missing or optional relationships in object hierarchies.
 */
// Null-safe Operator RFC - ref : https://wiki.php.net/rfc/nullsafe_operator
// echo $transaction->customer?->paymentProfile?->id;

/** 
 * - This line safely attempts to access the 'id' property of the payment profile 
 * associated with the customer of the transaction.
 * - The nullsafe operator (?->) ensures that if either getCustomer() 
 * or getPaymentProfile() returns null, no error is thrown and the result will be null.
 */
// echo $transaction->getCustomer()?->getPaymentProfile()?->id;

//////////////////////////////////////////////


/**
 * Registers an autoloader function for automatically including PHP class files.
 *
 * This autoloader converts a fully qualified class name (with namespaces) into a file path
 * relative to the project's source directory. It replaces namespace separators (`\`) with
 * directory separators (`/`), lowercases the first character of the class name, and appends
 * the `.php` extension. The resulting path is then required.
 *
 * Example:
 *   - Class name: App\PaymentGateway\Paddle\Transaction
 *   - File path: /path/to/project/app/PaymentGateway/Paddle/Transaction.php
 *
 * This allows you to use namespaces and class autoloading without manually including files.
 * 
 * manually including:
 * // require_once __DIR__ . '/../app/paymentGateway/Paddle/Transaction.php';
 * // require_once __DIR__ .'/../app/paymentGateway/Paddle/CustomerProfile.php';
 * // require_once __DIR__ .'/../app/paymentGateway/Stripe/Transaction.php';
 * // require_once __DIR__ .'/../app/Notification/Email.php';
 *
 * @param string $class The fully qualified class name to load.
 * @return void
 */
// spl_autoload_register(function ($class) {
//         //require $class; : output -> require(App\PaymentGateway\Paddle\Transaction)
//         $path = __DIR__ . '/../' . lcfirst(str_replace('\\', '/', $class)) . '.php';
//         // $path = /var/www/public/../app/PaymentGateway/Paddle/Transaction.php

//         if (file_exists($path)) {
//                 require $path;
//         }
// });


require __DIR__ . '/../vendor/autoload.php';



// Import the Transaction class from the Stripe namespace and alias it as StripeTransaction
use App\PaymentGateway\Stripe\Transaction as StripeTransaction;

/*
use PaymentGateway\Paddle\Transaction;
use PaymentGateway\Paddle\CustomerProfile;

    Importing Transaction and CustomerProfile classes from the 
    PaymentGateway\Paddle namespace for easier access and cleaner code.
*/
use App\PaymentGateway\Paddle\{Transaction, CustomerProfile};
// or
// use PaymentGateway\Paddle;
// $paddleTransaction = new Paddle\Transaction()
// $paddleCustomerProfile = new Paddle\CustomerProfile()

// Example: Importing a function from a namespace (if it exists)
// use function SomeNamespace\someFunction;

// Example: Importing a constant from a namespace (if it exists)
// use const SomeNamespace\SOME_CONSTANT;

// In this file, we are importing the Transaction class from the Stripe namespace:
// use PaymentGateway\Stripe\Transaction; // Already imported above

// Now you can use Transaction directly instead of the fully qualified name
// Example:
$transactionExample = new Transaction();
var_dump($transactionExample); // Outputs an instance of PaymentGateway\Stripe\Transaction

echo '<br>';

//var_dump(new PaymentGateway\Stripe\Transaction()); //with the (use) we can make it simple
var_dump(new Transaction());

echo '<br>';

/////////////////////////////////////////////////

$paddleTransaction = new Transaction();
$stripeTransaction = new StripeTransaction();
$paddleCustomerProfile = new CustomerProfile();

var_dump($paddleTransaction, '<br>', $stripeTransaction, '<br>', $paddleCustomerProfile, '<br>');


//////////////////

/**
 * Includes the layout view for the application.
 *
 * Note: The included file ('views/layout.php') will not inherit any classes or imports
 * that are present in this parent file. If you need to use those classes or imports
 * within the included file, you must import them again explicitly in 'views/layout.php'.
 */
// include('views/layout.php');

//////////////////////////////////////


$id = new \Ramsey\Uuid\UuidFactory();

echo $id->uuid4() . '<br>';
