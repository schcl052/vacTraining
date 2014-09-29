<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Profile
 *
 * @author claude
 */
namespace Application\Entity;

/**
 * Profile
 * @package Application\Entity
 */
class Profile 
{
    /**
     *
     * @var String 
     */
    protected $address;
    
    /**
     * 
     * @return String
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * 
     * @param String $address
     */
    public function setAddress($address) {
        $this->address = $address;
    }


    
}