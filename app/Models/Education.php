<?php

namespace App\Models;

/**
 * @name Social Network
 * @version 2.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - Education is a model class used to hold the data and properties of a user's education history through different pages and methods
 */
class Education {
	
	// Define the properties of an education
	private $id;
	private $school;
	private $degree;
	private $fieldOfStudy;
	private $graduationYear;
	private $gpa;
	private $userId;
	

	/**
	 * Non-default constructor to intialize an object
	 *
	 * @param $id - Integer: The ID number of an education
	 * @param $school - String: The name of the school of the user's education
	 * @param $degree - String: The degree obtained through the education
	 * @param $fieldOfStudy - String: The field of study that the education focused on
	 * @param $graduationYear - String: The year the education was completed
	 * @param $gpa - String: The grade point average
	 * @param $userId - Integer: The ID of the user that this education is associated to
	 */
	function __construct($id, $school, $degree, $fieldOfStudy, $graduationYear, $gpa, $userId) {
		$this->id = $id;
		$this->school = $school;
		$this->degree = $degree;
		$this->fieldOfStudy = $fieldOfStudy;
		$this->graduationYear = $graduationYear;
		$this->gpa = $gpa;
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
	
	public function getSchool() {
		return $this->school;
	}
	
	public function setSchool($school) {
		$this->school = $school;
	}
	
	public function getDegree() {
		return $this->degree;
	}
	
	public function setDegree($degree) {
		$this->degree = $degree;
	}
	
	public function getFieldOfStudy() {
		return $this->fieldOfStudy;
	}
	
	public function setFieldOfStudy($fieldOfStudy) {
		$this->fieldOfStudy = $fieldOfStudy;
	}
	
	public function getGraduationYear() {
		return $this->graduationYear;
	}
	
	public function setGraduationYear($graduationYear) {
		$this->graduationYear = $graduationYear;
	}
	
	public function getGpa() {
		return $this->gpa;
	}
	
	public function setGpa($gpa) {
		$this->gpa = $gpa;
	}
	
	public function getUserId() {
		return $this->userId;
	}
	
	public function setUserId($userId) {
		$this->userId = $userId;
	}
}

