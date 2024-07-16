<?php
include 'db_v2.php';
session_start();
// if (isset($_SESSION['bhentadmin']) && !empty($_SESSION['bhentadmin'])) {
// 	$admin = $_SESSION['bhentadmin'];
// }else{
// 	header("Location: ./windex.php");
// }
if(!isset($_SESSION('bhentadmin'))){
	header("Location:./windex.php");
}
?>