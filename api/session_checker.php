<?php
include 'db.php';
session_start();
if (isset($_SESSION['bhentadmin']) && !empty($_SESSION['bhentadmin'])) {
	$admin = $_SESSION['bhentadmin'];
}else{
	header("Location: ./index.php");
}
?>