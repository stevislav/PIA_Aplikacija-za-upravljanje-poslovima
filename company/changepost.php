<?php

session_start();

if(empty($_SESSION['id_company'])) {
  header("Location: ../index.php");
  exit();
}

require_once("../db.php");

if(isset($_POST)) {

	$jobtitle = mysqli_real_escape_string($conn, $_POST['jobtitle']);
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$minimumsalary = mysqli_real_escape_string($conn, $_POST['minimumsalary']);
	$maximumsalary = mysqli_real_escape_string($conn, $_POST['maximumsalary']);
	$experience = mysqli_real_escape_string($conn, $_POST['experience']);
	$qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
	$companyid=$_GET[id_company];
	
	$sql = "UPDATE job_post SET jobtitle='$jobtitle', description='$description', minimumsalary='$minimumsalary', maximumsalary='$maximumsalary', experience='$experience', qualification='$qualification' WHERE id_company=$_GET[id_company] AND id_jobpost=$_GET[id_post]" ;
	
	if($conn->query($sql)===TRUE) {
		//ako je uspesno vrati na prethodnu stranicu
		$_SESSION['jobChangeSuccess'] = true;
		header("Location: my-job-post.php");
		exit();
	} else {
		//ako nije uspesno prikazi gresku
		echo "Error ";
	}

	$conn->close();

} else {
	header("Location: my-job-post.php");
	exit();
}