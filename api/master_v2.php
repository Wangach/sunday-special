<?php
//The new and improved BHENT api
include 'db_v2.php';
// $_SESSION['bhentadmin'] = '';
if(isset($_GET['a'])){
	$direction = $_GET['a'];

	if ($direction == 'totPlayedGames') {
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
	if ($direction == 'pay') {
		//call the fair function
		makePayment();
	}
	if ($direction == 'regUser') {
		//call the fair function
		registerUser();
	}
	if ($direction == 'indebt') {
		//call the fair function
		indebtUser();
	}
	if ($direction == 'loginAdmin'){
		//login function
		checkAdmin();
	}
	if ($direction == 'seaUs') {
		//call the fair function
		searchUser();
	}
	if ($direction == 'logoutAdmin'){
		//login function
		destAdmin();
	}
	if ($direction == 'payAll'){
		//login function
		payFair();
	}
	if ($direction === 'payIndebt') {
		//pay indebt
		payInd();
	}
	if ($direction === 'viewmatchdetails') {
		//pay indebt
		viewMatch();
	}
	if ($direction === 'viewfairmatchdetails') {
		//pay indebt
		viewFairMatch();
	}
	if ($direction === 'viewwontodaydets'){
		viewWonToday();
	}
	if ($direction === 'viewlosttodaydets'){
		viewLostToday();
	}
	if ($direction === 'cntFair') {
		//pay indebt
		calculateFair();
	}
	if($direction === 'reMatch'){
		cancelMatch();
	}
}

//function definitions
//Login function
function checkAdmin(){
	include 'db.php';
	session_start();
	$res = '';

	$plaer = file_get_contents('php://input');

	$decdata = json_decode($plaer);

	//Get form content individually
	$formData = array(
	    "username" => $decdata->uname,
	    "password" => $decdata->pass
	);
	//Check The Records
	$chk = "SELECT * FROM admin WHERE userName = '" .$formData["username"]. "' AND userPass = '" .$formData["password"]. "'";
	$fnd = mysqli_query($conn, $chk);

	//If There is such a user
	if(mysqli_num_rows($fnd) > 0){
		$_SESSION['bhentadmin'] = $formData["username"];
		$changeStat = "UPDATE admin SET islogged = '1' WHERE userName = '" .$_SESSION['bhentadmin']. "'";
		$ens = mysqli_query($conn, $changeStat);
		$res = "Login Successful! Redirecting In A Jiff.";
		echo $res;
	}else{
		$res = "Wrong username/password combinations. Try Again!";
		echo $res;
	}

}
//Logout Admin
function destAdmin() {
	include 'db.php';
	session_start();
	$ad = $_SESSION["bhentadmin"];
	$res = '';

	//Get The Admin dets from DB
	$gtAdmin = "UPDATE admin SET islogged = '0' WHERE userName = '$ad'";
	$hak = mysqli_query($conn, $gtAdmin);

	if ($hak) {
		unset($_SESSION['bhentadmin']);
		$res = "Logged Out!";
		echo $res;
	}else{
		$res = "Error ".mysqli_error($conn);
		echo $res;
	}
	
}
//looser Games Total
function looserGames() {
	include 'db_v2.php';

	//Looser Games
	$looserg = "SELECT * FROM looserpay_data WHERE match_statud = '1'";
	$lmth = mysqli_num_rows(mysqli_query($conn, $looserg));


	//Fair Games
	$fairg = "SELECT * FROM fairpay_data";
	$fmth = mysqli_num_rows(mysqli_query($conn, $fairg));


	$tots = $lmth + $fmth;

	echo $tots;
}
//Calculate unpaid fair games
function calculateFair()
{
	include 'db_v2.php';

	//Fair Games
	$fairg = "SELECT * FROM fairpay_data WHERE is_paid = '0'";
	$fmth = mysqli_num_rows(mysqli_query($conn, $fairg));

	echo $fmth;
}
//record looser
function recordLooserGame() {
	include 'db_v2.php';
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
	    "uniq" => $decdata->matchId
	);

	if($formData["mshin"] == 'N/A' && $formData["kushin"] == 'N/A'){
		$kushin_one = $formData["homePlayer"];
		$kushin_two = $formData["awayPlayer"];
		//Insert Data to DB
		$ins_one = "INSERT INTO looserpay_data (Hplayer, Aplayer, Hteam, Ateam, Hscore, Ascore, winner, looser,
		 matchty, coup, cost, matchid) VALUES ('" .$formData["homePlayer"]."', '".$formData["awayPlayer"]."', '".$formData["homeTeam"]."',
		  '".$formData["awayTeamName"]."', '".$formData["homeScore"]."', '".$formData["awayScore"]."', 'N/A', '$kushin_one', 
		  '".$formData["matchType"]."', '".$formData["matchCoupon"]."', '".$formData["deni"]."', '".$formData["uniq"]."') ";
		  $ins_two = "INSERT INTO looserpay_data (Hplayer, Aplayer, Hteam, Ateam, Hscore, Ascore, winner, looser,
		 matchty, coup, cost, matchid) VALUES ('" .$formData["homePlayer"]."', '".$formData["awayPlayer"]."', '".$formData["homeTeam"]."',
		  '".$formData["awayTeamName"]."', '".$formData["homeScore"]."', '".$formData["awayScore"]."', 'N/A', '$kushin_two', 
		  '".$formData["matchType"]."', '".$formData["matchCoupon"]."', '".$formData["deni"]."', '".$formData["uniq"]."') ";

		$check_one = mysqli_query($conn, $ins_one);
		$check_two = mysqli_query($conn, $ins_two);
		if($check_one && $check_two){
		    $resp = "Data Recorded";
		    echo $resp;
		    
		}else {
		    $resp = "There Has Been An Error in Submitting your data ".mysqli_error($conn);
		    echo $resp;
		}
	}else{
		//Insert Data to DB
		$ins = "INSERT INTO looserpay_data (Hplayer, Aplayer, Hteam, Ateam, Hscore, Ascore, winner, looser,
		 matchty, coup, cost, matchid) VALUES ('" .$formData["homePlayer"]."', '".$formData["awayPlayer"]."', '".$formData["homeTeam"]."',
		  '".$formData["awayTeamName"]."', '".$formData["homeScore"]."', '".$formData["awayScore"]."', '".$formData["mshin"]."', '".$formData["kushin"]."', 
		  '".$formData["matchType"]."', '".$formData["matchCoupon"]."', '".$formData["deni"]."',  '".$formData["uniq"]."') ";

		$check = mysqli_query($conn, $ins);
		if($check){
		    $resp = "Data Recorded";
		    echo $resp;
		    
		}else {
		    $resp = "There Has Been An Error in Submitting your data ".mysqli_error($conn);
		    echo $resp;
		}
	}
}
//Record fair func
function recordFairGame() {
	include 'db_v2.php';
	$res = '';

	$plaer = file_get_contents('php://input');


	$decdata = json_decode($plaer);

	//Get Individual data
	$formData = array(
	    "homeTeam" => $decdata->fft,
	    "awayTeamName" => $decdata->fst,
	    "homeScore" => $decdata->ffsc,
	    "awayScore" => $decdata->fssc,
	    "uniq" => $decdata->matchId
	);

	//Insert Data to DB
	$ins = "INSERT INTO fairpay_data (Hteam, Ateam, Hscore, Ascore, matchid) VALUES ('".$formData["homeTeam"]."',
	  '".$formData["awayTeamName"]."', '".$formData["homeScore"]."', '".$formData["awayScore"]."', '".$formData["uniq"]."') ";

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
	include 'db_v2.php';

	$matchGetter = "SELECT * FROM (SELECT * FROM looserpay_data WHERE match_statud = '1' ORDER BY id DESC LIMIT 5) as r ORDER BY id";
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
				$clb = 'recentLooser';
				

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
	                                <td class='text-info'>
										$mId
									</td>
									<td>
										<div class='match-actions'>
											<button class='btn' name='$mId' id='$clb' onclick='cancelMatch(this.name,this.id)' title='Cancel Match'>
												<i class='fas fa-hand-paper'></i>
											</button>
											<button class='btn' id='$mId' onclick='viewMatch(this.id)' data-toggle='modal' data-target='#viewMatchModal' title='View Match Details'>
												<i class='fas fa-eye'></i>
											</button>
										</div>
									</td>
	                            </tr>";

	            echo $showData;
	        }
	    }
}

// recent fair func
function getRecentFair() {
	include 'db_v2.php';
	$paid = '';
	$class = '';

	$matchGetter = "SELECT * FROM (SELECT * FROM fairpay_data WHERE is_active = '1' ORDER BY id DESC LIMIT 5) as r ORDER BY id";
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
	                $paid = '<i class="fas fa-thumbs-up"></i>';
	                $class = 'btn-success';
	            }else{
	                $paid = '<i class="fas fa-thumbs-down"></i>';
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
	                                    <button class='btn text-center'>$paid</button>
	                                </td>
	                                <td class='text-info'>
										<a id='$mId' onclick='viewFairDets(this.id)' data-toggle='modal' data-target='#viewMatchModal'>$mId</a>
									</td>
									<td>
										<div class='match-actions'>
											<button class='btn' title='Cancel Match'>
												<i class='fas fa-hand-paper'></i>
											</button>
											<button class='btn' id='$mId' onclick='viewFairDets(this.id)' data-toggle='modal' data-target='#viewMatchModal' title='View Match Details'>
												<i class='fas fa-eye'></i>
											</button>
										</div>
									</td>
	                            </tr>";

	            echo $showData;
	        }
	    }
}

//Make Customer Payment
function makePayment(){
	include 'db_v2.php';
	$res = '';

	$plaer = file_get_contents('php://input');


	$decdata = json_decode($plaer);

	//Get Individual data
	$formData = array(
	    "txnType" => $decdata->transType,
	    "transName" => $decdata->transName,
	    "payMode" => $decdata->paymentMeth,
	    "amount" => $decdata->transAmt,
	    "description" => $decdata->transDesc,
	    "uniq" => $decdata->transId
	);

	//Thiscan either be cr for credit or db_v2 for debit
	switch ($formData["txnType"]) {
		case 'cr':
			#This Is money coming into our account
			//Since in this case we are earning, the credit value should be +
			$moneyIn = $formData["amount"];
			$moneyOut = 0;
			$totals = $moneyIn + $moneyOut;
			//Using The Values Obtained from the above
			$mkTr = "INSERT INTO transactions(trName, trId, credit, debit, amount, pmeth, trDesc) 
            VALUES('" .$formData["transName"]."', '".$formData["uniq"]."', '" .$moneyIn."',
	  '".$moneyOut."', '" .$totals."', '".$formData["payMode"]."', '".$formData["description"]."')";
			$axn = mysqli_query($conn, $mkTr);

			//Check FOR A Successful transfer
			if ($axn) {
				echo "Transaction "."<strong class='text text-success'>".$formData['uniq']."</strong>" . "  Has Been Successful! Thank You!";
			}else{
				echo mysqli_error($dbcon);
			}
			break;

		case 'db':
			#This Is money getting out of our account
			//Since in this case we are earning, the credit value should be +
			$moneyIn = 0;
			$moneyOut = $formData["amount"];
			$totals = $moneyIn +- $moneyOut;
			
			//Using The Values Obtained from the above
			$mkTr = "INSERT INTO transactions(trName, trId, credit, debit, amount, pmeth, trDesc) 
            VALUES('" .$formData["transName"]."', '".$formData["uniq"]."', '" .$moneyIn."',
	  '".$moneyOut."', '" .$totals."', '".$formData["payMode"]."', '".$formData["description"]."')";
			$axn = mysqli_query($conn, $mkTr);

			//Check FOR A Successful transfer
			if ($axn) {
				echo "Transaction "."<strong class='text text-danger'>".$formData['uniq']."</strong>" . "  Has Been Successful! Thank You!";
			}else{
				echo "Sorry But There Has Been An Error!";
			}
			break;
		default:
				echo "This Operation Cannot be Performed!";
			break;
	}
}

//Customer Registration
function registerUser() {
	include 'db_v2.php';
	$res = '';

	$plaer = file_get_contents('php://input');


	$decdata = json_decode($plaer);

	//Get Individual data
	$formData = array(
	    "userName" => $decdata->custName,
	);

	//Insert Data to DB
	$ins = "INSERT INTO users (username, password, phone, alias, favteam, uno, dte_registered, reg_no) 
	VALUES ('".$formData["userName"]."', '".$formData["userName"]."', '".$formData["cusTel"]."',  
	'".$formData["myAlias"]."',  '".$formData["cusTeam"]."', '".$formData["unoMas"]."', 
	  '".$formData["dor"]."', '".$formData["uid"]."') ";

	$check = mysqli_query($conn, $ins);
	if($check){
	    $resp = "User". $formData['uid'] ."Registered";
	    echo $resp;
	    
	}else {
	    $resp = "There Has Been An Error in Submitting your data ".mysqli_error($conn);
	    echo $resp;
	}
}

//Indebt
function indebtUser() {
	include 'db_v2.php';
	$res = '';

	$plaer = file_get_contents('php://input');


	$decdata = json_decode($plaer);

	//Get Individual data
	$formData = array(
	    "person" => $decdata->debtee,
	    "reason" => $decdata->debtReason,
	    "amount" => $decdata->debtAmount,
	    "issueDte" => $decdata->whenIndebt,
	    "uniq" => $decdata->debtNum
	);

	//Insert Data to DB
	$ins = "INSERT INTO debts (debtor, reason, amount, date_of_issue, debt_id) 
	VALUES ('".$formData["person"]."', '".$formData["reason"]."', '".$formData["amount"]."',  
	'".$formData["issueDte"]."',  '".$formData["uniq"]."') ";

	$check = mysqli_query($conn, $ins);
	if($check){
	    $resp = "Data Recorded! Debt Id : ".$formData["uniq"];
	    echo $resp;
	    
	}else {
	    $resp = "There Has Been An Error in Submitting your data ".mysqli_error($conn);
	    echo $resp;
	}
}

//Search User
function searchUser() {

	include 'db_v2.php';
	$res = '';

	$plaer = file_get_contents('php://input');


	$decdata = json_decode($plaer);

	//Get Individual data
	$formData = array(
	    "user" => $decdata->username
	);
	//Search User
	if (isset($_GET['dets']) && !empty($_GET['dets'])) {
		$deep = $_GET['dets'];

		//call function depending on the results above
		if ($deep == 'msummary') {
			getMatchSummary($formData["user"]);
		}
		if ($deep == 'cntodaystats'){
			getTodayStats($formData["user"]);
		}
		if ($deep == 'dtsummary') {
			getDebtSummary($formData["user"]);
		}
		if ($deep == 'recentms') {
			recentIndividual($formData["user"]);
		}
		if ($deep == 'indTrans') {
			inRecTransactions($formData["user"]);
		}
		if ($deep == 'recentIndebts') {
			recIndebts($formData["user"]);
		}
	}

	
}
//Pay Fair Games in general
function payFair() {
	$output = '';
	include 'db_v2.php';

	$pay = "UPDATE fairdata SET is_paid = '1'";
	$conf = mysqli_query($conn, $pay);
	$calc = mysqli_affected_rows($conn);

	if ($conf) {
		$output = 'Updated! Matches Paid In  Total: ' . $calc;
		echo $output;
	}else{
		$output = 'There Has Been An Error '.mysqli_err($conn);
		echo $output;
	}
}
//function def
	function getMatchSummary($searchName) {
		$output = '';
		include 'db_v2.php';
		//lost matches
		$getlost = "SELECT * FROM looserpay_data WHERE looser = '$searchName' AND match_statud = '1'";
		$foundLost = mysqli_query($conn, $getlost);

		$calcLost = mysqli_num_rows($foundLost);
		//won matches
		$getwon = "SELECT * FROM looserpay_data WHERE winner = '$searchName' AND match_statud = '1'";
		$foundWon= mysqli_query($conn, $getwon);

		$calcWon = mysqli_num_rows($foundWon);
		//Totals
		$totals = $calcWon + $calcLost;

		//Win Probability
		$wp = round(($calcWon/$totals*100), 2);
		
		//Loose Probability
		$lp = round(($calcLost/$totals*100), 2);
		
		if($wp == NAN){
			$wp = 0;
		}elseif($lp == NAN){
			$lp = 0;
		}

		
		
		//Data Representation
		$output = "<div class='summary-holder'>
						<div class='won'>
							<h4>Won</h4>
							<span class='text-bold'>$calcWon</span>
						</div>
						<div class='lost'>
							<h4>Lost</h4>
							<span class='text-bold'>$calcLost</span>
						</div>
						<div class='tots'>
							<h4>Total</h4>
							<span class='text-bold'>$totals</span>
						</div>
						<div class='win-prob'>
							<h4 class='text-success'>WP (%)</h4>
							<span class='text-bold text-success'>$wp</span>
						</div>
						<div class='loose-prob'>
							<h4  class='text-danger'>LP (%)</h4>
							<span class='text-bold text-danger'>$lp</span>
						</div>
						
						
					</div>";

		echo $output;
	}
	//get today's individual player statistics
	function getTodayStats($searchName) {
		include 'db_v2.php';
		$output = '';
		$dateToday = date('Y-m-d');
		//todays lost matches
		$tlm ="SELECT * FROM looserpay_data WHERE looser = '$searchName' AND tme LIKE '$dateToday%'";
		$exl = mysqli_query($conn, $tlm);
		$qrl = mysqli_num_rows($exl);
		//todays won matches
		$twm ="SELECT * FROM looserpay_data WHERE winner = '$searchName' AND tme LIKE '$dateToday%'";
		$exw = mysqli_query($conn, $twm);
		$qrw = mysqli_num_rows($exw);
		//todays total matches
		$tots_played = $qrl + $qrw;

		// echo $tots_played
		// Data Representation
		$output = "<div class='daily-stats-holder'>
						<div class='won-today'>
							<h4>Won Today</h4>
							<span id='$searchName' class='badge badge-dark text-bold pointer' onclick='viewWonToday(this.id)' data-toggle='modal' data-target='#won'>
								$qrw
							</span>
						</div>
						<div class='lost-today'>
							<h4>Lost Today</h4>
							<div id='$searchName' class='badge badge-secondary text-bold pointer' onclick='viewLostToday(this.id)' data-toggle='modal' data-target='#lost'>
								$qrl
							</div>
						</div>
					</div>";

		echo $output;

	}
	function getDebtSummary($searchName) {
		$output = '';
		include 'db_v2.php';
		//get the total cost of matches
		$lostm = "SELECT SUM(cost) as mechi FROM looserpay_data WHERE looser = '$searchName' AND match_statud = '1'";
		$foundlost = mysqli_query($conn, $lostm);

		if (mysqli_num_rows($foundlost) > 0) {
			while ($data = mysqli_fetch_assoc($foundlost)) {
				//get the sum of values from the column cost
				$playcost = $data['mechi'];
			}
		}
		//get the total transactions made
		$trMade = "SELECT SUM(amount) as malipo FROM transactions WHERE trName = '$searchName' AND tr_status = '1'";
		$foundtr = mysqli_query($conn, $trMade);

		if (mysqli_num_rows($foundtr) > 0) {
			while ($row = mysqli_fetch_assoc($foundtr)) {
				//get the sum of values from the column cost
				$cash = $row['malipo'];
			}
		}
		//calculate the debt
		$owedOrAdvance = $cash - $playcost;

		//Get data from indebted table
		$debtsIncur = "SELECT SUM(amount) as deni FROM debts WHERE debtor = '$searchName' AND is_paid = '0'";
		$serDbt = mysqli_query($conn, $debtsIncur);

		if (mysqli_num_rows($serDbt) > 0) {
			while ($thumbs = mysqli_fetch_assoc($serDbt)) {
				//get the sum of values from the column cost
				$indebt = $thumbs['deni'];
				if ($indebt == '') {
					$indebt = 0;
				}
			}
		}

		//Data Representation
		$output = "<div class='debt-holder'>
						<div class='md'>
							<h4>Match D / A</h4>
							<span class='text-bold'>$owedOrAdvance</span>
						</div>
						<div class='od'>
							<h4>Others</h4>
							<span class='text-bold'>$indebt</span>
						</div>
					</div>";

		echo $output;
	}

	function recentIndividual($searchName) {

		function recentWon($searchName){
			include 'db_v2.php';
			$output = '';
			$wonMatches = "SELECT * FROM (SELECT * FROM looserpay_data WHERE winner = '$searchName' ORDER BY id DESC LIMIT 3) as r ORDER BY id";
		    $latestWonMatches = mysqli_query($conn, $wonMatches);

		    if (mysqli_num_rows($latestWonMatches) > 0) {
		        while ($row = mysqli_fetch_assoc($latestWonMatches)) {
		            #get the rows individual data
		            $hmPl = $row['Hplayer'];
		            $awPl = $row['Aplayer'];
		            $hmTm = $row['Hteam'];
		            $awTm = $row['Ateam'];
		            $hmSc = $row['Hscore'];
		            $awSc = $row['Ascore'];
		            $wnr = $row['winner'];
		            $matchCost = $row['cost'];
		            $mId = $row['matchid'];
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
		                                    <div class='text-success'>$wnr</div>
		                                </td>
		                                <td class='text-info'>
										<a id='$mId' onclick='viewMatch(this.id)' data-toggle='modal' data-target='#viewMatchModal' title='View Match Details'>$mId</a>
										</td>
		                            </tr>";

		            echo $showData;
		        }
	    	}
		}
		function recentLost($searchName){
			include 'db_v2.php';
			$showData = '';
			$lostMatches = "SELECT * FROM (SELECT * FROM looserpay_data WHERE looser = '$searchName' ORDER BY id DESC LIMIT 3) as r ORDER BY id";
		    $latestLostMatches = mysqli_query($conn, $lostMatches);

		    if (mysqli_num_rows($latestLostMatches) > 0) {
		        while ($row = mysqli_fetch_assoc($latestLostMatches)) {
		            #get the rows individual data
		            $hmPl = $row['Hplayer'];
		            $awPl = $row['Aplayer'];
		            $hmTm = $row['Hteam'];
		            $awTm = $row['Ateam'];
		            $hmSc = $row['Hscore'];
		            $awSc = $row['Ascore'];
		            $looser = $row['looser'];
		            $matchCost = $row['cost'];
		            $mId = $row['matchid'];

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
		                                    <div class='text-danger'>$looser</div>
		                                </td>
		                                <td class='text-info'>
										<a id='$mId' onclick='viewMatch(this.id)' data-toggle='modal' data-target='#viewMatchModal' title='View Match Details'>$mId</a>
										</td>
		                            </tr>";

		            echo $showData;
		        }
	    	}
		}

		recentWon($searchName);
		recentLost($searchName);
	}

//recent individual transactions
function inRecTransactions($searchName) {
	include 'db_v2.php';
			$output = '';
			$modeOfPayment = '';
			$indTr = "SELECT * FROM (SELECT * FROM transactions WHERE trName = '$searchName' ORDER BY id DESC LIMIT 5) as r ORDER BY id";
		    $latestTransactions = mysqli_query($conn, $indTr);

		    if (mysqli_num_rows($latestTransactions) > 0) {
		        while ($row = mysqli_fetch_assoc($latestTransactions)) {
		            #get the rows individual data
		            $transId = $row['trId'];
		            $pmode = $row['pmeth'];
		            $total = $row['amount'];
		            $explain = $row['trDesc'];
		            $tmstamp = $row['trDte'];
					$sysId = $row['id'];


		            if ($pmode == 'mp') {
		            	$modeOfPayment = 'Mpesa';
		            }
		            else if ($pmode == 'cs') {
		            	$modeOfPayment = 'Cash';
		            }
		            else if ($pmode == 'bnk') {
		            	$modeOfPayment = 'Bank';
		            }
					else if ($pmode == 'ot') {
		            	$modeOfPayment = 'Other';
		            }
		            else{
						$modeOfPayment = 'Unknown';
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
		                                    <div>
		                                    	<a href='#'>$sysId</a>
		                                    </div>
		                                </td>
		                                <td>
		                                    <div>$modeOfPayment</div>
		                                </td>
		                                <td>
		                                    <div>$total</div>
		                                </td>
		                                <td>
		                                    <div class=''>$tmstamp</div>
		                                </td>
		                                <td>
		                                    <div class=''>$explain</div>
		                                </td>
		                                <td class='text-info'><a href='./viewmatch?matchId=$transId'>$transId</a></td>
		                            </tr>";

		            echo $showData;
		        }
	    	}else{
	    		$showData = 'Transactions Not Found!';
	    		echo $showData;
	    	}
}

//recent individual transactions
function recIndebts($searchName) {
	include 'db_v2.php';
			$output = '';
			// $modeOfPayment = '';
			$ind = "SELECT * FROM (SELECT * FROM debts WHERE debtor = '$searchName' ORDER BY id DESC LIMIT 5) as r ORDER BY id";
		    $latestIndebts = mysqli_query($conn, $ind);

		    if (mysqli_num_rows($latestIndebts) > 0) {
		        while ($row = mysqli_fetch_assoc($latestIndebts)) {
		            #get the rows individual data
		            $dteIss = $row['date_of_issue'];
		            $reason = $row['reason'];
		            $amt = $row['amount'];
		            $dstat = $row['is_paid'];
					$sysId = $row['debt_id'];
					$paidOn = $row['when_paid'];

					$intoStr = strval($sysId);


		            if($dstat == 1){
		                $paid = '<i class="fas fa-check"></i>';
		                $class = 'btn-success';

		                $btnData = "<button type='button' value='$paidOn' id='$sysId' onclick='doneDeal(this.id, this.value)' class='btn btn-secondary'>
		                                Paid
		                            </button>";
		            }else{
		                $paid = '<i class="fas fa-window-close"></i>';
		                $class = 'btn-danger';

		                $btnData = "<button type='button' id='$sysId' onclick='payUp(this.id)' class='btn btn-primary pay-indebt'>
		                                Pay
		                             </button>";
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
		                                    <div>
		                                    	<a href='#'>$sysId</a>
		                                    </div>
		                                </td>
		                                <td>
		                                    <div>$reason</div>
		                                </td>
		                                <td>
		                                    <div>$amt</div>
		                                </td>
		                                <td>
		                                    <div class=''>$dteIss</div>
		                                </td>
		                                <td>
		                                    <button class='btn $class'>$paid</button>
		                                </td>
		                                <td>
		                                	$btnData
		                                </td>
		                            </tr>";

		            echo $showData;
		        }
	    	}else{
	    		$showData = 'Not Indebts Found!';
	    		echo $showData;
	    	}
}

//Pay Indebts
function payInd() {
	if (isset($_GET['debId']) && !empty($_GET['debId'])) {
		$idOfDebt = $_GET['debId'];
		paySpecificDebt($idOfDebt);
	}
}
//Func Definition
function paySpecificDebt($deb_id) {
	include 'db_v2.php';
	$output = '';
	$searchDebt = "UPDATE debts SET is_paid = '1' WHERE debt_id = '$deb_id'";
	$exec = mysqli_query($conn, $searchDebt);

	if ($exec) {
		$output = 'Debt Paid!';
		echo $output;
	}else{
		$output = 'Oops! Something went horribly wrong.'.mysqli_error($conn);
		echo $output;
	}

}
function cancelMatch() {
	if(isset($_GET['matchId']) && !empty($_GET['matchId'])){
		$matchid = $_GET['matchId'];
		cancelSpecificMatch($matchid);
	}
}
function cancelSpecificMatch($id) {
	include 'db_v2.php';
	$output = '';
	$searchMatch = "UPDATE looserpay_data SET match_statud = '0' WHERE matchid = '$id'";
	$cancel = mysqli_query($conn, $searchMatch);

	if($cancel){
		$output = 'Match Cancelled';
		echo $output;
	}else{
		$output = 'There has been an error'.mysqli_error($conn);
		echo $output;
	}
}
//View Math Details
function viewMatch() {
	include 'db_v2.php';
	$message = '';
	if(isset($_GET['id']) && !empty($_GET['id'])) {
		$searchId = $_GET['id'];

		$perform_act = "SELECT * FROM looserpay_data WHERE matchid = '$searchId'";
		$foundMtch = mysqli_query($conn, $perform_act);

		if (mysqli_num_rows($foundMtch) > 0) {
			while($row  = mysqli_fetch_array($foundMtch)) {
				//get the match details from table
				$playerOne = $row['Hplayer'];
				$playerTwo = $row['Aplayer'];
				$teamOne = $row['Hteam'];
				$teamTwo = $row['Ateam'];
				$scoreOne = $row['Hscore'];
				$scoreTwo = $row['Ascore'];
				$win = $row['winner'];
				$lost = $row['looser'];
				$typeOfMatch = $row['matchty'];
				$expenditure = $row['cost'];
				$timeOfPlay = $row['tme'];
				$gameId = $row['matchid'];
				$kes = $expenditure.' Kes';

				if ($typeOfMatch == 'nus') {
					$decodedType = 'Half Half';
				}
				if ($typeOfMatch == 'fut') {
					$decodedType = 'Full Game';
				}
				if ($typeOfMatch == 'sul') {
					$decodedType = 'Super Looser';
				}
				if ($typeOfMatch == 'ssl') {
					$decodedType = 'Super Super Looser';
				}
				if ($typeOfMatch == 'hut') {
					$decodedType = 'Half Game';
				}

				$message = "
							<div class='match'>
								<div class='first-sect'>
									<div class='match-mods' id='players'>
										<strong>$playerOne</strong>
										<strong>$playerTwo</strong>
									</div>
									<div class='match-mods' id='scores'>
										<strong>$scoreOne</strong>
										<strong>$scoreTwo</strong>
									</div>
									<div class='match-mods' id='teams'>
										<strong>$teamOne</strong>
										<strong>$teamTwo</strong>
									</div>
								</div>
								<div class='sec-sect'>
									<div class='match-mods' id='match-id'>
										<span class='mid'>$gameId</span>
										<span class='dectype'>$decodedType</span>
									</div>
								</div>
								<div class='third-sect'>
									<div class='match-mods' id='cost'>$kes</div>
									<div class='match-mods' id='time'>$timeOfPlay</div>
								</div>
							</div>
				";
				echo $message;
			}
		}
	}elseif (empty($_GET['id'])) {
		$message = 'Error! No match Id provided.';
		echo $message;
	}
}

//View Math Details
function viewFairMatch() {
	include 'db_v2.php';
	$message = '';
	if(isset($_GET['id']) && !empty($_GET['id'])) {
		$searchId = $_GET['id'];

		$perform_act = "SELECT * FROM fairpay_data WHERE matchid = '$searchId'";
		$foundMtch = mysqli_query($conn, $perform_act);

		if (mysqli_num_rows($foundMtch) > 0) {
			while($row  = mysqli_fetch_array($foundMtch)) {
				//get the match details from table
				$teamOne = $row['Hteam'];
				$teamTwo = $row['Ateam'];
				$scoreOne = $row['Hscore'];
				$scoreTwo = $row['Ascore'];
				$timeOfPlay = $row['tme'];
				$gameId = $row['matchid'];


				$message = "
							<div class='match'>
								<div class='first-sect'>
									<div class='match-mods' id='teams'>
										<strong>$teamOne</strong>
										<strong>$teamTwo</strong>
									</div>
									<div class='match-mods' id='scores'>
										<strong>$scoreOne</strong>
										<strong>$scoreTwo</strong>
									</div>
								</div>
								<div class='sec-sect'>
									<div class='match-mods' id='match-id'>
										<span class='mid'>$gameId</span>
									</div>
								</div>
								<div class='third-sect'>
									<div class='match-mods' id='time'>$timeOfPlay</div>
								</div>
							</div>
				";
				echo $message;
			}
		}
	}elseif (empty($_GET['id'])) {
		$message = 'Error! No match Id provided.';
		echo $message;
	}
}
//View Individual Won Matches
function viewWonToday() {
	include 'db_v2.php';
	$userToSearch = '';
	$dateToday = date('Y-m-d');
	if(isset($_GET['user']) && !empty($_GET['user'])){
		
		$userToSearch = $_GET['user'];

		$twm ="SELECT * FROM looserpay_data WHERE winner = '$userToSearch' AND tme LIKE '$dateToday%'";
		$exw = mysqli_query($conn, $twm);
		$qrw = mysqli_num_rows($exw);

		if($qrw > 0){
			while($row = mysqli_fetch_array($exw)){
				$hmPl = $row['Hplayer'];
				$awPl = $row['Aplayer'];
				$hmTm = $row['Hteam'];
				$awTm = $row['Ateam'];
				$hmSc = $row['Hscore'];
				$awSc = $row['Ascore'];
				$winner = $row['winner'];
				$mId = $row['matchid'];

					//html data
					$showData = "
						<div class='table-responsive'>
							<table class='table table-striped'>
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
										<div class='text-success'>$winner</div>
									</td>
									<td class='text-info'>
									<button type='button' class='btn btn-secondary'>$mId</button>
									</td>
								</tr>
							</table>
						</div>";

					echo $showData;
			}
		}else{
			echo "There is no data associated with this user.";
		}
	}else{
		echo "The system has been an error".mysqli_error($conn);
	}

}
//View Individual Lost Matches
function viewLostToday() {
	include 'db_v2.php';
	$userToSearch = '';
	$dateToday = date('Y-m-d');
	if(isset($_GET['user']) && !empty($_GET['user'])){
		
		$userToSearch = $_GET['user'];

		$twm ="SELECT * FROM looserpay_data WHERE looser = '$userToSearch' AND tme LIKE '$dateToday%'";
		$exw = mysqli_query($conn, $twm);
		$qrw = mysqli_num_rows($exw);

		if($qrw > 0){
			while($row = mysqli_fetch_array($exw)){
				$hmPl = $row['Hplayer'];
				$awPl = $row['Aplayer'];
				$hmTm = $row['Hteam'];
				$awTm = $row['Ateam'];
				$hmSc = $row['Hscore'];
				$awSc = $row['Ascore'];
				$looser = $row['looser'];
				$mId = $row['matchid'];

					//html data
					$showData = "
						<div class='table-responsive'>
							<table class='table table-striped'>
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
										<div class='text-danger'>$looser</div>
									</td>
									<td class='text-info'>
									<button type='button' class='btn btn-secondary'>$mId</button>
									</td>
								</tr>
							</table>
						</div>";

					echo $showData;
			}
		}else{
			echo "There is no data associated with this user.";
		}
	}else{
		echo "The system has been an error".mysqli_error($conn);
	}
}
?>