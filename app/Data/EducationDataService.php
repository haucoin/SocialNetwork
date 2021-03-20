<?php

namespace App\Data;

use App\Models\Education;
use Exception;

/**
 * @name Social Network
 * @version 6.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - EducationDataService is a DAO that is used to access the education table within the database
 */
class EducationDataService implements DataServiceInterface {
    
	// Define connection variable to be used as the database connection
    private $connection;
    
    
    /**
     * Default constructor to initialize the database connection
     */
    public function __construct() {
        $database = new Database();
        $this->connection = $database->getConnection();
    }

    
    /**
     * {@inheritDoc}
     * 
     * @see \App\Data\DataServiceInterface::create()
     */
    public function create($education) {
    	
    	try {
    		// SQL insert statement to create an eduation within the database for the user of the passed in id
    		$sqlStatement = "INSERT INTO `EDUCATION` (`SCHOOL`, `DEGREE`, `FIELD_OF_STUDY`, `GRADUATION_YEAR`, `GPA`, `USER_ID`)
	                           VALUES ('{$education->getSchool()}', '{$education->getDegree()}', '{$education->getFieldOfStudy()}', '{$education->getGraduationYear()}', '{$education->getGpa()}', '{$_SESSION['currentUser']->getId()}');";
    		
    		// Run the insert education SQL statement
    		$result = $this->connection->query($sqlStatement);
    		
    		// Return the result
    		return $result;
    	} 
    	// An error occurred, throw exception
    	catch (Exception $e) {
    		throw new Exception("Exception: " . $e->getMessage(), 0, $e);
    	}
    	
    }

    
    /**
     * UNUSED FOR THIS DATA SERVICE
     */
    public function update($education) { }

    
    /**
     * {@inheritDoc}
     * 
     * @see \App\Data\DataServiceInterface::delete()
     */
    public function delete(int $id) {
    	
    	try {
	        
	        // SQL delete statements to remove the user's education from the database given the id passed in
    		$sqlStatement = "DELETE FROM `EDUCATION` WHERE `ID`= {$id};";
	        
	        // Run the delete user SQL statement
    		$result = $this->connection->query($sqlStatement);
	        
	        // Return the result
    		return $result;
    	}
    	// An error occurred, throw exception
        catch(Exception $e) {
        	throw new Exception("Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    
    /**
     * UNUSED FOR THIS DATA SERVICE
     */
    public function viewAll() { }
    
    
    /**
     * UNUSED FOR THIS DATA SERVICE
     */
    public function viewById(int $id) { }
    
    
    // ---------------------- End of data interface implementation -------------------


    /**
     * Method to get all of the education history of a user
     * 
     * @param $userId - Integer: The ID of the user
     * @throws Exception
     * @return $education - Array<Education>: A list (or array) of a user's education history
     */
    public function viewAllById(int $userId) {
    	
    	try {
    		// Create an array to store the education history with an index
    		$education = array();
    		$indexEducation = 0; 
    		
    		// SQL select statement to check to get education history of a user, run query
    		$sqlStatement = "SELECT * FROM EDUCATION WHERE USER_ID = {$userId}";
    		$resultsEducation = mysqli_query($this->connection, $sqlStatement);
    		
    		// Iterate through all education history retrieved
    		while($row = $resultsEducation->fetch_assoc()) {
    			// Set table column results to variables
    			$id = $row['ID'];
    			$school = $row['SCHOOL'];
    			$degree = $row['DEGREE'];
    			$fieldOfStudy = $row['FIELD_OF_STUDY'];
    			$graduationYear = $row['GRADUATION_YEAR'];
    			$gpa = $row['GPA'];
    			$userId = $row['USER_ID'];
    			
    			// Create a new education object using the variables
    			$currentEducation = new Education($id, $school, $degree, $fieldOfStudy, $graduationYear, $gpa, $userId);
    			
    			// Add the education object to the array
    			$education[$indexEducation] = $currentEducation;
    			$indexEducation++;
    		}
    		
    		// Return the array of education objects
    		return $education;
    		
    	} 
    	// An error occurred, throw exception
    	catch (Exception $e) {
    		throw new Exception("Exception: " . $e->getMessage(), 0, $e);
    	}
    	
    }
    
}