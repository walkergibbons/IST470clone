<?php
//Database connection.
$con = MySQLi_connect(
   "localhost", //Server host name.
   "root", //Database username.
   "ro34k189sKp7Af", //Database password.
   "ist470" //Database name or anything you would like to call it.
);
//Check connection
if (MySQLi_connect_errno()) {
   echo "Failed to connect to MySQL: " . MySQLi_connect_error();
}
?>
