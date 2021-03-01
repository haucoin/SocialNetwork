<?php

namespace App\Data;

use App\Models\Group;
use Exception;

/**
 * @name Social Network
 * @version 4.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - GroupDataService is a DAO that is used to access the groups and group members table within the database
 */
class GroupDataService implements DataServiceInterface {

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
    public function create($object) {
    	
    	try {
    		// SQL insert statement to create a group within the database
    		$sqlGroups = "INSERT INTO `GROUPS` (`NAME`, `DESCRIPTION`)
	                           VALUES ('{$object->getName()}', '{$object->getDescription()}');";
    		
    		// Run the insert group SQL statement
    		$result = $this->connection->query($sqlGroups);
    		
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
    public function update($object) {
    	
        try {
        	// SQL update statement to update a group within the database, run query
            $sqlGroups = "UPDATE `GROUPS` SET `NAME` = '{$object->getName()}', `DESCRIPTION` = '{$object->getDescription()}' WHERE `GROUPS`.`ID` = {$object->getId()};";
            $this->connection->query($sqlGroups);
            
            // Get and return the number of rows affected by the update
            $numRowsAffected = $this->connection->affected_rows;
            return $numRowsAffected;
        } 
        // An error occurred, throw exception
        catch (Exception $e) {
            throw new Exception("Exception: " . $e->getMessage(), 0, $e);
        }
    }

    
    /**
     * {@inheritDoc}
     * 
     * @see \App\Data\DataServiceInterface::delete()
     */
    public function delete($id) {
       
    	try {
    		// SQL delete statement to delete all group member associations to a group
            $sqlGroupMembers = "DELETE FROM `GROUP_MEMBERS` WHERE `GROUP_ID`= {$id};";
            // SQL delete statement to delete a group
            $sqlGroups = "DELETE FROM `GROUPS` WHERE `ID`= {$id};";
            
            // Run the queries
            $this->connection->query($sqlGroupMembers);
            $this->connection->query($sqlGroups);
            
            // Get and return the number of rows affected by the delete
            $numRowsAffected = $this->connection->affected_rows;
            return $numRowsAffected;
        } 
        // An error occurred, throw exception
        catch (Exception $e) {
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
            // Create an array and index for groups
            $groups = array();
            $indexGroups = 0;
            
            // SQL select statement to get all groups, run query
            $sqlGroups = "SELECT * FROM GROUPS";     
            $resultsGroups = mysqli_query($this->connection, $sqlGroups);
            
            // Iterate through each row retrieved
            while ($row = $resultsGroups->fetch_assoc()) {
                
            	// Get the ID column from the results and set to variable
                $id = $row['ID'];
                
                // Get the current group by calling viewById method
                $currentGroup = $this->viewById($id);
                
                // Set the current array position to the current group, increment index
                $groups[$indexGroups] = $currentGroup;
                $indexGroups ++;
            }
            
            // Return the array of groups
            return $groups;
        } 
        // An error occurred, throw exception
        catch (Exception $e) {
            throw new Exception("Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    
    /**
     * {@inheritDoc}
     *
     * @see \App\Data\DataServiceInterface::viewById()
     */
    public function viewById(int $id) {
    	
    	try {
    		// SQL select statement to get a group given the id, run query
    		$sqlGroups = "SELECT * FROM GROUPS WHERE ID = {$id}";
    		$resultsGroups = mysqli_query($this->connection, $sqlGroups);
    		
    		// Set results to associative array and set the table columns to varibles
    		$rowGroups = $resultsGroups->fetch_assoc();
    		$name = $rowGroups['NAME'];
    		$description = $rowGroups['DESCRIPTION'];
    		
    		// Create a new group object using the variables
    		$currentGroup = new Group($id, $name, $description);
    		
    		// Return the group
    		return $currentGroup;
    	} 
    	// An error occurred, throw exception
    	catch (Exception $e) {
    		throw new Exception("Exception: " . $e->getMessage(), 0, $e);
    	}
    }
    
    
    // ---------------------- End of data interface implementation -------------------
    
    
    /**
     * Method to get all of the ID's of a user's groups
     * 
     * @param $username - String: The username of the user that the groups are associated with
     * @throws Exception
     * @return $groupsId - Array<Group>: A list (or array) of a user's group id's
     */
    public function viewAllById($username){
        try {
        	// Create an array and index for group id's
            $groupIds = array();
            $index = 0;
            
            // SQL select statement to get a group given the username, run query
            $sqlGroups = "SELECT * FROM `GROUP_MEMBERS` WHERE `USERNAME` = '{$username}'";
            $resultsGroups = mysqli_query($this->connection, $sqlGroups);
            
            // Iterate through the results
            while ($row = $resultsGroups->fetch_assoc()) {
            	// Get the ID column from the results and set to variable
                $id = $row['GROUP_ID'];
                
                // Set the current array position to the current group, increment index
                $groupIds[$index] = $id;
                $index ++;
            }
            
            // Return the array of group id's
            return $groupIds;   
        } 
        // An error occurred, throw exception
        catch (Exception $e) {
            throw new Exception("Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    
    /**
     * Method to get all usernames of the user's that are in a group
     * 
     * @param $groupId - Integer: The ID of a group
     * @throws Exception
     * @return $groupUsers - String: The string of usernames separated by commas
     */
    public function getUsers($groupId){
    	
    	try {
			// Create an empty string for the users list
    		$groupUsers = "";
    		
    		// SQL select statement to get all rows with a given group id, run query
    		$sqlUsers = "SELECT * FROM `GROUP_MEMBERS` WHERE `GROUP_ID` = {$groupId}";
    		$resultsGroups = mysqli_query($this->connection, $sqlUsers);
    		
    		// Iterate through the results
    		while ($row = $resultsGroups->fetch_assoc()) {
    			// Get the username column from the results and set to variable
    			$username = $row['USERNAME'];
    			// Add the username to the string of users
    			$groupUsers = $groupUsers . $username . ", ";
    		}
    		
    		// Substring to eliminate the last comma
    		$groupUsers = substr($groupUsers, 0, strlen($groupUsers) - 2);
    		
    		// Return the string of usernames
    		return $groupUsers;
    	} 
    	// An error occurred, throw exception
    	catch (Exception $e) {
    		throw new Exception("Exception: " . $e->getMessage(), 0, $e);
    	}
    }
    
    
    /**
     * Method to join a group
     * 
     * @param $groupId - Integer: The ID of a group
     * @param $username - String: The username of the user that the groups are associated with
     * @throws Exception
     * @return $numRowsAffected - Integer: The number of rows affected by the insert
     */
    public function join($groupId, $username){
    	try {
    		// SQL insert statement to create a group member association within the database, run the query
    		$sqlGroupMember = "INSERT INTO `GROUP_MEMBERS` (`GROUP_ID`, `USERNAME`) VALUES ('{$groupId}', '{$username}');";
    		$this->connection->query($sqlGroupMember);
    		
    		// Get and return the number of rows affected by the insert
    		$numRowsAffected = $this->connection->affected_rows;
    		return $numRowsAffected;
    	} 
    	// An error occurred, throw exception
    	catch (Exception $e) {
    		throw new Exception("Exception: " . $e->getMessage(), 0, $e);
    	}
    }
    

    /**
     * Method to leave a group
     * 
     * @param $groupId - Integer: The ID of a group
     * @param $username - String: The username of the user that the groups are associated with
     * @throws Exception
     * @return $numRowsAffected - Integer: The number of rows affected by the insert
     */
    public function leave($groupId, $username){
        try {
        	// SQL delete statement to delete the group member association of the given group and username, run the query
            $sqlGroupMember = "DELETE FROM `GROUP_MEMBERS` WHERE `GROUP_ID` = {$groupId} AND `USERNAME`= '{$username}';";
            $this->connection->query($sqlGroupMember);
            
            // Get and return the number of rows affected by the delete
            $numRowsAffected = $this->connection->affected_rows;
            return $numRowsAffected;
        } 
        // An error occurred, throw exception
        catch (Exception $e) {
            throw new Exception("Exception: " . $e->getMessage(), 0, $e);
        }
    }
}

