<?php

namespace App\Data;

use App\Models\User;
use App\Models\Profile;
use Exception;

/**
 * @name Social Network
 * @version 2.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - UserDataService is a DAO that is used to access the users table within the database
 */
Class UserDataService implements DataServiceInterface {
    
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
    public function create($user) {
    	
    	try {
	        // SQL select statement to check to see if the username is already taken, run query
	        $sqlUsernameCheck = "SELECT * FROM USERS WHERE USERNAME = '{$user->getUserName()}'";
	        $resultsCheck = mysqli_query($this->connection, $sqlUsernameCheck);
	        $numberOfRows = mysqli_num_rows($resultsCheck);
	        
	        // Verify if the username has already been taken
	        if($numberOfRows <= 0) {
	            // SQL insert statement to add the user to the database using the user object passed in
	            $sqlStatement = "INSERT INTO `USERS` (`ID`, `FIRST_NAME`, `LAST_NAME`, `USERNAME`, `PASSWORD`, `EMAIL`, `USER_ROLE`, `ACTIVE`) 
	                             VALUES (NULL, '{$user->getFirstName()}', '{$user->getLastName()}', '{$user->getUsername()}', 
	                             '{$user->getPassword()}', '{$user->getEmail()}', '{$user->getRole()}', '{$user->getActive()}');";
	            // Run the query
	            $result = $this->connection->query($sqlStatement);
	            
	            // Retrieve the most recent id from the database and set to the user's id
	            $userId = mysqli_insert_id($this->connection);
	            $user->setId($userId);
	            
	            // Verify if the insert was successful
	            if($result == false) {
	            	return $result;
	            }
	            // Insert was successful
	            else {
	            	// SQL insert statement to add an empty user's profile to the database with their id to be altered in the future
		            $sqlProfile = "INSERT INTO `PROFILES` (`ID`, `BIO`, `PHONE_NUMBER`, `STREET_ADDRESS`, `CITY`, `STATE`, `ZIP_CODE`, `USER_ID`)
	                           VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{$user->getId()}');";
		            
		            // Run the query
		            $result = $this->connection->query($sqlProfile);
		                
		            // Set the session variable to the user object
		            $_SESSION['currentUser'] = $this->viewById($user->getId());
		            // Return the success
		            return $result;
	            }
	            
	        }
	        // Username was already taken, return -1
	        else {
	            return -1;
	        } 
    	}
    	// An error occurred, throw exception
    	catch(Exception $e) {
    		throw new Exception("Exception: " . $e->getMessage(), 0, $e);
    	}
    }

    
	/**
	 * {@inheritDoc}
	 * 
	 * @see \App\Data\DataServiceInterface::update()
	 */
    public function update($user) {
        
    	try {
    		// Define variable of rows affected
	        $numRowsAffected = 0;
	        
	        // SQL update statements to update the user within the database to the user object passed in
	        $sqlUser = "UPDATE `USERS` SET `FIRST_NAME` = '{$user->getFirstName()}', `LAST_NAME` = '{$user->getLastName()}', 
	                    `USERNAME` = '{$user->getUsername()}', `PASSWORD` = '{$user->getPassword()}', `EMAIL` = '{$user->getEmail()}', `USER_ROLE` = 
	                    '{$user->getRole()}', `ACTIVE` = '{$user->getActive()}' WHERE `USERS`.`ID` = {$user->getId()};";
	        // SQL update statements to update the user's profile within the database to the user's profile object passed in
	        $sqlUserProfile = "UPDATE `PROFILES` SET `BIO` = '{$user->getProfile()->getBio()}', `PHONE_NUMBER` = '{$user->getProfile()->getPhoneNumber()}', 
							`STREET_ADDRESS` = '{$user->getProfile()->getStreetAddress()}', `CITY` = '{$user->getProfile()->getCity()}', `STATE` = '{$user->getProfile()->getState()}', 
							`ZIP_CODE` = '{$user->getProfile()->getZipCode()}' WHERE `PROFILES`.`USER_ID` = {$user->getId()};";
	        
	        // Run the update user SQL statement and add to affected rows
	        $this->connection->query($sqlUser);
	        $numRowsAffected += $this->connection->affected_rows;
	        // Run the update profile SQL statement and add to affected rows
	        $this->connection->query($sqlUserProfile);
	        $numRowsAffected += $this->connection->affected_rows;
	        
	        // Return the number of rows affected by the update 
	        return $numRowsAffected;
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
    		// Define variable of rows affected
	        $numRowsAffected = 0;
	        
	        // SQL delete statements to remove the user andd their profile from the database given the id passed in
	        $sqlUser = "DELETE FROM `USERS` WHERE `ID`= {$userId};";
	        $sqlUserProfile = "DELETE FROM `PROFILES` WHERE `USER_ID`= {$userId};";
	        
	        // Run the delete user SQL statement and add to affected rows
	        $this->connection->query($sqlUserProfile);
	        $numRowsAffected += $this->connection->affected_rows;
	        // Run the delete profile SQL statement and add to affected rows
	        $this->connection->query($sqlUser);
	        $numRowsAffected += $this->connection->affected_rows;
	        
	        // Return the number of rows affected
	        return $numRowsAffected;
    	}
    	// An error occurred, throw exception
        catch(Exception $e) {
        	throw new Exception("Exception: " . $e->getMessage(), 0, $e);
        }
    }

    
    /**
     * {@inheritDoc}
     * 
     * @see \App\Data\DataServiceInterface::viewAll()
     */
    public function viewAll() {
    	
    	try {
	        // Create an array to store the users with an index
	        $users = array(); 
	        $indexUser = 0; 
	        
	        // SQL select statement to retrieve all users from the database
	        $sqlQuery = "SELECT * FROM USERS";
	        // Run the query
	        $results = mysqli_query($this->connection, $sqlQuery);
	        
	        // Iterate through all users retrieved
	        while($row = $results->fetch_assoc()) {
	            // Get the id of current user
	            $id = $row['ID'];
	            
	            // Get the current user using the id
	            $currentUser = $this->viewByID($id);
	            
	            // Add the user object to the array
	            $users[$indexUser] = $currentUser;
	            $indexUser++;
	        }
	        
	        // Return the array of user objects 
	        return $users;
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
    public function viewById(int $userId) {
    	
    	// SQL select statement to retrieve the user matching the given id
    	$sqlUsers = "SELECT * FROM USERS WHERE ID = {$userId}";
    	// SQL select statement to retrieve the profile matching the given id
    	$sqlProfiles = "SELECT * FROM PROFILES WHERE USER_ID = {$userId}";
    	
    	// Run the queries
    	$resultsUsers = mysqli_query($this->connection, $sqlUsers);
    	$resultsProfiles = mysqli_query($this->connection, $sqlProfiles);
    	
    	// Get the user and profile information from the queries
    	$rowUser = $resultsUsers->fetch_assoc();
    	$rowProfile = $resultsProfiles->fetch_assoc();
    	
    	// Get each variable from the results
    	$firstName = $rowUser['FIRST_NAME'];
    	$lastName = $rowUser['LAST_NAME'];
    	$username = $rowUser['USERNAME'];
    	$password = $rowUser['PASSWORD'];
    	$email = $rowUser['EMAIL'];
    	$role = $rowUser['USER_ROLE'];
    	$active = $rowUser['ACTIVE'];
    	$bio = $rowProfile['BIO'];
    	$phoneNumber = $rowProfile['PHONE_NUMBER'];
    	$streetAddress = $rowProfile['STREET_ADDRESS'];
    	$city = $rowProfile['CITY'];
    	$state = $rowProfile['STATE'];
    	$zipCode = $rowProfile['ZIP_CODE'];
    	
    	// Create a profile and user object using the variables
    	$currentUserProfile = new Profile($bio, $phoneNumber, $streetAddress, $city, $state, $zipCode);
    	$currentUser = new User($userId, $firstName, $lastName, $username, $password, $email, $role, $active, $currentUserProfile);
    	
    	// Return the user model
    	return $currentUser;
    }
    
}