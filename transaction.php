<?php
	include "connect.php";
	session_start();
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<title>Credit Management</title>
	<meta charset = "utf-8">
	<meta name = "viewport" content = "width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/all.css">
</head>

<body>
	<nav>
  		<div class="nav nav-tabs bg-dark" id="nav-tab" role="tablist">
    		<a class="nav-item nav-link" id="nav-home-tab" href="logout.php" role="tab">Home</a>
   			<a class="nav-item nav-link active" id="nav-viewusers-tab" data-toggle="tab" href="#nav-transaction-info" role="tab">Transaction Info</a>
		</div>
	</nav>

	<div class="tab-pane fade show active" id="nav-transaction-info" role="tabpanel">
		<?php 
			$selected_user = htmlspecialchars($_POST["selected_user"]);
			$user_name = htmlspecialchars($_SESSION["username"]);
			$amount = htmlspecialchars($_POST["amount"]);
			
			$sql = "SELECT current_credits from user where name = '$user_name'";
			$sql2 = "SELECT current_credits from user where name = '$selected_user'";

			global $conn;
			if($result = $conn->query($sql)){
				$balance =  $result->fetch_assoc()["current_credits"];
			}
			$previousBalance = $balance;
			if($result = $conn->query($sql2)){
				$deposit = $result->fetch_assoc()["current_credits"];
			}
				
			if($balance >= $amount && $amount > 0){
				$balance -= $amount;
				$deposit += $amount;

				$sql1 = "UPDATE user SET current_credits = $balance  WHERE name = '$user_name'";
				$sql2 = "UPDATE user SET current_credits = $deposit WHERE name = '$selected_user'";
				$sql3 =  "INSERT INTO transaction (name,sentTo,sentAmount,status) values ('$user_name','$selected_user',$amount,'sent')";
				$sql4 = "INSERT INTO transaction (name,receivedFrom,receivedAmount,status) values ('$selected_user','$user_name',$amount,'received')"; 
				
				mysqli_autocommit($conn,FALSE);
				$conn->query($sql1);
				$conn->query($sql2);
				$conn->query($sql3);
				$conn->query($sql4);
			
				if(mysqli_commit($conn)){
					echo "<br>";
					echo "<h2>Transaction Successful!</h2>";
					echo "<h4> Previous Credit Balance: $previousBalance</h4>";
					echo "<h4> New Credit Balance: $balance</h4>";
				}else{
					echo "<br>";
					echo "<h2>Insufficient credits to perform transaction!</h2>";
				}
				
			}else if($amount <= 0){
				echo "<br>";
				echo "<h2>Invalid amount detected!</h2>";
				echo "<h4>Please enter a valid credit amount!</h4>";
			}
			else{
				echo "<br>";
				echo "<h2>Insufficient credits to perform transaction!</h2>";
				echo "<h2>Your credits: $balance</h2>";
			}
			$conn->close();
		?>
	</div>
	
</body>
</html>