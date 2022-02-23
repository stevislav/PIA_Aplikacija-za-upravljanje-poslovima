<?php

session_start();
require_once("db.php");

//provera da li je korisnik kliknuo na dugme za logovanje
if(isset($_POST)) {

	$sql = "SELECT * FROM states WHERE country_id='$_POST[id]'";
	$result = $conn->query($sql);

	//provera da li korisnik postoji u tabeli
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {

			echo '<option value="'.$row["name"].'" data-id="'.$row["id"].'">'.$row["name"].'</option>';

			}
			
	}
 	//zatvaranje konekcije
 	$conn->close();

} 