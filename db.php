<?php

//konfiguracija
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "job_portal";

//kreiraj konekciju
$conn = new mysqli($servername, $username, $password, $dbname);

//provera konekcije
if($conn->connect_error) {
	die("Connection Failed: ". $conn->connect_error);
}