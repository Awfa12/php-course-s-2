<?php

declare(strict_types=1); // Enforce strict type checking

require_once '../app/Transaction.php'; // Include the Transaction class

// --- Classes & Objects ---

echo "<h3>Transaction Example</h3>";

// Create a new Transaction object with amount 100 and description 'Transaction 1'
$transaction = new App\Transaction(100, 'Transaction 1');

// Add 8% tax to the transaction
$transaction->addTax(8);
// Apply a 10% discount to the transaction
$transaction->applyDiscount(10);

// Output the final amount after tax and discount
echo "<strong>Transaction 1 final amount:</strong> ";
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
echo "<strong>Transaction 1 (chained) final amount:</strong> ";
var_dump($transaction1->getAmount());
echo "<br>";
echo "<strong>Transaction 2 final amount:</strong> ";
var_dump($transaction2->getAmount());

echo '<br>';

// --- Working with JSON ---

echo "<h3>JSON Example</h3>";

// JSON string
$str = '{"a":1,"b":2,"c":3}';

// Decode JSON string to associative array
$arr = json_decode($str, true);

// Output the resulting array
echo "<strong>Decoded JSON array:</strong> ";
var_dump($arr);

echo '<br>';

// --- Working with stdClass objects ---

echo "<h3>stdClass Example</h3>";

// Create a new stdClass object
$obj = new \stdClass();

// Add properties to the object
$obj->a = 1;
$obj->b = 2;

// Output the object
echo "<strong>stdClass object:</strong> ";
var_dump($obj);

echo '<br>';

// --- Casting arrays to objects ---

echo "<h3>Array to Object Casting</h3>";

// Create an indexed array
$arr2 = [1, 2, 3];
// Cast the array to an object
$obj2 = (object) $arr2;

// Access the property with key 1 (second element)
echo "<strong>Accessing property 1 of casted object:</strong> ";
var_dump($obj2->{1});

echo '<br>';

// --- Casting scalars to objects ---

echo "<h3>Scalar to Object Casting</h3>";

// Cast integer to object; value is stored in 'scalar' property
$obj3 = (object) 1;
echo "<strong>Integer to object (scalar):</strong> ";
var_dump($obj3->scalar);
echo '<br>';

// Cast boolean to object; value is stored in 'scalar' property
$obj4 = (object) false;
echo "<strong>Boolean to object (scalar):</strong> ";
var_dump($obj4->scalar);
echo '<br>';

// Cast null to object; results in an empty object
$obj5 = (object) null;
echo "<strong>Null to object (empty object):</strong> ";
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
 * - The nullSafe operator (?->) ensures that if either getCustomer() 
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
 * This allows you to use namespaces and class autoLoading without manually including files.
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

echo "<hr><h3>Namespace Imports and Object Instantiation</h3>";

// Import the Transaction class from the Stripe namespace and alias it as StripeTransaction

use App\Enums\Status;
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
echo "<strong>Creating Paddle Transaction Example:</strong><br>";
$transactionExample = new Transaction(100, 'Transaction 1');
var_dump($transactionExample); // Outputs an instance of PaymentGateway\Stripe\Transaction

echo '<br>';

echo "<strong>Creating another Paddle Transaction:</strong><br>";
//var_dump(new PaymentGateway\Stripe\Transaction()); //with the (use) we can make it simple
var_dump(new Transaction(122, 'Transaction 2'));

echo '<br>';

/////////////////////////////////////////////////

echo "<strong>Creating Paddle and Stripe Transactions and CustomerProfile:</strong><br>";
$paddleTransaction = new Transaction(300, 'Transaction 3');
$stripeTransaction = new StripeTransaction(25);
$paddleCustomerProfile = new CustomerProfile();

var_dump($paddleTransaction);
echo '<br>';
var_dump($stripeTransaction);
echo '<br>';
var_dump($paddleCustomerProfile);
echo '<br>';


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

echo "<hr><h3>UUID Generation Example</h3>";

$id = new \Ramsey\Uuid\UuidFactory();

echo "<strong>Generated UUID v4:</strong> " . $id->uuid4() . '<br>';


/////////////////////////////////////

// echo Transaction::STATUS_PAID . '<br>';
// echo $paddleTransaction::STATUS_PENDING . '<br>';


// echo Transaction::class . '<br>';

// $paddleTransaction->setStatus('paid');
// var_dump($paddleTransaction);
// echo '<br>';
// $paddleTransaction->setStatus("sas");
// var_dump($paddleTransaction);
// echo '<br>';
// $paddleTransaction->setStatus($paddleTransaction::STATUS_PAID);
// var_dump($paddleTransaction);
// echo '<br>';
echo "<hr><h3>Enum Status and Static Properties</h3>";
$paddleTransaction->setStatus(Status::PAID);
echo "<strong>Paddle Transaction after setting status to PAID:</strong><br>";
var_dump($paddleTransaction);
echo '<br>';


////////////////////////////////////////////////

// The following works only if the static property 'count' is 
//declared as public in the Transaction class.
echo "<strong>Static count property (via object):</strong> ";
var_dump($paddleTransaction::$count);
echo '<br>';
echo "<strong>Static count property (via class):</strong> ";
var_dump(Transaction::$count);
echo '<br>';
$paddleTransaction2 = new Transaction(400, 'Transaction 4');
echo "<strong>Static count after creating another Transaction:</strong> ";
var_dump(Transaction::$count);
echo '<br>';

/**
 * Outputs the current count of Transaction objects using the static getCount() method.
 * 
 * This demonstrates accessing a private static property within the Transaction class
 * via a public static getter method. The result is dumped for debugging purposes.
 */
echo "<strong>Transaction::getCount():</strong> ";
var_dump(Transaction::getCount());
echo '<br>';


// var_dump($paddleTransaction2::$amount); // Accessing a non-static property
// var_dump($paddleTransaction2::process()); // Calling a non-static method

echo "<hr><h3>Singleton DB Instance Example</h3>";
use App\DB;

$db = DB::getInstance([]);
echo "<strong>DB instance 1:</strong> ";
var_dump($db);
echo '<br>';
$db = DB::getInstance([]);
echo "<strong>DB instance 2:</strong> ";
var_dump($db);
echo '<br>';
$db = DB::getInstance([]);
echo "<strong>DB instance 3:</strong> ";
var_dump($db);
echo '<br>';
$db = DB::getInstance([]);
echo "<strong>DB instance 4:</strong> ";
var_dump($db);
echo '<br>';
$db = DB::getInstance([]);
echo "<strong>DB instance 5:</strong> ";
var_dump($db);
echo '<br>';
/////////////////////////////////


// OOP - Encapsulation and Abstraction 


/**
 * Demonstrates the use of encapsulation in OOP by interacting with the StripeTransaction class.
 *
 * - The code shows two approaches: directly setting a public property (commented out) and using a setter method (`setAmount`).
 * - Using setter and getter methods is generally better than exposing public properties, as it allows for validation and control.
 * - However, relying too much on setters and getters can also break encapsulation, as it exposes internal state changes.
 * - The best practice is to prefer immutability where possible: instead of changing the value via a setter, create a new object with the desired state.
 * - This approach maintains encapsulation and makes the code more predictable and easier to maintain.
 */

// $transactionS = new StripeTransaction(60);

// $transactionS->amount = 100;

// $transactionS->process();

echo "<hr><h3>Encapsulation with StripeTransaction</h3>";

$transactionS = new StripeTransaction(60);

echo "<strong>Setting amount to 100 using setter:</strong><br>";
$transactionS->setAmount(100);

$transactionS->process();

echo "<br><strong>Processing StripeTransaction with default amount:</strong><br>";
$transactionS = new StripeTransaction(60);

$transactionS->process();

echo '<br>';


/////////////////////////////////
use App\OPP\Car;
use App\OPP\Motorcycle;
use App\OPP\GarageService;
use App\OPP\Vehicle;
use App\OPP\VehicleManager;
use App\OPP\Drivable;
use App\OPP\Maintainable;
use App\OPP\ElectricCar;
use App\OPP\Serviceable;


function operateVehicle(Vehicle $vehicle) 
{
    // ABSTRACTION: Function works with any Vehicle type without knowing implementation
    echo $vehicle->getInfo() . "<br>";
    echo $vehicle->start() . "<br>";
    echo "Max Speed: " . $vehicle->getMaxSpeed() . " km/h<br>";
    echo $vehicle->stop() . "<br><br>";
}

function calculateServiceCosts(array $vehicles) 
{
    $totalCost = 0;
    echo "<strong>Service Cost Calculation (Polymorphism):</strong><br>";
    
    foreach ($vehicles as $vehicle) {
        if ($vehicle instanceof Serviceable) {
            // POLYMORPHISM: Same method call, different costs
            $cost = $vehicle->getServiceCost();
            $totalCost += $cost;
            echo "Service cost: $" . $cost . "<br>";
        }
    }
    
    echo "Total service cost: $" . $totalCost . "<br><br>";
    return $totalCost;
}

// Function that works with any Drivable vehicle
function testDrive(Drivable $vehicle) 
{
    echo "<strong>Test Driving:</strong><br>";
    echo $vehicle->start() . "<br>";
    echo $vehicle->accelerate(30) . "<br>";
    echo $vehicle->accelerate(20) . "<br>";
    echo $vehicle->brake() . "<br>";
    echo $vehicle->stop() . "<br><br>";
}

// Function that works with any Maintainable vehicle
function performServiceCheck(Maintainable $vehicle) 
{
    echo "<strong>Service Check:</strong><br>";
    echo $vehicle->getMaintenanceStatus() . "<br>";
    echo $vehicle->performMaintenance() . "<br><br>";
}

echo "<h3>ENCAPSULATION AND ABSTRACTION DEMONSTRATION</h3>";



// ENCAPSULATION EXAMPLES
echo "<h4>ENCAPSULATION EXAMPLES:</h4>";

// Creating objects - constructor encapsulates initialization
$car = new Car("toyota", "camry", "Hybrid"); // Note: input will be formatted by encapsulated methods
$bike = new Motorcycle("Honda", "cbr", 600);

echo "<strong>Car Information:</strong><br>";
echo $car->getInfo() . "<br>";
echo "Engine: " . $car->getEngineType() . "<br>";
echo "Fuel Level: " . $car->getFuelLevel() . "<br>";
echo "Running: " . ($car->isRunning() ? "Yes" : "No") . "<br><br>";

// ENCAPSULATION: Controlled modification through methods
echo "<strong>Adding fuel (encapsulated operation):</strong><br>";
echo $car->addFuel(20) . "<br><br>";

echo "<strong>Starting and driving:</strong><br>";
echo $car->start() . "<br>";
echo $car->drive(50) . "<br>";
echo "Mileage: " . $car->getMileage() . "<br>";
echo "Engine Temperature: " . $car->getEngineTemperature() . "<br><br>";

echo "<strong>Motorcycle Operations:</strong><br>";
echo $bike->start() . "<br>";
echo $bike->shiftGear("up") . "<br>";
echo $bike->shiftGear("up") . "<br>";
echo "Current Gear: " . $bike->getCurrentGear() . "<br>";
echo $bike->stop() . "<br><br>";

// ABSTRACTION EXAMPLES
echo "<h4>ABSTRACTION EXAMPLES:</h4>";

// OOP - Abstraction with different vehicles
$car2 = new Car("Mercedes", "C-Class", "Hybrid");
$bike2 = new Motorcycle("Ducati", "Panigale", 1200);

$manager = new VehicleManager();
$manager->compareVehicles($car2, $bike2);

echo "<strong>Vehicle Manager - Starting Multiple Vehicles:</strong><br>";
$vehicles = [$car2, $bike2];
$manager->startAllVehicles($vehicles);

// Usage with dependency injection
echo "<strong>Usage with dependency injection (Abstraction):</strong><br>";
$garage = new GarageService();
$garage->addVehicle(new Car("Audi", "A4", "Gasoline"));
$garage->addVehicle(new Motorcycle("Suzuki", "GSX-R", 750));
$garage->serviceAllVehicles();

// ABSTRACTION: operateVehicle function works with any Vehicle type
echo "<strong>Function Abstraction - Works with any Vehicle:</strong><br>";
operateVehicle(new Car("BMW", "X5", "Diesel"));
operateVehicle(new Motorcycle("Yamaha", "R1", 1000));

echo "<br>";

/////////////////////////////////////


echo "<h3>INTERFACE DEMONSTRATION</h3>";

// Create different types of vehicles
$gasCar = new Car("Toyota", "Camry", "Diesel");
$electricCar = new ElectricCar("Tesla", "Model 3", "Lithium-Ion");

echo "<h4>Gas Car Operations:</h4>";
testDrive($gasCar);
performServiceCheck($gasCar);

echo "Fuel Operations:<br>";
echo $gasCar->addFuel(20) . "<br>";
echo "Current fuel level: " . $gasCar->getFuelLevel() . "<br>";
echo $gasCar->calculateFuelConsumption(50) . "<br><br>";

echo "<h4>Electric Car Operations:</h4>";
testDrive($electricCar);
performServiceCheck($electricCar);

echo "Battery Operations:<br>";
echo $electricCar->chargeBattery(15) . "<br>";
echo "Current battery level: " . $electricCar->getBatteryLevel() . "<br>";
echo "Current battery type: " . $electricCar->getBatteryType() . "<br><br>";

echo "<h4>Interface Benefits:</h4>";
echo "✓ <strong>Contract Enforcement:</strong> All Drivable vehicles must have start(), stop(), accelerate(), brake()<br>";
echo "✓ <strong>Multiple Implementation:</strong> Car implements 3 interfaces, ElectricCar implements 2<br>";
echo "✓ <strong>Polymorphism:</strong> testDrive() works with any Drivable vehicle<br>";
echo "✓ <strong>Flexibility:</strong> Different vehicles can implement interfaces differently<br>";
echo "✓ <strong>Code Organization:</strong> Related methods are grouped by functionality<br>";

echo "<br>";

echo "<strong>Servicing individual vehicles (Interface injection):</strong><br>";
$serviceResult = $garage->serviceVehicle(new Car("BMW", "X5", "Diesel"));
echo $serviceResult['service'] . " Cost: " . $serviceResult['cost'] . "<br>";

$serviceResult = $garage->serviceVehicle(new Motorcycle("Yamaha", "R1", 1000));
echo $serviceResult['service'] . " Cost: " . $serviceResult['cost'] . "<br><br>";


// =============================================================================
// POLYMORPHISM
// =============================================================================
echo "<h4>2. POLYMORPHISM</h4>";
echo "<p><strong>Concept:</strong> Different classes can be treated as instances of the same type, but they behave differently based on their actual class.</p>";

// Create different vehicle types
$vehicles = [
    new Car("Tesla", "Model 3", "Hybrid"),
    new Motorcycle("Ducati", "Panigale", 1200),
    new ElectricCar("Peterbilt", "579", "Lead-Acid"),
    new Car("Audi", "A4", "Hybrid")
];

echo "<strong>Polymorphism in action - Same function, different behaviors:</strong><br>";
foreach ($vehicles as $vehicle) {
    operateVehicle($vehicle);
}

// Polymorphism with interface
calculateServiceCosts($vehicles);


$autoShop = new GarageService();
$autoShop->addMechanic("John");
$autoShop->addMechanic("Sarah");

echo "<strong>Auto Shop combining both concepts:</strong><br>";
echo $autoShop->processVehicle(new Car("Honda", "Civic", "Hybrid"), "John") . "<br>";
echo $autoShop->processVehicle(new Motorcycle("Kawasaki", "Ninja", 500), "Sarah") . "<br>";
echo $autoShop->processVehicle(new ElectricCar("Volvo", "VNL", "Lead-Acid"), "John") . "<br><br>";


// =============================================================================
// KEY DIFFERENCES SUMMARY
// =============================================================================
echo "<h4>KEY DIFFERENCES:</h4>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Aspect</th><th>Dependency Injection</th><th>Polymorphism</th></tr>";
echo "<tr><td><strong>Purpose</strong></td><td>Provide dependencies from outside</td><td>Same interface, different behaviors</td></tr>";
echo "<tr><td><strong>Focus</strong></td><td>How objects get their dependencies</td><td>How objects behave when called</td></tr>";
echo "<tr><td><strong>Benefit</strong></td><td>Loose coupling, testability</td><td>Code reusability, flexibility</td></tr>";
echo "<tr><td><strong>Example</strong></td><td>GarageService receives vehicles</td><td>operateVehicle() works with any Vehicle</td></tr>";
echo "<tr><td><strong>When Used</strong></td><td>Object creation and composition</td><td>Method calls and behavior</td></tr>";
echo "</table>";