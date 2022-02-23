<?php

session_start();
require_once("db.php");

//provera da li je korisnik ulogovan
if(isset($_POST)) {

	$sql = "SELECT * FROM cities WHERE state_id='$_POST[id]'";
	$result = $conn->query($sql);

	//provera tabele da li sadrzi informacije o korisniku
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {

			echo '<option value="'.$row["name"].'" data-id="'.$row["id"].'">'.$row["name"].'</option>';

			}
			
	}

 	//zatvaranje konekcije
 	$conn->close();

} 