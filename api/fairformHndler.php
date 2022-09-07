<?
include 'db.php';
$res = '';

$plaer = file_get_contents('php://input');


$decdata = json_decode($plaer);

//Get Individual data
$formData = array(
    "homeTeam" => $decdata->fft,
    "awayTeamName" => $decdata->fst,
    "homeScore" => $decdata->ffsc,
    "awayScore" => $decdata->fssc,
    "tarehe" => $decdata->subDte,
    "saa" => $decdata->subTme,
    "uniq" => $decdata->matchId
);

//Insert Data to DB
$ins = "INSERT INTO fairdata (Hteam, Ateam, Hscore, Ascore, playdte, playtme, matchid) VALUES ('".$formData["homeTeam"]."',
  '".$formData["awayTeamName"]."', '".$formData["homeScore"]."', '".$formData["awayScore"]."',  '".$formData["tarehe"]."', '".$formData["saa"]."', 
  '".$formData["uniq"]."') ";

$check = mysqli_query($conn, $ins);
if($check){
    $resp = "Data Recorded";
    echo $resp;
    
}else {
    $resp = "There Has Been An Error in Submitting your data ".mysqli_error($conn);
    echo $resp;
}
?>