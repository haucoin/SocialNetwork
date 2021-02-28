<?php

namespace App\Models;

/**
 * @name Social Network
 * @version 4.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - Profile is a model class used to hold the data and properties of a user's profile through different pages and methods
 */
Class Profile {
	
	// Define the properties of a profile
	private $id;
    private $bio;
    private $city;
    private $state;
    private $skills;
    private $userId;
    

	/**
     * Non-default constructor to intialize an object
     * 
     * @param $id - Integer: The ID number of a profile
     * @param $bio - String: The biography of a user to be shown on their profile page
     * @param $city - String: The name of the city where a user resides
     * @param $state - String: The name of the state where a user resides
     * @param $skills - String: A list of skills a user has in their profile
     * @param $userId - Integer: The ID of the user that the profile is associated with
     */
    function __construct($id, $bio, $city, $state, $skills, $userId) {
    	$this->id = $id;
        $this->bio = $bio;
        $this->city = $city;
        $this->state = $state;
        $this->skills = $skills;
        $this->userId = $userId;
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
    
	public function getBio() {
		return $this->bio;
	}

	public function setBio($bio) {
		$this->bio = $bio;
	}

	public function getCity() {
		return $this->city;
	}

	public function setCity($city) {
		$this->city = $city;
	}

	public function getState() {
		return $this->state;
	}

	public function setState($state) {
		$this->state = $state;
	}
	
	public function getSkills() {
		return $this->skills;
	}
	
	public function setSkills($skills) {
		$this->skills = $skills;
	}

	public function getUserId() {
		return $this->userId;
	}
	
	public function setUserId($userId) {
		$this->userId = $userId;
	}
    
   
}