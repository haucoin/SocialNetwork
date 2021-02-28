<?php

namespace App\Models;

/**
 * @name Social Network
 * @version 4.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - Job is a model class used to hold the data and properties of a user's job through different pages and methods as their job history
 */
class Job {
	
	// Define the properties of a job
	private $id;
	private $title;
	private $description;
	private $company;
	private $location;
	private $startDate;
	private $endDate;
	private $userId;
	

	/**
	 * Non-default constructor to intialize an object
	 *
     * @param $id - Integer: The ID number of a job
	 * @param $title - String: The title of a user's job
	 * @param $description - String: The description of a user's job
	 * @param $company - String: The company of a users job
	 * @param $location - String: The location of the job
	 * @param $startDate - Date: The start date of the user's job
	 * @param $endDate - Date: The end date of the user's job
	 * @param $userId - Integer: The ID of the user that this job is associated to
	 */
	function __construct($id, $title, $description, $company, $location, $startDate, $endDate, $userId) {
		$this->id = $id;
		$this->title = $title;
		$this->description = $description;
		$this->company = $company;
		$this->location = $location;
		$this->startDate = $startDate;
		$this->endDate = $endDate;
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
	
	public function getTitle() {
		return $this->title;
	}
	
	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function getDescription() {
		return $this->description;
	}
	
	public function setDescription($description) {
		$this->description = $description;
	}
	
	public function getCompany() {
		return $this->company;
	}
	
	public function setCompany($company) {
		$this->company = $company;
	}
	
	public function getLocation() {
		return $this->location;
	}
	
	public function setLocation($location) {
		$this->location = $location;
	}
	
	public function getStartDate() {
		return $this->startDate;
	}
	
	public function setStartDate($startDate) {
		$this->startDate = $startDate;
	}
	
	public function getEndDate() {
		return $this->endDate;
	}
	
	public function setEndDate($endDate) {
		$this->endDate = $endDate;
	}
	
	public function getUserId() {
		return $this->userId;
	}
	
	public function setUserId($userId) {
		$this->userId = $userId;
	}
}

