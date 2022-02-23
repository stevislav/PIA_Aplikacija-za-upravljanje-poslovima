<?php

session_start();
require_once("db.php");

//provera da li je korisnik kliknuo na dugme za prijavu
if(isset($_POST)) {

	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	//enkripcija lozinke
	$password = base64_encode(strrev(md5($password)));

	//sql query za proveru logovanja
	$sql = "SELECT id_company, companyname, email, active FROM company WHERE email='$email' AND password='$password'";
	$result = $conn->query($sql);

	//ako tabela ima podatke o korisniku
	if($result->num_rows > 0) {
		//prikaz podataka
		while($row = $result->fetch_assoc()) {

			if($row['active'] == '2') {
				$_SESSION['companyLoginError'] = "Vaš profil je još uvek na listi čekanja.";
				header("Location: login-company.php");
				exit();
			} else if($row['active'] == '0') {
				$_SESSION['companyLoginError'] = "Vaš profil je odbijen.";
				header("Location: login-company.php");
				exit();
			} else if($row['active'] == '1') {
				// active 1 znaci da je admin prihvatio profil.
				$_SESSION['name'] = $row['companyname'];
				$_SESSION['id_company'] = $row['id_company'];

				//prosledjivanje na profil kompanije
				header("Location: company/index.php");
				exit();
			} else if($row['active'] == '3') {
				$_SESSION['companyLoginError'] = "Vaš profil je deaktiviran. Kontaktirajte admina za reaktivaciju.";
				header("Location: login-company.php");
				exit();
			}
		}
 	} else {
 		//vracanje na stranicu za logovanje
 		$_SESSION['loginError'] = $conn->error;
 		header("Location: login-company.php");
		exit();
 	}

 	$conn->close();

} else {
	//vracanje na stranicu za logovanje
	header("Location: login-company.php");
	exit();
}