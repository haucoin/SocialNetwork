<?php

namespace App\Business;

/**
 * @name Social Network
 * @version 4.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - BusinessServiceInterface is an interface used to define the structure for all business services
 */
interface BusinessServiceInterface {
    
	// Default constructor
    function __construct();
    
    
    /**
     * Method to create an object by sending it to the data service
     * @param $object - Generic: An object Model
     */
    public function create($object);
    
    
    /**
     * Method to update an object by sending it to the data service
     * @param $object - Generic: An object Model
     */
    public function update($object);
    
    
    /**
     * Method to delete an object by sending the id to the data service
     * @param $id - Integer: The id number of an object within the database
     */
    public function delete(int $id);
    
    
    /**
     * Method to view all objects by requesting them from the data service
     */
    public function viewAll();
    
    
    /**
     * Method to view an object by sending the id to the data service
     * @param $id - Integer: The id number of an object within the database
     */
    public function viewById(int $id);
    
}
