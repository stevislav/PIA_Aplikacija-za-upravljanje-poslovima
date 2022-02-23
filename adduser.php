<?php

session_start();
require_once("db.php");

if(isset($_POST)) {

	$firstname = mysqli_real_escape_string($conn, $_POST['fname']);
	$lastname = mysqli_real_escape_string($conn, $_POST['lname']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);
	$city = mysqli_real_escape_string($conn, $_POST['city']);
	$state = mysqli_real_escape_string($conn, $_POST['state']);
	$contactno = mysqli_real_escape_string($conn, $_POST['contactno']);
	$qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
	$stream = mysqli_real_escape_string($conn, $_POST['stream']);
	$passingyear = mysqli_real_escape_string($conn, $_POST['passingyear']);
	$dob = mysqli_real_escape_string($conn, $_POST['dob']);
	$age = mysqli_real_escape_string($conn, $_POST['age']);
	$designation = mysqli_real_escape_string($conn, $_POST['designation']);
	$aboutme = mysqli_real_escape_string($conn, $_POST['aboutme']);
	$skills = mysqli_real_escape_string($conn, $_POST['skills']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	//enkripcija lozinke
	$password = base64_encode(strrev(md5($password)));

	//sql query za proveru mejla
	$sql = "SELECT email FROM users WHERE email='$email'";
	$result = $conn->query($sql);

	//ako mejl nije nadjen nastavlja se dalje
	if($result->num_rows == 0) {

	$uploadOk = true;

	//folder gde je cv
	$folder_dir = "uploads/resume/";

	//naziv fajla
	$base = basename($_FILES['resume']['name']); 

	//ekstenzija fajla
	$resumeFileType = pathinfo($base, PATHINFO_EXTENSION); 

	//stavljanje unikatnog imena fajla
	$file = uniqid() . "." . $resumeFileType;   

	//folder gde se cuvaju fajlovi
	$filename = $folder_dir .$file;  

	//provera da li je fajl sacuvan na temp lokaciju
	if(file_exists($_FILES['resume']['tmp_name'])) { 

		//provera da li fajl ima odgovarajucu ekstenziju
		if($resumeFileType == "pdf")  {

			//provera velicine fajla
			if($_FILES['resume']['size'] < 500000) { // fajl manji od 5 megabajta

				//kopiranje cv-ja 
				move_uploaded_file($_FILES["resume"]["tmp_name"], $filename);

			} else {
				//greska u velicini
				$_SESSION['uploadError'] = "Pogrešna veličina. Maksimalna dozvoljenja veličina : 5MB";
				$uploadOk = false;
			}
		} else {
			//greska u formatu
			$_SESSION['uploadError'] = "Pograšan format. Samo PDF format dozvoljen";
			$uploadOk = false;
		}
	} else {
			//greska kad fajl nije kopiran u temp lokaciju
			$_SESSION['uploadError'] = "Došlo je do greške. Pokušaj ponovo.";
			$uploadOk = false;
		}

	//ukoliko postoji greska vrati se nazad.
	if($uploadOk == false) {
		header("Location: register-candidates.php");
		exit();
	}

		$hash = md5(uniqid());


		//sql insert query
		$sql = "INSERT INTO users(firstname, lastname, email, password, address, city, state, contactno, qualification, stream, passingyear, dob, age, designation, resume, hash, aboutme, skills) VALUES ('$firstname', '$lastname', '$email', '$password', '$address', '$city', '$state', '$contactno', '$qualification', '$stream', '$passingyear', '$dob', '$age', '$designation', '$file', '$hash', '$aboutme', '$skills')";

		if($conn->query($sql)===TRUE) {
			$_SESSION['registerCompleted'] = true;
			header("Location: login-candidates.php");
			exit();
		} else {
			//greska pri unosu u tabelu
			echo "Error " . $sql . "<br>" . $conn->error;
		}
	} else {
		//greska ako mejl vec postoji
		$_SESSION['registerError'] = true;
		header("Location: register-candidates.php");
		exit();
	}

	$conn->close();

} else {
	//vracanje na stranicu za registraciju
	header("Location: register-candidates.php");
	exit();
}