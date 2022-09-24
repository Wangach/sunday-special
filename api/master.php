<?php
include 'db.php';

if(isset($_GET['a'])) {
	$direction = $_GET['a'];

	if ($direction == 'totLooser') {
		//call the record looser func
		looserGames();
	}
	if ($direction == 'recordLooser') {
		//call the record looser func
		recordLooserGame();
	}
	if ($direction == 'recordFair') {
		//call the record looser func
		recordFairGame();
	}
	if ($direction == 'recentLost') {
		//call the looser function
		getRecentLooser();
	}
	if ($direction == 'recentFair') {
		//call the fair function
		getRecentFair();
	}
}

//function definitions

//looser Games Total
function looserGames() {
	include 'db.php';

	$calc = "SELECT * FROM looserdata";
	$mth = mysqli_query($conn, $calc);

	echo mysqli_num_rows($mth);
}
//record looser
function recordLooserGame() {
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
}
//Record fair func
function recordFairGame() {
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
}
//recent looser func
function getRecentLooser() {
	include 'db.php';

	$matchGetter = "SELECT * FROM (SELECT * FROM looserdata ORDER BY id DESC LIMIT 5) as r ORDER BY id";
	    $latestMatches = mysqli_query($conn, $matchGetter);

	    if (mysqli_num_rows($latestMatches) > 0) {
	        while ($row = mysqli_fetch_assoc($latestMatches)) {
	            #get the rows individual data
	            $hmPl = $row['Hplayer'];
	            $awPl = $row['Aplayer'];
	            $hmTm = $row['Hteam'];
	            $awTm = $row['Ateam'];
	            $hmSc = $row['Hscore'];
	            $awSc = $row['Ascore'];
	            $loss = $row['looser'];
	            $wnr = $row['winner'];
	            $matchCost = $row['cost'];
	            $mId = $row['matchid'];

	            /*Display The Results Depending on thecredit or debit value
	            //Will do this later since I am on a deadline RN
	            foreach ($row as $key => $value) {
	                print_r($key . $value);
	            }*/
	            //html data
	            $showData = "
	                            <tr>
	                                <td>
	                                    <div>$hmPl</div>
	                                    <div>$awPl</div>
	                                </td>
	                                <td>
	                                    <div>$hmTm</div>
	                                    <div>$awTm</div>
	                                </td>
	                                <td>
	                                    <div>$hmSc</div>
	                                    <div>$awSc</div>
	                                </td>
	                                <td>
	                                    <div class='text-danger'>$loss</div>
	                                    <div class='text-success'>$wnr</div>
	                                </td>
	                                <td class='text-info'><a href='./viewmatch?matchId=$mId'>$mId</a></td>
	                            </tr>";

	            echo $showData;
	        }
	    }
}

// recent fair func
function getRecentFair() {
	include 'db.php';
	$paid = '';
	$class = '';

	$matchGetter = "SELECT * FROM (SELECT * FROM fairdata ORDER BY id DESC LIMIT 5) as r ORDER BY id";
	    $latestMatches = mysqli_query($conn, $matchGetter);

	    if (mysqli_num_rows($latestMatches) > 0) {
	        while ($row = mysqli_fetch_assoc($latestMatches)) {
	            #get the rows individual data
	            $hmTm = $row['Hteam'];
	            $awTm = $row['Ateam'];
	            $hmSc = $row['Hscore'];
	            $awSc = $row['Ascore'];
	            $paymentStatus = $row['is_paid'];
	            $mId = $row['matchid'];

	            if($paymentStatus == 1){
	                $paid = '<i class="fas fa-check"></i>';
	                $class = 'btn-success';
	            }else{
	                $paid = '<i class="fas fa-window-close"></i>';
	                $class = 'btn-danger';
	            }
	            /*Display The Results Depending on thecredit or debit value
	            //Will do this later since I am on a deadline RN
	            foreach ($row as $key => $value) {
	                print_r($key . $value);
	            }*/
	            //html data
	            $showData = "
	                            <tr>
	                                <td>
	                                    <div>$hmTm</div>
	                                    <div>$awTm</div>
	                                </td>
	                                <td>
	                                    <div>$hmSc</div>
	                                    <div>$awSc</div>
	                                </td>
	                                <td>
	                                    <button class='btn btn-sm $class'>$paid</button>
	                                </td>
	                                <td class='text-info'><a href='./viewmatch?matchId=$mId'>$mId</a></td>
	                            </tr>";

	            echo $showData;
	        }
	    }
}


?>