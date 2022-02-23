<?php

session_start();

require_once("db.php");

if(isset($_POST)) {

	$companyname = mysqli_real_escape_string($conn, $_POST['companyname']);
	$contactno = mysqli_real_escape_string($conn, $_POST['contactno']);
	$website = mysqli_real_escape_string($conn, $_POST['website']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	$country = mysqli_real_escape_string($conn, $_POST['country']);
	$state = mysqli_real_escape_string($conn, $_POST['state']);
	$city = mysqli_real_escape_string($conn, $_POST['city']);

	$aboutme = mysqli_real_escape_string($conn, $_POST['aboutme']);
	$name = mysqli_real_escape_string($conn, $_POST['name']);

	//Enkripcija lozinke
	$password = base64_encode(strrev(md5($password)));

	//sql query za proveru mejla
	$sql = "SELECT email FROM company WHERE email='$email'";
	$result = $conn->query($sql);

	//ukoliko mejl nije nadjen napravi novog korisnika
	if($result->num_rows == 0) {

		//za greske prilikom uploada
		$uploadOk = true;

		//folder za cuvanje slika
		$folder_dir = "uploads/logo/";

		//za lokaciju cv-a
		$base = basename($_FILES['image']['name']); 

		//provera ekstenzije fajla
		$imageFileType = pathinfo($base, PATHINFO_EXTENSION); 
		$file = uniqid() . "." . $imageFileType; 
	  
		//gde se cuvaju fajlovi
		$filename = $folder_dir .$file;  

		//provera da li je fajl sacuvan
		if(file_exists($_FILES['image']['tmp_name'])) { 

			//provera da li je dozvoljena ekstenzija
			if($imageFileType == "jpg" || $imageFileType == "png")  {

				//provera velicine fajla
				if($_FILES['image']['size'] < 500000) { // fajl manji od 5 megabajta

					//kopiraj fajl sa servera u upload folder
					move_uploaded_file($_FILES["image"]["tmp_name"], $filename);

				} else {
					//Greska u velicini
					$_SESSION['uploadError'] = "Pogrešna veličina. Maksimalna dozvoljena veličina : 5MB";
					$uploadOk = false;
				}
			} else {
				//greska u formatu
				$_SESSION['uploadError'] = "Pogrešan format. Samo .jpg i .png dozvoljeni.";
				$uploadOk = false;
			}
		} else {
				//fajl nije kopiran
				$_SESSION['uploadError'] = "Fajl nije dodat. Pokušajte ponovo.";
				$uploadOk = false;
			}

		//ako ima greske vrati nazad.
		if($uploadOk == false) {
			header("Location: register-company.php");
			exit();
		}

		//sql  insert query
		$sql = "INSERT INTO company(name, companyname, country, state, city, contactno, website, email, password, aboutme, logo) VALUES ('$name', '$companyname', '$country', '$state', '$city', '$contactno', '$website', '$email', '$password', '$aboutme', '$file')";

		if($conn->query($sql)===TRUE) {
			//ako je uspesno dodato vrati na stranicu za logovanje
			$_SESSION['registerCompleted'] = true;
			header("Location: login-company.php");
			exit();

		} else {
			//prikaz greske
			echo "Error " . $sql . "<br>" . $conn->error;
		}
	} else {
		//greska ako je email vec u upotrebi
		$_SESSION['registerError'] = true;
		header("Location: register-company.php");
		exit();
	}

	//zatvaranje baze
	$conn->close();

} else {
	//vracanje na stranicu za registraciju 
	header("Location: register-company.php");
	exit();
}