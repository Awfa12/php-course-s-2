<?php

namespace App\OPP;

/**
 * DEPENDENCY INJECTION EXAMPLE
 * Using abstraction with dependency injection pattern
 */

class GarageService 
{
    private $vehicles = [];
    private $mechanics = [];
    
    // DEPENDENCY INJECTION: Garage receives Vehicle from outside
    public function addVehicle(Vehicle $vehicle) 
    {
        // ABSTRACTION: Can accept any Vehicle type without knowing specifics
        $this->vehicles[] = $vehicle;
    }

    // DEPENDENCY INJECTION: Shop receives mechanics from outside
    public function addMechanic($mechanicName) 
    {
        $this->mechanics[] = $mechanicName;
    }

    // Another example of dependency injection with interface
    public function serviceVehicle(Serviceable $vehicle) 
    {
        return [
            'service' => $vehicle->performService(),
            'cost' => '$' . $vehicle->getServiceCost()
        ];
    }
    
    public function serviceAllVehicles() 
    {
        echo "<strong>Servicing all vehicles (Abstraction + Encapsulation):</strong><br>";
        foreach ($this->vehicles as $vehicle) {
            echo "Servicing: " . $vehicle->getInfo() . "<br>";
            echo $vehicle->stop() . "<br>";  // ABSTRACTION: Same method, different implementations
            echo "Service completed<br>";
            echo $vehicle->start() . "<br>"; // ABSTRACTION: Same method, different implementations
            echo "<br>";
        }
    }

     // POLYMORPHISM + DEPENDENCY INJECTION: Works with any Serviceable vehicle
    public function processVehicle(Serviceable $vehicle, $mechanicName) 
    {
        // Same method calls, different implementations (POLYMORPHISM)
        $service = $vehicle->performService();
        $cost = $vehicle->getServiceCost();
        
        return "Mechanic {$mechanicName} completed: {$service} - Cost: {$cost}";
    }
}