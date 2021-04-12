<?php

namespace App\Utility;

use Illuminate\Support\Facades\Log;

/**
 * @name Social Network
 * @version 7.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - Logger is a class that implements the LoggerInterface and handles all logging statement
 */
class Logger implements LoggerInterface {
	
	/**
	 * {@inheritDoc}
	 * @see \App\Utility\LoggerInterface::debug()
	 */
	public function debug($message, $data=array()) {
		Log::debug($message . (count($data) != 0 ? 'with data of ' . print_r($data, true) : ""));
	}
	
	
	/**
	 * {@inheritDoc}
	 * @see \App\Utility\LoggerInterface::warning()
	 */
	public function warning($message, $data=array()) {
		Log::warning($message . (count($data) != 0 ? 'with data of ' . print_r($data, true) : ""));
	}
	
	
	/**
	 * {@inheritDoc}
	 * @see \App\Utility\LoggerInterface::error()
	 */
	public function error($message, $data=array()) {
		Log::error($message . (count($data) != 0 ? 'with data of ' . print_r($data, true) : ""));
	}
	
	
	/**
	 * {@inheritDoc}
	 * @see \App\Utility\LoggerInterface::info()
	 */
	public function info($message, $data=array()) {
		Log::info($message . (count($data) != 0 ? 'with data of ' . print_r($data, true) : ""));
	}  
}

