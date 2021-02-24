<?php
namespace App\Data;

use App\Models\JobPosting;
use Exception;

class JobPostingDataService implements DataServiceInterface {
    
    private $connection;
    
    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->getConnection();  
    }
    
    public function viewById($id) {
        try {
            // Select statment for profiles
            $sqlJobPost = "SELECT * FROM JOB_POSTINGS WHERE ID = {$id}";
            
            $resultsJobPost = mysqli_query($this->connection, $sqlJobPost);
            
            $rowJobPost = $resultsJobPost->fetch_assoc();
            $companyName = $rowJobPost['COMPANY_NAME'];
            $jobTitle = $rowJobPost['JOB_TITLE'];
            $jobDescription = $rowJobPost['JOB_DESCRIPTION'];
            $salary = $rowJobPost['SALARY'];
            $location = $rowJobPost['LOCATION'];
            
            $currentJobPost = new JobPosting($id, $companyName, $jobTitle, $jobDescription, $salary, $location);
            
            return $currentJobPost;
        } 
        catch (Exception $e) {
            // Throw exception
            throw new Exception("Exception: " . $e->getMessage(), 0, $e);
        }
    }

    public function create($object)
    {
        try {
            // Creates an inital profiles object for the user object
            $sqlJobPost = "INSERT INTO `JOB_POSTINGS` (`COMPANY_NAME`, `JOB_TITLE`, `JOB_DESCRIPTION`, `SALARY`, `LOCATION`)
	                           VALUES ('{$object->getCompanyName()}', '{$object->getJobTitle()}', '{$object->getJobDescription()}', '{$object->getSalary()}', '{$object->getLocation()}');";
            
            // Runs the querys through the database
            $result = $this->connection->query($sqlJobPost);
            
            return $result;
        } catch (Exception $e) {
            // Throw exception
            throw new Exception("Exception: " . $e->getMessage(), 0, $e);
        }
    }

    public function update($object)
    {
        try {
            
            $sqlJobPost = "UPDATE `JOB_POSTINGS` SET `COMPANY_NAME` = '{$object->getCompanyName()}', `JOB_TITLE` = '{$object->getJobTitle()}',
                                `JOB_DESCRIPTION` = '{$object->getJobDescription()}', `SALARY` = '{$object->getSalary()}', `LOCATION` = '{$object->getLocation()}'
                                    WHERE `JOB_POSTINGS`.`ID` = {$object->getId()};";
            
            $this->connection->query($sqlJobPost);
            $numRowsAffected = $this->connection->affected_rows;
            
            // Return the number of rows affected by the update
            return $numRowsAffected;
        } catch (Exception $e) {
            // Throw exception
            throw new Exception("Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    public function delete($id)
    {
        try {
            
            $sqlJobPost = "DELETE FROM `JOB_POSTINGS` WHERE `ID`= {$id};";
            
            $this->connection->query($sqlJobPost);
            $numRowsAffected = $this->connection->affected_rows;
            
            // Returns the number of rows affected
            return $numRowsAffected;
        } catch (Exception $e) {
            // Throw exception
            throw new Exception("Exception: " . $e->getMessage(), 0, $e);
        }
    }

    public function viewAll()
    {
        try {
            
            $jobPosts = array();
            $indexJobPost = 0;
            
            $sqljobPost = "SELECT * FROM JOB_POSTINGS";
            
            $resultsJobPost = mysqli_query($this->connection, $sqljobPost);
            
            while ($row = $resultsJobPost->fetch_assoc()) {
                
                $id = $row['ID'];
                
                $currentJobPost = $this->viewByID($id);
                
                $jobPosts[$indexJobPost] = $currentJobPost;
                $indexJobPost ++;
            }
            
            return $jobPosts;
            
        } catch (Exception $e) {
            
            throw new Exception("Exception: " . $e->getMessage(), 0, $e);
        }
    }

    
    
}

