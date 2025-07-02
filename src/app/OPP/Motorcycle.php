<?php

namespace App\OPP;

use \InvalidArgumentException;

class Motorcycle extends Vehicle implements Serviceable
{
    // ENCAPSULATION: Private properties specific to Motorcycle
    private $cc;
    private $gearPosition = 1;  // Hidden internal state
    private $isKickStarted = false;
    
    public function __construct($brand, $model, $cc) 
    {
        parent::__construct($brand, $model);
        $this->setCc($cc);
    }
    
    // ENCAPSULATION: Controlled access with validation
    public function getCc() 
    {
        return $this->cc;
    }
    
    public function setCc($cc) 
    {
        if (!is_numeric($cc) || $cc <= 0 || $cc > 2000) {
            throw new InvalidArgumentException("CC must be between 1 and 2000");
        }
        $this->cc = (int)$cc;
    }
    
    public function getCurrentGear() 
    {
        return $this->gearPosition;
    }
    
    // ENCAPSULATION: Complex gear shifting logic hidden
    public function shiftGear($direction) 
    {
        if (!$this->isRunning()) {
            return "Cannot shift gear: Motorcycle is not running";
        }
        
        $direction = strtolower($direction);
        
        if ($direction === 'up' && $this->gearPosition < 6) {
            $this->gearPosition++;
            return "Shifted up to gear {$this->gearPosition}";
        } elseif ($direction === 'down' && $this->gearPosition > 1) {
            $this->gearPosition--;
            return "Shifted down to gear {$this->gearPosition}";
        }
        
        return "Cannot shift gear {$direction}";
    }
    
    // ENCAPSULATION: Private method for internal use only
    private function kickStart() 
    {
        $this->isKickStarted = true;
        return "Kicked to start";
    }
    
    public function start() 
    {
        if ($this->isRunning()) {
            return "Motorcycle is already running";
        }
        
        // ENCAPSULATION: Complex startup sequence hidden
        $kickResult = $this->kickStart();
        $this->setRunningState(true);
        $this->gearPosition = 1; // Reset to first gear
        
        return "Motorcycle started ({$this->cc}cc). " . $kickResult;
    }
    
    public function stop() 
    {
        if (!$this->isRunning()) {
            return "Motorcycle is already stopped";
        }
        
        $this->setRunningState(false);
        $this->isKickStarted = false;
        $this->gearPosition = 1; // Reset to neutral position
        
        return "Motorcycle engine stopped";
    }
    
    public function getMaxSpeed() 
    {
        return 180; // km/h
    }

    public function performService() 
    {
        return "Motorcycle service: Chain lubrication, valve adjustment, tire check completed.";
    }
    
    public function getServiceCost() 
    {
        return 75; // $75 for motorcycle service
    }
}