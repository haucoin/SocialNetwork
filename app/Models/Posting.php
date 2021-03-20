<?php
namespace App\Models;

use JsonSerializable;

/**
 * @name Social Network
 * @version 4.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - JobPosting is a model class used to hold the data and properties of a job posting through different pages and methods
 */
class Posting implements \JsonSerializable {
    
	// Define the properties of a job posting
    private $id;
    private $companyName;
    private $jobTitle;
    private $jobDescription;
    private $salary;
    private $location;
    
    
    /**
     * Non-default constructor to intialize an object
     * 
     * @param $id - Integer: The ID number of a job posting
     * @param $companyName - String: The name of the company that the job posting belongs to
     * @param $jobTitle - String: The title of the job posting
     * @param $jobDescription - String: The dedscription of the job that the posting is for
     * @param $salary - Decimal: The annual salary of the position of the job posting
     * @param $location - String: The location of the job posting
     */
    public function __construct($id, $companyName, $jobTitle, $jobDescription, $salary, $location){
        
        $this->id = $id;
        $this->companyName = $companyName;
        $this->jobTitle = $jobTitle;
        $this->jobDescription = $jobDescription;
        $this->salary = $salary;
        $this->location = $location;
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

    public function getCompanyName() {
        return $this->companyName;
    }

    public function setCompanyName($companyName) {
        $this->companyName = $companyName;
    }

    public function getJobTitle() {
        return $this->jobTitle;
    }

    public function setJobTitle($jobTitle) {
        $this->jobTitle = $jobTitle;
    }

    public function getJobDescription() {
        return $this->jobDescription;
    }

    public function setJobDescription($jobDescription) {
        $this->jobDescription = $jobDescription;
    }

    public function getSalary() {
        return $this->salary;
    }

    public function setSalary($salary) {
        $this->salary = $salary;
    }

    public function getLocation() {
        return $this->location;
    }

    public function setLocation($location) {
        $this->location = $location;
    }
    
    
    /**
     * Method to serialize the object as json
     *
     * {@inheritDoc}
     * @see JsonSerializable::jsonSerialize()
     */
	public function jsonSerialize() { 
		return get_object_vars($this);
	}
    
}

