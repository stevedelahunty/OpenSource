<?php
  /*
   * Author: Steve Delahunty (steve.delahunty@gmail.com)
   *
   * Simple script to accept a username/password from the command line
   * and calling the (deprecated) login() method.
   */
require("RunsignupApi.php");

$argc = sizeof($argv);
if ($argc != 3) {
	echo "Usage: ".$argv[0]." username password\n";
	return;
}
$username = $argv[1];
$password = $argv[2];


$api = new RunsignupApi();
$api->enableDebug();
$api->debug("Attempting to login using (deprecated) login() method...");
$api->debug("Created the API object.");
if ($api->login($username, $password) == false) {
	echo "ERROR: Unable to login.\n";
	echo "  Reason: ".$api->getLastErrorMessage()."\n";
	return;
}


