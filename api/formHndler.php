<?
include 'db.php';
$res = '';

$plaer = file_get_contents('php://input');


json_decode($plaer);
echo $plaer;
?>