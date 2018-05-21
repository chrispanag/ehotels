<?php

$con = mysqli_connect("172.16.238.12","root","","ehotels");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
return $con;


?>