<?php
  /*
   * Author: Steve Delahunty (steve.delahunty@gmail.com)
   *
   * This script gets called by all the other scripts so add in code
   * which is common among them all. For example, we test and load
   * the config.php file here since all the other scripts need that
   * functionality.
   *
   */
require_once("RunSignup.php");

  // Declare and init global variables
$username = "";
$password = "";

/*
 * Is there a config file present? If so, load it. Otherwise, copy
 * the sample over and display a message that the script should be
 * customized.
 */
if (file_exists("config.php") == false) {
	copy("config.php.sample", "config.php");
	echo "Please edit the file 'config.php' and add ";
	echo "your username and password. \nThen, re-run this script\n";
	exit(0);
}

// Include the config file.
require_once("config.php");

/*
 * Make sure username and password are actually defined.
 */
if ($username == "" || $password == "") {
	echo "Please edit the file 'config.php' and add ";
	echo "your username and password. \nThen, re-run this script\n";
	exit(0);
}

