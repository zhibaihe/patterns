<?php

// ---- The implementation

interface SwitchImplementation {
    public function on();
    public function off();
}

class PullChainSwitch implements SwitchImplementation {
    public function on()
    {
        echo "Pull to switch on\n";
    }
    public function off()
    {
        echo "Pull to switch off\n";
    }
}

class GateSwitch implements SwitchImplementation {
    public function on()
    {
        echo "Open to turn on\n";
    }
    public function off()
    {
        echo "Close to turn off\n";
    }
}

class FadeSwitch implements SwitchImplementation {
    public function on()
    {
        echo "Fading on within 10 seconds\n";
    }
    public function off()
    {
        echo "Fading off within 10 seconds\n";
    }
}

// ---- The bridge

abstract class SwitchEntity {

    protected $switch;

    public function __construct(SwitchImplementation $switch)
    {
        $this->switch = $switch;
    }

    abstract public function on();
    abstract public function off();
}

class LampSwitch extends SwitchEntity {

    public function on()
    {
        echo "Open up switch box:\n -- ";
        $this->switch->on();
    }
    public function off()
    {
        echo "Open up switch box:\n -- ";
        $this->switch->off();
    }
}

class TVSwitch extends SwitchEntity {

    public function on()
    {
        echo "Shake the TV set\n -- ";
        $this->switch->on();
    }
    public function off()
    {
        echo "Shake the TV set\n -- ";
        $this->switch->off();
    }
}

// ---- Client code

class PowerSaver {
    protected $switches = [];

    public function add(SwitchEntity $switch)
    {
        $this->switches[] = $switch;
    }

    public function sleep()
    {
        echo "Entering sleeping mode...\n";
        foreach($this->switches as $switch){
            $switch->off();
        }
        echo "Done!~\n\n";
    }

    public function wakeup()
    {
        echo "Waking up...\n";
        foreach($this->switches as $switch){
            $switch->on();
        }
        echo "Done!~\n\n";
    }
}

// ---- Assemble

$powerSaver = new PowerSaver;

$powerSaver->add(new LampSwitch(new PullChainSwitch));
$powerSaver->add(new LampSwitch(new GateSwitch));
$powerSaver->add(new LampSwitch(new FadeSwitch));
$powerSaver->add(new TVSwitch(new PullChainSwitch));
$powerSaver->add(new TVSwitch(new GateSwitch));
$powerSaver->add(new TVSwitch(new FadeSwitch));

$powerSaver->sleep();

$powerSaver->wakeup();
