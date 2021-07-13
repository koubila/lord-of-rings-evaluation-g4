<?php

class Archer extends Character
{
    private $quiver = 24;
    public $prepareShot = false;

    public function __construct($name) {
         parent::__construct($name);
         $this->damage = 10;
    }

    public function turn($target) {
        $rand = rand(1, 10 );
        if (($this->quiver > 0 && $rand < 7) || $this->prepareShot) {
           return $this->arrow($target);
        }else if ($this->quiver == 0) {
            return $this->dagger($target);
        }else{
            return $this->concentrate();
        }
    }
    public function concentrate(){
        $this->prepareShot = true;
        $status = "$this->name se concentre pour bien viser !";
        return $status;
    }
    public function arrow($target) {
    $this->quiver -= 1;
    if ($this->prepareShot){
        $arrowTargetDamage = $this->damage * rand(15,30)/10;
        $target->setHealthPoints($arrowTargetDamage);
        $status = "$this->name tire sa flèche et touche un point faible sur $target->name à qui il reste $target->healthPoints points de vie ! Il reste $this->quiver flèches à $this->name !";
        $this->prepareShot = false;
        return $status;
    }else{
        $target->setHealthPoints($this->damage);
        $status = "$this->name tire une flèche sur $target->name à qui il reste $target->healthPoints points de vie ! Il reste $this->quiver flèches à $this->name !";
        return $status;
        }
    }

    public function dagger($target) {
        $target->setHealthPoints($this->damage-2);
        $status = "$this->name donne un coup de dague à $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
        return $status;
    }

}
