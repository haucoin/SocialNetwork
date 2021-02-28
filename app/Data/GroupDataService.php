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
     * @see \App\Data\DataServiceInterface::viewById()
     */
    public function viewById(int $id)
    {
        try {
            // Select statment for profiles
            $sqlGroups = "SELECT * FROM GROUPS WHERE ID = {$id}";

            $resultsGroups = mysqli_query($this->connection, $sqlGroups);

            $rowGroups = $resultsGroups->fetch_assoc();

            $name = $rowGroups['NAME'];
            $description = $rowGroups['DESCRIPTION'];

            $currentGroup = new Group($id, $name, $description);

            return $currentGroup;
        } catch (Exception $e) {
            // Throw exception
            throw new Exception("Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * {@inheritDoc}
     * 
     * @see \App\Data\DataServiceInterface::create()
     */
    public function create($object)
    {
        try {
            // Creates an inital profiles object for the user object
            $sqlGroups = "INSERT INTO `GROUPS` (`NAME`, `DESCRIPTION`)
	                           VALUES ('{$object->getName()}', '{$object->getDescription()}');";
            
            // Runs the querys through the database
            $result = $this->connection->query($sqlGroups);
            
            return $result;
        } catch (Exception $e) {
            // Throw exception
            throw new Exception("Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * {@inheritDoc}
     * 
     * @see \App\Data\DataServiceInterface::update()
     */
    public function update($object)
    {
        try {
            
            $sqlGroups = "UPDATE `GROUPS` SET `NAME` = '{$object->getName()}', DESCRIPTION` = '{$object->getDescription()}' WHERE `GROUPS`.`ID` = {{$object->getId()}};";
            
            $this->connection->query($sqlGroups);
            $numRowsAffected = $this->connection->affected_rows;
            
            // Return the number of rows affected by the update
            return $numRowsAffected;
        } catch (Exception $e) {
            // Throw exception
            throw new Exception("Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * {@inheritDoc}
     * 
     * @see \App\Data\DataServiceInterface::delete()
     */
    public function delete($id)
    {
        try {
            
            $sqlGroupMembers = "DELETE FROM `GROUP_MEMBERS` WHERE `GROUP_ID`= {$id};";
            $sqlGroups = "DELETE FROM `GROUPS` WHERE `ID`= {$id};";
            
            $this->connection->query($sqlGroupMembers);
            $this->connection->query($sqlGroups);
            $numRowsAffected = $this->connection->affected_rows;
            
            // Returns the number of rows affected
            return $numRowsAffected;
        } catch (Exception $e) {
            // Throw exception
            throw new Exception("Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * {@inheritDoc}
     * 
     * @see \App\Data\DataServiceInterface::viewAll()
     */
    public function viewAll()
    {
        try {
            
            $groups = array();
            $indexGroups = 0;
            
            $sqlGroups = "SELECT * FROM GROUPS";
            
            $resultsGroups = mysqli_query($this->connection, $sqlGroups);
            
            while ($row = $resultsGroups->fetch_assoc()) {
                
                $id = $row['ID'];
                
                $currentGroup = $this->viewByID($id);
                
                $groups[$indexGroups] = $currentGroup;
                $indexGroups ++;
            }
            
            return $groups;
            
        } catch (Exception $e) {
            
            throw new Exception("Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * @param $username - String: The Username of the user that the Groups are associated with
     * @throws Exception
     * @return $groupsId[]
     */
    public function viewAllById($username){
        try {
            
            $groupIds = array();
            $index = 0;
            
            $sqlGroups = "SELECT * FROM `GROUP_MEMBERS` WHERE `USERNAME` = '{$username}'";

            $resultsGroups = mysqli_query($this->connection, $sqlGroups);
            
            while ($row = $resultsGroups->fetch_assoc()) {
                
                $id = $row['GROUP_ID'];
                
                $groupIds[$index] = $id;
                $index ++;
            }
            
            return $groupIds;
            
        } catch (Exception $e) {

            throw new Exception("Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    
    public function getUsers($groupId){
    	try {
    		
    		$groupUsers = "";
    		
    		$sqlUsers = "SELECT * FROM `GROUP_MEMBERS` WHERE `GROUP_ID` = {$groupId}";
    		
    		$resultsGroups = mysqli_query($this->connection, $sqlUsers);
    		
    		while ($row = $resultsGroups->fetch_assoc()) {
    			
    			$user = $row['USERNAME'];
    			
    			$groupUsers = $groupUsers . $user . ", ";
    		}
    		
    		return substr($groupUsers, 0, strlen($groupUsers) - 2);
    		
    	} catch (Exception $e) {
    		
    		throw new Exception("Exception: " . $e->getMessage(), 0, $e);
    	}
    }
    
    
    public function join($groupId, $username){
    	try {
    		
    		$sqlGroupMember = "INSERT INTO `GROUP_MEMBERS` (`GROUP_ID`, `USERNAME`) VALUES ('{$groupId}', '{$username}');";
    		
    		$this->connection->query($sqlGroupMember);
    		$numRowsAffected = $this->connection->affected_rows;
    		
    		// Returns the number of rows affected
    		return $numRowsAffected;
    	} catch (Exception $e) {
    		// Throw exception
    		throw new Exception("Exception: " . $e->getMessage(), 0, $e);
    	}
    }
    

    public function leave($groupId, $username){
        try {
            
            $sqlGroupMember = "DELETE FROM `GROUP_MEMBERS` WHERE `GROUP_ID` = {$groupId} AND `USERNAME`= '{$username}';";
           
            
            $this->connection->query($sqlGroupMember);
            $numRowsAffected = $this->connection->affected_rows;
            
            // Returns the number of rows affected
            return $numRowsAffected;
        } catch (Exception $e) {
            // Throw exception
            throw new Exception("Exception: " . $e->getMessage(), 0, $e);
        }
    }
}

