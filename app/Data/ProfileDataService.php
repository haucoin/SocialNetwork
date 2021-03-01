<?php

namespace App\Data;

use App\Models\Profile;
use Exception;

/**
 * @name Social Network
 * @version 4.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - ProfileDataService is a DAO that is used to access the profiles table within the database
 */
class ProfileDataService implements DataServiceInterface {
    
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
    public function create($profile) {
    	
    	try {
    		// SQL insert statement to create the profile within the database for the user of the passed in id
    		$sqlProfile = "INSERT INTO `PROFILES` (`BIO`, `CITY`, `STATE`, `SKILLS`, `USER_ID`)
	                           VALUES ('{$profile->getBio()}', '{$profile->getCity()}', '{$profile->getState()}', '{$profile->getSkills()}', '{$_SESSION['currentUser']->getId()}');";
    		
    		// Run the insert profile SQL statement
    		$result = $this->connection->query($sqlProfile);
    		
    		// Return the result
    		return $result;
    	} 
    	// An error occurred, throw exception
    	catch (Exception $e) {
    		throw new Exception("Exception: " . $e->getMessage(), 0, $e);
    	}
    	
    }

    
	/**
	 * {@inheritDoc}
	 * 
	 * @see \App\Data\DataServiceInterface::update()
	 */
    public function update($profile) {
        
    	try {
	        // SQL update statements to update the user within the database to the user object passed in
    		$sqlProfile = "UPDATE `PROFILES` SET `BIO` = '{$profile->getBio()}', `CITY` = '{$profile->getCity()}', `STATE` = '{$profile->getState()}', 
                                    `SKILLS` = '{$profile->getSkills()}' WHERE `PROFILES`.`ID` = {$profile->getId()};";
	        
	        // Run the update user SQL statement
    		$result = $this->connection->query($sqlProfile);
	        
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
    public function delete(int $userId) { }

    
    /**
     * UNUSED FOR THIS DATA SERVICE
     */
    public function viewAll() { }
    
    
    /**
     * {@inheritDoc}
     * 
     * @see \App\Data\DataServiceInterface::viewById()
     */
    public function viewById(int $userId) {
    	
    	try {
    		// SQL select statement to get a posting given the user id, run query
    		$sqlProfile = "SELECT * FROM PROFILES WHERE USER_ID = {$userId}";
    		$resultsProfiles = mysqli_query($this->connection, $sqlProfile);
    		
    		// Set results to associative array
    		$rowProfile = $resultsProfiles->fetch_assoc();
    		
    		// Get the columns from the results and set to variables
    		$id = $rowProfile['ID'];
    		$bio = $rowProfile['BIO'];
    		$city = $rowProfile['CITY'];
    		$state = $rowProfile['STATE'];
    		$skills = $rowProfile['SKILLS'];
    		
    		// Create a new profile object using the variables
    		$currentProfile = new Profile($id, $bio, $city, $state, $skills, $userId);
    		
    		// Return the profile
    		return $currentProfile;
    	} 
    	// An error occurred, throw exception
    	catch (Exception $e) {
    		throw new Exception("Exception: " . $e->getMessage(), 0, $e);
    	}
    }
    
}