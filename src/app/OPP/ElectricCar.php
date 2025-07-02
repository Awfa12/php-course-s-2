<?php

namespace App\OPP;

use \InvalidArgumentException;

class ElectricCar extends Vehicle implements Drivable, Maintainable, Serviceable 
{
    private $batteryType;
    private $batteryLevel = 100;
    private $speed = 0;
    private $maintenanceStatus = "Good";


    public function __construct($brand, $model, $batteryType) 
    {
        parent::__construct($brand, $model);
        $this->setBatteryType($batteryType);
    }

    public function setBatteryType($batteryType) 
    {
        $allowedTypes = ['Lead-Acid', 'Lithium-Ion', 'Sodium-Ion'];
        if (!in_array($batteryType, $allowedTypes)) {
            throw new InvalidArgumentException("Invalid engine type. Allowed: " . implode(', ', $allowedTypes));
        }
        $this->batteryType = $batteryType;
    }

    public function getBatteryType() 
    {
        return $this->batteryType;
    }
    
    // Implementing Drivable interface
    public function start() 
    {
        if (!$this->isRunning() && $this->batteryLevel > 0) {
            $this->setRunningState(true);
            return $this->getInfo() . " (Electric) started silently.";
        }
        return $this->getInfo() . " cannot start.";
    }
    
    public function stop() 
    {
        if ($this->isRunning()) {
            $this->setRunningState(false);
            $this->speed = 0;
            return $this->getInfo() . " (Electric) stopped.";
        }
        return $this->getInfo() . " is already stopped.";
    }
    
    public function accelerate($speed) 
    {
        if ($this->isRunning()) {
            $this->speed += $speed;
            $this->batteryLevel -= ($speed * 0.05); // More efficient than gas
            return "Electric acceleration to " . $this->speed . " mph (Silent & Smooth).";
        }
        return "Cannot accelerate - car is not running.";
    }
    
    public function brake() 
    {
        if ($this->speed > 0) {
            $previousSpeed = $this->speed;
            $this->speed = max(0, $this->speed - 25);
            $this->batteryLevel += 2; // Regenerative braking
            return "Regenerative braking from " . $previousSpeed . " to " . $this->speed . " mph. Battery recharged!";
        }
        return "Already stopped.";
    }
    
    // Implementing Maintainable interface
    public function performMaintenance() 
    {
        $this->maintenanceStatus = "Excellent";
        return $this->getInfo() . " (Electric) maintenance completed - fewer moving parts!";
    }
    
    public function getMaintenanceStatus() 
    {
        return "Maintenance Status: " . $this->maintenanceStatus . " (Electric vehicles need less maintenance)";
    }
    
    public function chargeBattery($amount) 
    {
        $this->batteryLevel = min(100, $this->batteryLevel + $amount);
        return "Charged battery by " . $amount . "%. Current level: " . $this->batteryLevel . "%";
    }
    
    public function getBatteryLevel() 
    {
        return $this->batteryLevel . "%";
    }

    public function getMaxSpeed() 
    {
        return 200; // km/h
    }

    public function performService() 
    {
        return "Electric car service: Battery check, software update, tire rotation completed.";
    }
    
    public function getServiceCost() 
    {
        return 120; // $120 for electric car service
    }
}