<?php

namespace App\Models;

/**
 * @name Social Network
 * @version 7.0
 * @author Holland Aucoin and Salvatore Parascandola
 * 
 * @desc - User is a model class used to hold the data and properties of a user object through different pages and methods
 */
Class User {
	
	// Define the properties of a user
    private $id;
    private $firstName;
    private $lastName;
    private $username;
    private $password;
    private $email;
    private $phoneNumber;
    private $role;
    private $active;
    
    
    /**
     * Non-default constructor to intialize an object
     * 
     * @param $id - Integer: The ID number of a user used for identification
     * @param $firstName - String: The first name of a user
     * @param $lastName - String: The last name of a user
     * @param $username - String: The username of a user, used for authentication
     * @param $password - String: The password of a user, used for authentication
     * @param $email - String: The email address of a user
     * @param $phoneNumber - String: The phone number of a user
     * @param $role - String: The role (regular user or admin) of a user
     * @param $active - String: The email address of a user
     */
    function __construct($id, $firstName, $lastName, $username, $password, $email, $phoneNumber, $role, $active) {
    	$this->id = $id;
    	$this->firstName = $firstName;
    	$this->lastName = $lastName;
    	$this->username = $username;
    	$this->password = $password;
    	$this->email = $email;
    	$this->phoneNumber = $phoneNumber;
    	$this->role = $role;
    	$this->active = $active;
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

	public function getFirstName() {
		return $this->firstName;
	}

	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}

	public function getLastName() {
		return $this->lastName;
	}

	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}

	public function getUsername() {
		return $this->username;
	}

	public function setUsername($username) {
		$this->username = $username;
	}

	public function getPassword() {
		return $this->password;
	}

	public function setPassword($password) {
		$this->password = $password;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}
	
	public function getPhoneNumber() {
		return $this->phoneNumber;
	}
	
	public function setPhoneNumber($phoneNumber) {
		$this->phoneNumber = $phoneNumber;
	}

	public function getRole() {
		return $this->role;
	}

	public function setRole($role) {
		$this->role = $role;
	}

	public function getActive() {
		return $this->active;
	}

	public function setActive($active) {
		$this->active = $active;
	}
    
}