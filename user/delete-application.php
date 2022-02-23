<?php

session_start();

if(empty($_SESSION['id_user'])) {
  header("Location: index.php");
  exit();
}

require_once("../db.php");

if(isset($_GET)) {
	$sql = "DELETE FROM apply_job_post WHERE id_jobpost='$_GET[appid]' AND id_user='$_GET[userid]'";
	if($conn->query($sql)) {
		header("Location: index.php");
		exit();
	} else {
		echo $_GET['appid'];
		echo $_GET['userid'];
		echo "Error";
	}
}