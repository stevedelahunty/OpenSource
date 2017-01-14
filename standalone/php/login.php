<?php
  /*
   * Author: Steve Delahunty (steve.delahunty@gmail.com)
   *
   * Simple script to accept a username/password from the command line
   * and calling the (deprecated) login() method.
   */
require("common.php");

$api = new RunsignupApi();

if ($api->login($username, $password) == false) {
	echo "ERROR: Unable to login.\n";
	echo "  Reason: ".$api->getLastErrorMessage()."\n";
	return;
}
echo "Successful login. Hello ".$api->firstName." ".$api->lastName."\n";


