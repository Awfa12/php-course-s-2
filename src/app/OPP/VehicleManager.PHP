<?php

namespace App\OPP;

class VehicleManager 
{
    /**
     * ABSTRACTION IN ACTION
     * 
     * The user doesn't need to know the internal complexity of how each vehicle starts.
     * They just call start() and get the appropriate behavior.
    */
    public function startAllVehicles(array $vehicles) 
    {
        echo "<strong>Starting all vehicles:</strong><br>";
        foreach ($vehicles as $vehicle) {
             // Abstraction allows us to work with any vehicle type
            // without knowing the specific implementation details
            // Using the abstraction - we don't care about specific implementation
            echo $vehicle->getInfo() . "<br>";
            echo $vehicle->start() . "<br>";
        }
        echo "<br>";
    }
    
    public function compareVehicles(Vehicle $vehicle1, Vehicle $vehicle2) 
    {
        echo "<strong>Comparing vehicles (Abstraction):</strong><br>";
        echo "Vehicle 1: " . $vehicle1->getInfo() . " (Max: " . $vehicle1->getMaxSpeed() . " km/h)<br>";
        echo "Vehicle 2: " . $vehicle2->getInfo() . " (Max: " . $vehicle2->getMaxSpeed() . " km/h)<br>";
        
        if ($vehicle1->getMaxSpeed() > $vehicle2->getMaxSpeed()) {
            echo "Vehicle 1 is faster<br>";
        } else {
            echo "Vehicle 2 is faster<br>";
        }
        echo "<br>";
    }

}