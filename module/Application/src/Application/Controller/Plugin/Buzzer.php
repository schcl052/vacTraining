<?php

namespace Application\Controller\Plugin;

use \Zend\Mvc\Controller\Plugin\AbstractPlugin;

class Buzzer extends AbstractPlugin
{
    
    protected $sound;
    
    protected $level;
    
    public function __invoke() {
        return $this;
    }
    
    public function getSound(){
        return $this->sound;
    }
    
    public function getLevel(){
        return $this->level;
    }
    
    public function setSound($sound) {
        $this->sound = $sound;
        return $this;
    }

    public function setLevel($level) {
        $this->level = $level;
        return $this;
    }
    
    public function buzz(){
        return
        [
            'sound' => $this->sound,
            'level' => $this->level,
        ];
    }


}
