<?php
namespace App\Models;

/**
 * @name Social Network
 * @version 4.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - Group is a model class used to hold the data and properties of a group through different pages and methods
 */
class Group {
    
    // Define the properties of a group
    private $id;
    private $name;
    private $description;
    
    
    /**
     * Non-default constructor to intialize an object
     *
     * @param $id - Integer: The ID number of a group used for identification
     * @param $name - String: The name of a group
     * @param $description - String: The description of a group
     */
    public function __construct($id, $name, $description){
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    
    /**
     * Getters and setters
     * 
     * @param - variables
     * @return - variables
     */
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->owner = $description;
    }
    
}

