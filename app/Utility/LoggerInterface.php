<?php

namespace App\Utility;

/**
 * @name Social Network
 * @version 7.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - LoggerInterface is an interface for the logger class to implement
 */
interface LoggerInterface {
	
	/**
	 * Method to log debug statements
	 * 
	 * @param $message
	 * @param $data
	 */
	public function debug($message, $data);
	
	
	/**
	 * Method to log info statements
	 * 
	 * @param $message
	 * @param $data
	 */
	public function info($message, $data);
	
	
	/**
	 * Method to log warning statements
	 * 
	 * @param $message
	 * @param $data
	 */
	public function warning($message, $data);
	
	
	/**
	 * Method to log error statements
	 * 
	 * @param $message
	 * @param $data
	 */
	public function error($message, $data);
}

