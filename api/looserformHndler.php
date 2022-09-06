<?
include 'db.php';
$res = '';

$plaer = file_get_contents('php://input');


$decdata = json_decode($plaer);

//Get Individual data
$formData = array(
    "homePlayer" => $decdata->fpl,
    "awayPlayer" => $decdata->spl,
    "homeTeam" => $decdata->ft,
    "awayTeamName" => $decdata->st,
    "homeScore" => $decdata->fsc,
    "awayScore" => $decdata->ssc,
    "matchType" => $decdata->mty,
    "matchCoupon" => $decdata->coupon,
    "deni" => $decdata->debt,
    "mshin" => $decdata->winner,
    "kushin" => $decdata->looser,
    "tarehe" => $decdata->subDte,
    "saa" => $decdata->subTme,
    "uniq" => $decdata->matchId
);

//Insert Data to DB
$ins = "INSERT INTO looserdata (Hplayer, Aplayer, Hteam, Ateam, Hscore, Ascore, winner, looser,
 matchty, coup, cost, playdte, playtme, matchid) VALUES ('" .$formData["homePlayer"]."', '".$formData["awayPlayer"]."', '".$formData["homeTeam"]."',
  '".$formData["awayTeamName"]."', '".$formData["homeScore"]."', '".$formData["awayScore"]."', '".$formData["mshin"]."', '".$formData["kushin"]."', 
  '".$formData["matchType"]."', '".$formData["matchCoupon"]."', '".$formData["deni"]."', '".$formData["tarehe"]."', '".$formData["saa"]."', 
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