<?php

namespace App\Data;

/**
 * @name Social Network
 * @version 2.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - Database is a class used to make a connection the the MySQL database within phpMyAdmin
 */
Class Database  {
	
	// Define the properties of a database connection
    private $servername = "localhost";
    private $username = "root";
    private $password = "root";
    private $dbName = "SocialNetwork";
    
    
    /**
     * Method to get a connection to the database using mysqli
     * @return $connection - Connection: The connection object to the database
     */
    function getConnection() {
        // Create connection
    	$connection = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);
        
        // Check connection
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        return $connection;
    }
}