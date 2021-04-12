<?php
namespace App\Models;

use JsonSerializable;

/**
 * @name Social Network
 * @version 7.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - DTO is a model class used to hold the code status, message, and data being passed in any HTTP calls within the REST APIs
 */
class DTO implements \JsonSerializable {
    
    // Define the properties of a DTO
	private $errorCode;
    private $errorMessage;
    private $data;
    
    
    /**
     * Non-default constructor to intialize an object
     *
     * @param $errorCode - Integer: The code status of an HTTP request
     * @param $errorMessage - String: The message of an HTTP request
     * @param $data - Object: The data that is being passed from the HTTP request
     */
    public function __construct($errorCode, $errorMessage, $data){
        
    	$this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage;
        $this->data = $data;
    }
    
    
    /**
     * Method to serialize the object as json
     * 
     * {@inheritDoc}
     * @see JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize() {
    	return get_object_vars($this);
    }
}

