<?php

session_start();

if(empty($_SESSION['id_user'])) {
  header("Location: ../index.php");
  exit();
}

require_once("../db.php");

if(isset($_POST)) {

	$stmt = $conn->prepare("INSERT INTO comments(id_company, comment, rating) VALUES (?,?,?)");

	$stmt->bind_param("isi", $_GET['id_company'], $comment, $rating);

	$comment = mysqli_real_escape_string($conn, $_POST['comment']);
	$rating = mysqli_real_escape_string($conn, $_POST['rating']);

	if($stmt->execute()) {
		$_SESSION['CommentSuccess'] = true;
		header("Location: index.php");
		exit();
	} else {
		echo "Error ";
		echo $comment;
		echo $rating;
		echo $_GET['id_company'];

	}

	$stmt->close();

	
	$conn->close();

} else {
	//nazad
	header("Location: company.php");
	exit();
}