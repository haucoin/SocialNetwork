<?php

namespace App\Models;

/**
 * @name Social Network
 * @version 2.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - Profile is a model class used to hold the data and properties of a user's profile through different pages and methods
 */
Class Profile {
	
	// Define the properties of a profile
    private $bio;
    private $phoneNumber;
    private $streetAddress;
    private $city;
    private $state;
    private $zipCode;
    
    
    /**
     * Non-default constructor to intialize an object
     * 
     * @param $bio - String: The biography of a user to be shown on their profile page
     * @param $phoneNumber - String: The phone number of a user
     * @param $streetAddress - String: The street address where a user resides
     * @param $city - String: The name of the city where a user resides
     * @param $state - String: The name of the state where a user resides
     * @param $zipCode - String: The zip code where a user resides
     */
    function __construct($bio, $phoneNumber, $streetAddress, $city, $state, $zipCode) {
        $this->bio = $bio;
        $this->phoneNumber = $phoneNumber;
        $this->streetAddress = $streetAddress;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
    }
    
    
    /**
     * Getters and setters
     *
     * @param - variables
     * @return - variables
     */
	public function getBio() {
		return $this->bio;
	}

	public function setBio($bio) {
		$this->bio = $bio;
	}

	public function getPhoneNumber() {
		return $this->phoneNumber;
	}

	public function setPhoneNumber($phoneNumber) {
		$this->phoneNumber = $phoneNumber;
	}

	public function getStreetAddress() {
		return $this->streetAddress;
	}

	public function setStreetAddress($streetAddress) {
		$this->streetAddress = $streetAddress;
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

	public function getZipCode() {
		return $this->zipCode;
	}

	public function setZipCode($zipCode) {
		$this->zipCode = $zipCode;
	}

    
   
}