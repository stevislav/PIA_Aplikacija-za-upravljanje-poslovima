<?php

session_start();

if(empty($_SESSION['id_admin'])) {
  header("Location: ../index.php");
  exit();
}

require_once("../db.php");

if(isset($_POST)) {

	$companyname = mysqli_real_escape_string($conn, $_POST['companyname']);
	$website = mysqli_real_escape_string($conn, $_POST['website']);
	$city = mysqli_real_escape_string($conn, $_POST['city']);
	$state = mysqli_real_escape_string($conn, $_POST['state']);
	$contactno = mysqli_real_escape_string($conn, $_POST['contactno']);
	$aboutme = mysqli_real_escape_string($conn, $_POST['aboutme']);

	$uploadOk = true;

	if(is_uploaded_file ( $_FILES['image']['tmp_name'] )) {

		$folder_dir = "../uploads/logo/";

		$base = basename($_FILES['image']['name']); 

		$imageFileType = pathinfo($base, PATHINFO_EXTENSION); 

		$file = uniqid() . "." . $imageFileType; 
	  
		$filename = $folder_dir .$file;  

		if(file_exists($_FILES['image']['tmp_name'])) { 

			if($imageFileType == "jpg" || $imageFileType == "png")  {

				if($_FILES['image']['size'] < 500000) { //fajl manji od 5mb

					//kopiraj u folder
					move_uploaded_file($_FILES["image"]["tmp_name"], $filename);

				} else {
					$_SESSION['uploadError'] = "Pogrešna veličina. Maksimalna dozvoljena veličina 5MB.";
					header("Location: edit-company.php");
					exit();
				}
			} else {
				$_SESSION['uploadError'] = "Pogrešan format. Samo .jpg i .png su podržani formati.";
				header("Location: edit-company.php");
				exit();
			}
		}
	} else {
		$uploadOk = false;
	}

	

	//azuriranje tabele
	$sql = "UPDATE company SET companyname='$companyname', website='$website', city='$city', state='$state', contactno='$contactno', aboutme='$aboutme'";

	if($uploadOk == true) {
		$sql = $sql . ", logo='$file'";
	}
	
	$sql = $sql . " WHERE id_company='$_GET[id_company]'";
	$check=$_GET[id_company];

	if($conn->query($sql) === TRUE) {
		$_SESSION['name'] = $companyname;
		header("Location: dashboard.php?check=$check");
		exit();
	} else {
		echo "Error ". $sql . "<br>" . $conn->error;
	}
	$conn->close();

} else {
	//povratak na pocetnu stranu
	header("Location: edit-company.php?check=$check");
	exit();
}