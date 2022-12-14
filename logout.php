<?php
session_start();
if(isset($_SESSION['role'])) {
	session_destroy();
	unset($_SESSION['id']);
	unset($_SESSION['username']);
	unset($_SESSION['firstname']);
	unset($_SESSION['lastname']);
	unset($_SESSION['email']);
	unset($_SESSION['role']);
	unset($_SESSION['image']);
}
header("Location: index.php");
?>