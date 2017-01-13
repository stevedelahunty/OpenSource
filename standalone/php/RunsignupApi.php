<?php
  /*
   * Author: Steve Delahunty (steve.delahunty@gmail.com)
   *
   * My attempt at creating a PHP class that implements the Runsignup API. The
   * intent is to create an extremely useful and simplified object that is easily
   * understood and performs useful functions.
   */
class RunsignupApi
{
	public $debuggerEnabled = false;
	public $lastErrorMessage = "";
	
	// Our main constructor
	function __construct() {
	}

	function getLastErrorMessage() {
		return($this->lastErrorMessage);
	}

	/*
	 * Generate a debug message.
	 */
	function enableDebug() {
		$this->debuggerEnabled = true;
	}
	
	function debug($msg) {
		if ($this->debuggerEnabled == false) return;
		
		list($usec, $sec) = explode(" ", microtime());
		$now = time();
		$t = ((float)$usec + (float)$sec);
		$s = date("s", $now) + $usec;
		
		$d = date("D M d G:i", $now);
		echo $d.":".$s." ".$msg."\n";
	}


	/*
	 * =======================================================
	 * == The main RunSignup methods are located down here. ==
	 * =======================================================
	 */
	function login($username, $password) {
		$this->lastErrorMessage = "Not implemented";
		return(false);
	}
}

