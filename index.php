<?php
declare (strict_types = 1);
interface Vehicle {
    public function properties(string $color = "...", string $model = "...", string $newThing = "...");
    public function move(bool $m = false);
    public function superSkill();
}

abstract class WheeledTransport implements Vehicle {
    protected string $color;
    protected string $model;
    protected string $newThing;
    protected bool $move;
    public function properties(string $color = "...", string $model = "...", string $newThing = "...") {
        $this -> color = $color;
        $this -> model = $model;
        $this -> newThing = $newThing;
    }
    protected function notification() {
        echo $this -> note;
    }
    public function move(bool $m = false) {
        echo $m ? "I am mooving"."<br>" : "I am not mooving"."<br>";
        $this -> move = $m;
    }
    public function superSkill() {
        $this -> notification();
    }
    public function getInfo() {
        echo "My model is ".$this -> model." ,color is ".$this -> color." ,new thing is ".$this -> newThing."<br>";
    }
}

trait AddSkills {
    public function wiper(bool $w = false) {
        echo $w ? "My wipers are on<br>" : "My wipers are off<br>";
        $this -> wiper = $w;
    }
    public function beep(bool $b = false) {
        echo $b ? "Beeeeeeeep!!!<br>" : "<br>";
        $this -> beep = $b;
    }
}

class RacingCar extends WheeledTransport {
    use AddSkills;
    protected $note = "I can use nitrous oxide to speed up!<br>"; 
}

class Excavator extends WheeledTransport {
    use AddSkills;
    protected $note = "I can dig with my bucket!<br>";
}

class Bicycle extends WheeledTransport {
    protected $note = "I can drive on one wheel!<br>";  
    public function wiper(bool $v = false) {
        echo "wipers option not supported<br>";
    }
    // because nobody use wipers and beeper on bicycle
    public function __call($name, $args) {
        echo "AddSkill methods are undefined for this object<br>";
    }
}

class Tractor extends WheeledTransport {
    use AddSkills;
    protected $note = "I can plow fields!<br>";   
}

$nissan = new RacingCar;
$nissan -> properties("white", "Nissan SkyLine", "new leather interior");
$case = new Tractor;
$case -> properties("red", "Case Puma 210", "new hydraulic cylinders");
$cat = new Excavator;
$cat -> properties("yellow", "Cat M315", "new tires");
$comanche = new Bicycle;
$comanche -> properties("blue", "Comanche Orinoco 27.5 Disc L", "new pedal");

function runVehicle(Vehicle $obj) {
    $obj -> getInfo();
    $obj -> move(true);
    $obj -> beep(true);
    $obj -> wiper(true);
    $obj -> superSkill();
}

runVehicle($comanche);