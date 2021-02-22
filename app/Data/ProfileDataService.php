<?php

namespace App\Data;

use App\Models\Profile;
use Exception;

/**
 * @name Social Network
 * @version 2.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - UserDataService is a DAO that is used to access the users table within the database
 */
Class ProfileDataService {
    
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
    		
    		return $result;
    	} 
    	catch (Exception $e) {
    		// Throw exception
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
     * {@inheritDoc}
     * 
     * @see \App\Data\DataServiceInterface::delete()
     */
    public function delete(int $userId) {
    	
    	try {
	        
	        // SQL delete statements to remove the user's profile from the database given the id passed in
    		$sqlProfile = "DELETE FROM `PROFILES` WHERE `USER_ID`= {$userId};";
	        
	        // Run the delete user SQL statement and add to affected rows
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
     * {@inheritDoc}
     * 
     * @see \App\Data\DataServiceInterface::viewById()
     */
    public function viewByUserId(int $userId) {
    	
    	try {
    		// Select statment for profiles
    		$sqlProfile = "SELECT * FROM PROFILES WHERE USER_ID = {$userId}";
    		
    		$resultsProfiles = mysqli_query($this->connection, $sqlProfile);
    		
    		$rowProfile = $resultsProfiles->fetch_assoc();
    		
    		$id = $rowProfile['ID'];
    		$bio = $rowProfile['BIO'];
    		$city = $rowProfile['CITY'];
    		$state = $rowProfile['STATE'];
    		$skills = $rowProfile['SKILLS'];
    		
    		$currentProfile = new Profile($id, $bio, $city, $state, $skills, $userId);
    		
    		return $currentProfile;
    		
    	} 
    	catch (Exception $e) {
    		// Throw exception
    		throw new Exception("Exception: " . $e->getMessage(), 0, $e);
    	}
    	
    }
    
    
    
	public function viewAll() {
		
	}

    
}