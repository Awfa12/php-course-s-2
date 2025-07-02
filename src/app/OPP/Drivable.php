<?php  

namespace App\OPP;

/** 
 * interface in OOP
 * 
 * An interface defines a contract that classes must adhere to.
 * It specifies a set of methods that must be implemented, but does not provide the implementation itself.
 * This allows for polymorphism, where different classes can implement the same interface in their own way.
 * * Key features of interfaces:
 * * - They can only contain method signatures (no implementation).
 * - A class can implement multiple interfaces, allowing for flexible design.
 * * - Interfaces promote code reusability and separation of concerns.
 * 
 * all methods in an interface must be public.
 * 
 */

/**
 * Use abstract methods in your Vehicle class for core functionality,
 * and interfaces for additional or optional features.
 *
 * 1. Abstract Class (Vehicle): Defines core functionality (e.g., start/stop).
 * 2. Interfaces: Define optional capabilities (e.g., fuel consumption, gear shifting).
 *
 * Advantages:
 * - Core Methods Protected: All vehicles must have essential methods like start/stop.
 * - Flexible Features: Each vehicle implements only the interfaces it needs.
 * - No Breaking Changes: Existing classes (e.g., Motorcycle) continue to work.
 * - Type Safety: Functions can require specific capabilities via interfaces.
 * - Clean Design: Abstract class for "is-a" relationships, interfaces for "can-do" features.
 *
 * Alternative Approaches (Not Recommended):
 * - Removing core methods from Vehicle and using only interfaces can break existing classes and allow incomplete vehicles.
 * - Duplicating methods in both abstract class and interfaces leads to redundancy and maintenance issues.
 *
 * Design Principle:
 * - Abstract Class: Defines what a vehicle IS (must have core methods).
 * - Interfaces: Define what a vehicle CAN DO (optional features).
 *
 * This approach maintains existing functionality and leverages the strengths of both abstract classes and interfaces.
 */

 /**
  * interface can't have propertiers, only constants and methods.
*/

// Extend from another interface:
// In PHP, interfaces can inherit from other interfaces using the "extends" keyword.
// This allows you to build more complex contracts by combining multiple interfaces.
// For example: interface AdvancedDrivable extends Drivable { ... }
interface Drivable 
{
    // Constants can be defined in an interface, but they must be public and static.
    // Constants defined in interfaces cannot be overridden by implementing classes.
    public const MAX_SPEED = 250; // km/h
    
    /**
     * Constructor magic method.
     *
     * This method is declared in the interface to enforce that any class implementing
     * this interface must define its own constructor. This ensures that necessary
     * initialization logic is provided by implementing classes.
     */
    //public function __construct();

    public function start();
    public function stop();
    public function accelerate($speed);
    public function brake();
}

