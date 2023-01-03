<?php
include 'db.php';
// $_SESSION['bhentadmin'] = '';

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
	if ($direction == 'seaUs') {
		//call the fair function
		searchUser();
	}
	if ($direction == 'loginAdmin'){
		//login function
		checkAdmin();
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
	if ($direction === 'cntFair') {
		//pay indebt
		calculateFair();
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
	include 'db.php';

	//Looser Games
	$looserg = "SELECT * FROM looserdata";
	$lmth = mysqli_num_rows(mysqli_query($conn, $looserg));


	//Fair Games
	$fairg = "SELECT * FROM fairdata";
	$fmth = mysqli_num_rows(mysqli_query($conn, $fairg));


	$tots = $lmth + $fmth;

	echo $tots;
}
//Calculate unpaid fair games
function calculateFair()
{
	include 'db.php';

	//Fair Games
	$fairg = "SELECT * FROM fairdata WHERE is_paid = '0'";
	$fmth = mysqli_num_rows(mysqli_query($conn, $fairg));

	echo $fmth;
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

	if($formData["mshin"] == 'N/A' && $formData["kushin"] == 'N/A'){
		$kushin_one = $formData["homePlayer"];
		$kushin_two = $formData["awayPlayer"];
		//Insert Data to DB
		$ins_one = "INSERT INTO looserdata (Hplayer, Aplayer, Hteam, Ateam, Hscore, Ascore, winner, looser,
		 matchty, coup, cost, playdte, playtme, matchid) VALUES ('" .$formData["homePlayer"]."', '".$formData["awayPlayer"]."', '".$formData["homeTeam"]."',
		  '".$formData["awayTeamName"]."', '".$formData["homeScore"]."', '".$formData["awayScore"]."', 'N/A', '$kushin_one', 
		  '".$formData["matchType"]."', '".$formData["matchCoupon"]."', '".$formData["deni"]."', '".$formData["tarehe"]."', '".$formData["saa"]."', 
		  '".$formData["uniq"]."') ";
		  $ins_two = "INSERT INTO looserdata (Hplayer, Aplayer, Hteam, Ateam, Hscore, Ascore, winner, looser,
		 matchty, coup, cost, playdte, playtme, matchid) VALUES ('" .$formData["homePlayer"]."', '".$formData["awayPlayer"]."', '".$formData["homeTeam"]."',
		  '".$formData["awayTeamName"]."', '".$formData["homeScore"]."', '".$formData["awayScore"]."', 'N/A', '$kushin_two', 
		  '".$formData["matchType"]."', '".$formData["matchCoupon"]."', '".$formData["deni"]."', '".$formData["tarehe"]."', '".$formData["saa"]."', 
		  '".$formData["uniq"]."') ";

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
	                                <td class='text-info'>
										<a id='$mId' onclick='viewMatch(this.id)' data-toggle='modal' data-target='#viewMatchModal' title='View Match Details'>$mId</a>
									</td>
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

//Make Customer Payment
function makePayment(){
	include 'db.php';
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

	//Thiscan either be cr for credit or db for debit
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
	include 'db.php';
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
	include 'db.php';
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

	include 'db.php';
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
	include 'db.php';

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
		include 'db.php';
		//lost matches
		$getlost = "SELECT * FROM looserdata WHERE looser = '$searchName'";
		$foundLost = mysqli_query($conn, $getlost);

		$calcLost = mysqli_num_rows($foundLost);
		//won matches
		$getwon = "SELECT * FROM looserdata WHERE winner = '$searchName'";
		$foundWon= mysqli_query($conn, $getwon);

		$calcWon = mysqli_num_rows($foundWon);
		//Totals
		$totals = $calcWon + $calcLost;

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
					</div>";

		echo $output;
	}

	function getDebtSummary($searchName) {
		$output = '';
		include 'db.php';
		//get the total cost of matches
		$lostm = "SELECT SUM(cost) as mechi FROM looserdata WHERE looser = '$searchName'";
		$foundlost = mysqli_query($conn, $lostm);

		if (mysqli_num_rows($foundlost) > 0) {
			while ($data = mysqli_fetch_assoc($foundlost)) {
				//get the sum of values from the column cost
				$playcost = $data['mechi'];
			}
		}
		//get the total transactions made
		$trMade = "SELECT SUM(amount) as malipo FROM transactions WHERE trName = '$searchName'";
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
			include 'db.php';
			$output = '';
			$wonMatches = "SELECT * FROM (SELECT * FROM looserdata WHERE winner = '$searchName' ORDER BY id DESC LIMIT 3) as r ORDER BY id";
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
			include 'db.php';
			$output = '';
			$lostMatches = "SELECT * FROM (SELECT * FROM looserdata WHERE looser = '$searchName' ORDER BY id DESC LIMIT 3) as r ORDER BY id";
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
	include 'db.php';
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
	include 'db.php';
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
	include 'db.php';
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
//View Math Details
function viewMatch() {
	include 'db.php';
	$message = '';
	if(isset($_GET['id']) && !empty($_GET['id'])) {
		$searchId = $_GET['id'];

		$perform_act = "SELECT * FROM looserdata WHERE matchid = '$searchId'";
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
?>