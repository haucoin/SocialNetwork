<?php

namespace App\Models;

/**
 * @name Social Network
 * @version 4.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - GroupMember is a model class used to hold the data and properties of a group member through different pages and methods
 */
class GroupMember {
    
    // Define the properties of a group member identification
    private $id;
    private $username;
    private $groupId;
    
    
    /**
     * Non-default constructor to intialize an object
     *
     * @param $id - Integer: The ID number of a GroupMember used for identification
     * @param $username - String: The username of the user that the Group is associated with
     * @param $groupId - Integer: The ID of the group that the GroupMember is associated with
     */
    public function __construct($id, $username, $groupId){
        $this->id = $id;
        $this->username = $username;
        $this->groupId = $groupId;
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

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getGroupId() {
        return $this->groupId;
    }

    public function setGroupId($groupId) {
        $this->groupId = $groupId;
    }

}

