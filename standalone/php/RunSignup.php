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
	public $topUrl = "https://runsignup.com/Rest/";

	public $firstName = "";
	public $lastName = "";
	public $userData;
	public $key;
	public $secret;
	public $loggedIn = false;
	
	// Our main constructor
	function __construct() {
		if (file_exists("config.php"))
			require("config.php");
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

	function doHttpPostRequest($url, $params) {
		$success = false;

		$curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($curl);
		$errMsg = "";
		
		$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($httpCode == 404) {
			$errMsg = "404: Resource not found";
		}
        else if ($httpCode == 302) {
			$errMsg = "302: Server not found";
		}
        else if ($httpCode == 500) {
			$errMsg = "500: Server error";
		}
        else if ($httpCode == 200) {
			$errMsg = "";
			$success = true;
		}
		$this->lastErrorMessage = $errMsg;
		return($result);
		
	}
	
		
		

	/*
	 * =======================================================
	 * == The main RunSignup methods are located down here. ==
	 * =======================================================
	 */
	function login($username, $password) {

		$url = $this->topUrl."login?format=json";
		$parms = array();
		$params['email'] = $username;
		$params['password'] = $password;

		$result = $this->doHttpPostRequest($url,$params);
		if ($result != true) {
			echo "Error: \n";
			return(false);
		}
		$data = json_decode($result, true);
		
		$this->key = $data['tmp_key']."\n";
		$this->secret = $data['tmp_secret']."\n";
		$users = $data['user'];
		foreach ($users as $user) {
			$this->userData = $user;
			$this->firstName = $user['first_name'];
			$this->lastName = $user['last_name'];
		}
		$this->loggedIn = true;
		return(true);
	}
}

