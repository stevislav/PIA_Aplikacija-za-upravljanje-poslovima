<?php

session_start();

if(empty($_SESSION['id_company'])) {
  header("Location: ../index.php");
  exit();
}

require_once("../db.php");

if(isset($_POST)) {

	$name = mysqli_real_escape_string($conn, $_POST['name']);

	//sql query za proveru logovanja
	$sql = "UPDATE company SET name='$name' WHERE id_company='$_SESSION[id_company]'";
	if($conn->query($sql) === true) {
		header("Location: index.php");
		exit();
	} else {
		echo $conn->error;
	}

 	$conn->close();

} else {
	header("Location: settings.php");
	exit();
}