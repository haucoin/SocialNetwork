<?php

namespace App\Data;

/**
 * @name Social Network
 * @version 7.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - DataServiceInterface is an interface used to define the structure for all data services
 */
interface DataServiceInterface {
    
	// Default constructor
    function __construct();
    
    
    /**
     * Method to create an object within a database table by passing it to the data service
     * @param $object - Generic: An object Model
     */
    public function create($object);
    
    
    /**
     * Method to update an object within a database table by passing it to the data service
     * @param $object - Generic: An object Model
     */
    public function update($object);
    
    
    /**
     * Method to delete an object from a database table by passing the id to the data service
     * @param $id - Integer: The id number of an object within the database
     */
    public function delete(int $id);
    
    
    /**
     * Method to view all objects within a database table
     */
    public function viewAll();
    
    
    /**
     * Method to view an object within a database table by passing the id to the data service
     * @param $id - Integer: The id number of an object within the database
     */
    public function viewById(int $id);
    
    
}