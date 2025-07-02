<?php

namespace App\OPP;

use \InvalidArgumentException;

/**
 * ENCAPSULATION IN OOP
 * 
 * Encapsulation is the bundling of data (properties) and methods that operate on that data
 * within a single unit (class), while restricting direct access to some of the object's
 * components. It's about data hiding and controlled access.
 * 
 * Key principles:
 * - Hide internal implementation details (private/protected properties)
 * - Provide controlled access through public methods (getters/setters)
 * - Protect data integrity by validating inputs
 * - Prevent unauthorized modification of object state
 * 
 * Visibility levels:
 * - private: Only accessible within the same class
 * - protected: Accessible within the class and its subclasses
 * - public: Accessible from anywhere
 * 
 * Example:
 * - A `Vehicle` class encapsulates properties like `brand`, `model`, and `registrationId`.
 * - It provides public methods to get information and control the vehicle's state (e.g., start, stop).
 * * - Internal properties like `isRunning` are private, ensuring they can't be modified directly from outside the class.
 * * - Getters and setters control how properties are accessed and modified, allowing for validation and transformation.
 * 
 */

/**
 * ABSTRACTION IN OOP
 * 
 * Abstraction is the concept of hiding complex implementation details while showing
 * only the essential features of an object. It focuses on WHAT an object does
 * rather than HOW it does it.
 * 
 * Key benefits:
 * - Simplifies complex systems by hiding unnecessary details
 * - Provides a clear interface for interacting with objects
 * - Reduces code complexity and improves maintainability
 * - Allows focusing on high-level functionality
 * 
 * Example:
 * - A `Vehicle` class defines methods like `start()`, `stop()`, and `getMaxSpeed()`.
 * - Users of the `Vehicle` class can call these methods without needing to know how they are implemented.
 * * - The `start()` method might involve complex logic (e.g., checking fuel, starting the engine),
 * but users simply call it to start the vehicle.
 * * - The implementation details are abstracted away, allowing users to interact with the vehicle
 * without understanding the underlying complexity.
 * 
 * abstract classes:
 * - Abstract classes define a blueprint for other classes.
 * - They can contain abstract methods (without implementation) that must be implemented by child classes.
 * - They can also have concrete methods with implementation.
 * - Abstract classes cannot be instantiated directly;
 *   they are meant to be extended by other classes.
 * 
 * abstract methods:
 * - Abstract methods are declared in abstract classes and do not have a body.
 * - They define a contract that child classes must fulfill by providing their own implementation.
 * * - This allows for polymorphism, where different classes can implement the same method in their own way.
 * - can't be private or final, as they need to be overridden in child classes.
 * 
 * 
 */

/**
 * Inheritance in OOP
 * 
 * Inheritance allows a class (child) to inherit properties and methods from another class (parent).
 * It promotes code reuse and establishes a hierarchical relationship between classes.
 * A child class can extend the functionality of a parent class by adding new properties or methods,
 * or by overriding existing ones.
 * * Key benefits:
 * - Code reuse: Child classes can use existing functionality without rewriting code
 * - Extensibility: Child classes can add or modify behavior
 * - Polymorphism: Child classes can be treated as instances of their parent class, allowing for flexible code
 * 
 * Example:
 * - A `Car` class can inherit from a `Vehicle` class, gaining its properties and methods while adding specific features like `numberOfDoors`.
 * 
 * final properties and methods:
 * - Use `final` keyword to prevent further inheritance or overriding
 * - Ensures that certain properties or methods remain unchanged in subclasses
 * * Example:
 *  - A `Vehicle` class might have a `final` method `getRegistrationId()` that generates a unique ID, ensuring all vehicles have a consistent registration process.
 *  - A `final` property like `MAX_SPEED` in a `Vehicle` class ensures that all vehicles have the same maximum speed limit.
 * 
 * with "is a" relationship:
 * - Inheritance models an "is a" relationship, where the child class is a specialized version of the parent class.
 * - Example: A `Car` "is a" `Vehicle`, meaning it inherits properties and behaviors of a `Vehicle`.
 * * with "has a" relationship:
 * - Composition models a "has a" relationship, where a class contains instances of other classes as properties.
 * - Example: A `Car` "has a" `Engine`, meaning it contains an instance of the `Engine` class as a property.
 * 
 * overriding methods:
 * - Child classes can override methods from the parent class to provide specific behavior.
 * - This allows for polymorphism, where a method can behave differently based on the object type.
 * - When overriding a method, you cannot change its signature (parameters), unless you provide default values for the new parameters.
 *  
 */

 /* POLYMORPHISM IN OOP
    * Polymorphism allows objects of different classes to be treated as objects of a common superclass.
    * It enables a single interface to represent different underlying forms (data types).
    * Key benefits:
    * - Code flexibility: Allows for writing generic code that can work with different types
    * - Simplifies code: Reduces the need for multiple method names for similar functionality
    * - Enhances maintainability: Changes in one class do not affect others using the same interface
    * 
    * Example:
    * - A `Vehicle` class defines a method `start()`.
    * - A `Car` class and a `Motorcycle` class both extend
    *   `Vehicle` and implement their own versions of `start()`.
    * - When you call `start()` on a `Vehicle` reference, it will invoke the appropriate method based on the actual object type (Car or Motorcycle).
    * - This allows for writing code that can work with any `Vehicle` type without knowing the specifics.
    *    * Polymorphism can be achieved through:
    * - Method overriding: Child classes provide their own implementation of a method defined in the parent class.
    * - Interfaces: Classes implement the same interface, allowing them to be treated interchangeably.
    */

    /* Interfaces vs Abstract Classes
    * Interface can only contain method declarations (no implementation),
    * interface can only contain methods and constants, no properties.
    * interface only have public methods, no private or protected methods.
    * class can implement multiple interfaces, allowing for flexible design.
    * abstract class contain methods with or without implementation,
    * abstract class can contain properties (variables) with different visibility (public, protected, private).
    * abstract class can have private, protected, and public methods.
    * abstract class can only be extended by one class, while a class can implement multiple interfaces.
    *
    * Use abstract classes when you want to define a common base with shared functionality,
    * and use interfaces when you want to define a contract that multiple classes can implement.
    */ 

    /* abstract class can implement an interface,
    * but an interface cannot implement an abstract class.
    * This allows the abstract class to provide a common base for multiple classes while still adhering to the contract defined by the interface.
    * Example:
    * - An abstract class `Vehicle` can implement an interface `Drivable`, providing a base implementation for the `start()` method.
    * - Concrete classes like `Car` and `Motorcycle` can then extend `Vehicle` and provide their own specific implementations.
    */

// Abstract class defines the contract (what must be done)
// but doesn't specify how it should be done
abstract class Vehicle 
{
    // ENCAPSULATION: These properties are protected, not directly accessible
    protected $brand;           // Can be accessed by child classes
    protected $model;           // Can be accessed by child classes
    private $registrationId;    // Only accessible within this class
    private $isRunning = false; // Internal state, hidden from outside
    
     public function __construct($brand, $model) 
    {
        // Encapsulation: Constructor controls how object is initialized
        $this->setBrand($brand);
        $this->setModel($model);
        $this->registrationId = $this->generateRegistrationId();
    }

    // ENCAPSULATION: Controlled access through getter methods
    public function getBrand() 
    {
        return $this->brand;
    }
    
    public function getModel() 
    {
        return $this->model;
    }
    
    public function getRegistrationId() 
    {
        return $this->registrationId;
    }
    
    public function isRunning() 
    {
        return $this->isRunning;
    }

    // ENCAPSULATION: Controlled modification through setter methods
    public function setBrand($brand) 
    {
        // Data validation - protecting data integrity
        if (empty($brand) || !is_string($brand)) {
            throw new InvalidArgumentException("Brand must be a non-empty string");
        }
        $this->brand = ucfirst(strtolower($brand));
    }
    
    public function setModel($model) 
    {
        // Data validation and transformation
        if (empty($model) || !is_string($model)) {
            throw new InvalidArgumentException("Model must be a non-empty string");
        }
        $this->model = strtoupper($model);
    }
    
    // ENCAPSULATION: Private method - internal implementation hidden
    private function generateRegistrationId() 
    {
        return strtoupper(substr($this->brand, 0, 2) . substr($this->model, 0, 2) . rand(1000, 9999));
    }
    
    // ENCAPSULATION: Protected method - can be used by child classes but not outside
    protected function setRunningState($state) 
    {
        $this->isRunning = (bool)$state;
    }
    
     // Public interface method
    public function getInfo() 
    {
        return "Brand: {$this->brand}, Model: {$this->model}, ID: {$this->registrationId}";
    }
    
    // Abstract methods - must be implemented by child classes
    abstract public function start();
    abstract public function stop();
    abstract public function getMaxSpeed();
}



/**
 * REAL-WORLD ABSTRACTION EXAMPLE
 * 
 * Think of a TV remote control:
 * - You know WHAT each button does (volume up, channel change)
 * - You don't know HOW the TV internally processes these commands
 * - The complex electronics are abstracted away
 * - You interact through a simple interface (buttons)
 * 
 * Similarly, in code:
 * - Abstract classes/interfaces define WHAT methods should exist
 * - Concrete classes define HOW those methods work
 * - Users interact with simple method calls
 * - Complex implementation details are hidden
 */