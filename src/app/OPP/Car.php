<?php

namespace App\OPP;

use \InvalidArgumentException;
use \Exception;

// Concrete implementation - defines HOW the abstract methods work
class Car extends Vehicle implements Drivable, Maintainable, FuelConsumer, Serviceable
{
    // ENCAPSULATION: Private properties specific to Car
    private $engineType;
    private $maintenanceStatus = "Good";
    private $milesSinceService = 0;
    private $speed = 0;       // Hidden internal state
    private $fuelLevel = 0;        // Hidden internal state
    private $mileage = 0;          // Hidden internal state
    private $engineTemperature = 20; // Hidden internal state
    
    public function __construct($brand, $model, $engineType) 
    {
        parent::__construct($brand, $model);
        $this->setEngineType($engineType);
        $this->fuelLevel = 100; // Start with full tank
    }
    
    // ENCAPSULATION: Controlled access to engine type
    public function getEngineType() 
    {
        return $this->engineType;
    }
    
    public function setEngineType($engineType) 
    {
        $allowedTypes = ['Gasoline', 'Diesel', 'Hybrid', 'Electric'];
        if (!in_array($engineType, $allowedTypes)) {
            throw new InvalidArgumentException("Invalid engine type. Allowed: " . implode(', ', $allowedTypes));
        }
        $this->engineType = $engineType;
    }
    
    // ENCAPSULATION: Controlled access to fuel level
    public function getFuelLevel() 
    {
        return $this->fuelLevel . "%";
    }
    
    public function addFuel($amount) 
    {
        // Data validation and business logic encapsulated
        if ($amount <= 0) {
            throw new InvalidArgumentException("Fuel amount must be positive");
        }
        
        $newLevel = $this->fuelLevel + $amount;
        $this->fuelLevel = min($newLevel, 100); // Cap at 100%
        
        return "Added {$amount}% fuel. Current level: {$this->fuelLevel}%";
    }
    
    // ENCAPSULATION: Complex internal logic hidden from outside
    private function checkEngineConditions() 
    {
        if ($this->fuelLevel <= 0) {
            throw new Exception("Cannot start: No fuel");
        }
        
        if ($this->engineTemperature > 100) {
            throw new Exception("Cannot start: Engine overheated");
        }
        
        return true;
    }
    
    private function warmUpEngine() 
    {
        // Simulate engine warm-up
        $this->engineTemperature += rand(10, 30);
    }
    
    // Implementation of abstract method
    public function start() 
    {
        if ($this->isRunning()) {
            return "Car is already running";
        }
        
        // ENCAPSULATION: Complex startup logic hidden behind simple interface
        try {
            $this->checkEngineConditions();
            $this->warmUpEngine();
            $this->setRunningState(true);
            $this->fuelLevel -= 1; // Starting consumes fuel
            
            return "Car engine started with {$this->engineType}. Fuel: {$this->fuelLevel}%";
        } catch (Exception $e) {
            return "Failed to start: " . $e->getMessage();
        }
    }

    public function accelerate($speed) 
    {
        if ($this->isRunning()) {
            $this->speed += $speed;
            $this->fuelLevel -= ($speed * 0.1);
            $this->milesSinceService += ($speed * 0.1);
            return "Accelerated to " . $this->speed . " mph.";
        }
        return "Cannot accelerate - car is not running.";
    }
    
    public function stop() 
    {
        if (!$this->isRunning()) {
            return "Car is already stopped";
        }
        
        // ENCAPSULATION: Internal state management hidden
        $this->setRunningState(false);
        $this->engineTemperature = max(20, $this->engineTemperature - 20); // Cool down
        
        return "Car engine stopped. Temperature: {$this->engineTemperature}°C";
    }

    public function brake() 
    {
        if ($this->speed > 0) {
            $previousSpeed = $this->speed;
            $this->speed = max(0, $this->speed - 20);
            return "Braked from " . $previousSpeed . " to " . $this->speed . " mph.";
        }
        return "Already stopped.";
    }

    public function performMaintenance() 
    {
        $this->maintenanceStatus = "Excellent";
        $this->milesSinceService = 0;
        return $this->getInfo() . " maintenance completed.";
    }
    
    public function getMaintenanceStatus() 
    {
        if ($this->milesSinceService > 100) {
            $this->maintenanceStatus = "Needs Service";
        }
        return "Maintenance Status: " . $this->maintenanceStatus . " (Miles since service: " . $this->milesSinceService . ")";
    }
    
    public function getMaxSpeed() 
    {
        return 200; // km/h
    }
    
    // ENCAPSULATION: Public method that uses private data
    public function drive($distance) 
    {
        if (!$this->isRunning()) {
            return "Cannot drive: Car is not running";
        }
        
        // Complex calculation hidden from user
        $fuelConsumption = $distance * 0.1; // 0.1% per km
        
        if ($this->fuelLevel < $fuelConsumption) {
            return "Cannot drive {$distance}km: Insufficient fuel";
        }
        
        $this->fuelLevel -= $fuelConsumption;
        $this->mileage += $distance;
        
        return "Drove {$distance}km. Fuel: {$this->fuelLevel}%, Total mileage: {$this->mileage}km";
    }
    
    // ENCAPSULATION: Read-only access to internal state
    public function getMileage() 
    {
        return $this->mileage . " km";
    }
    
    public function getEngineTemperature() 
    {
        return $this->engineTemperature . "°C";
    }

    public function calculateFuelConsumption($distance) 
    {
        $consumption = $distance * 0.08; // 8% fuel per unit distance
        return "Estimated fuel consumption for " . $distance . " miles: " . $consumption . "%";
    }

    public function performService() 
    {
        return "Car service: Oil change, tire rotation, brake check completed.";
    }
    
    public function getServiceCost() 
    {
        return 150; // $150 for car service
    }
}
