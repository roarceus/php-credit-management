<?php
	include "connect.php";
	session_start();
	$_SESSION["username"] = htmlspecialchars($_GET["user_name"]);
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<title>Welcome <?php echo $_GET["user_name"]; ?></title>
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
   			<a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-user-info" role="tab">User Info</a>
   			<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-transfer-credits" role="tab">Transfer Credits</a>
   			<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-transaction-history" role="tab">Transaction History</a>
		</div>
	</nav>
	
	<div class="tab-content" id="nav-tabContent">

  		<div class="tab-pane fade show active" id="nav-user-info" role="tabpanel">
  			<br>
  			<h1>Welcome, <?php echo $_SESSION["username"];?></h1>
			<p>Here are your credit details!<p>
			<h3>Credits Available : <?php $sql = "SELECT current_credits FROM user where name = '".$_SESSION["username"]."'"; $result = $conn->query($sql); echo $result->fetch_assoc()["current_credits"];?></h3>
			<br>
			<p>
  				<b>Transfer Credits</b> to select a user and send credits.
  			</p>
  			<p>
  				<b>Transaction History</b> to check your personal transaction history.
  			</p>
  		</div>

  		<div class="tab-pane fade" id="nav-transfer-credits" role="tabpanel">
  			<form action = <?php echo htmlspecialchars("transaction.php");?> method = "post" id = "view_user">
  				<center>
					<div class = "form-group">
						<br>
						<i class="fa fa-exchange-alt"></i>
						<br>
						<br>
						<label for = "user">Select a User</label>
						<select class = "form-control" id = "user" name = "selected_user" style="width: 20%">
							<?php
								$sql = "SELECT name from user";
								if($result = $conn->query($sql)){
									while($row = $result->fetch_assoc()){
											if($row["name"]==$_SESSION["username"])
												continue;
											echo "<option>".$row["name"]."</option>\n";
									}
								}
							?>
						</select>
					</div>
					<div class = "form-group">
						<label for = "amount">Enter Amount:</label>
						<input type="number" class="form-control" name = "amount" required style="width: 20%">
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</center>
			</form>
  		</div>

  		<div class="tab-pane fade" id="nav-transaction-history" role="tabpanel">
  			<table class = "table table-striped table-bordered table-hover table-dark">
				<thead>
					<tr>
						<th>Sent by</th>
						<th>Received by</th>
						<th>Sent/Received Amount</th>
						<th>Date & Time</th>
					</tr>
				</thead>
				
				<tbody>
						<?php 
						
							$sql = "SELECT name,sentTo,sentAmount,stamp from transaction where name  = '".$_SESSION["username"]."' and status = 'sent' or sentTo  = '".$_SESSION["username"]."' and status = 'sent'";
							
							if($result = $conn->query($sql)){
								while($rows = $result->fetch_assoc()){
									echo "<tr>";
									echo "<td>".$rows["name"]."</td>";
									echo "<td>".$rows["sentTo"]."</td>";
									echo "<td>".$rows["sentAmount"]."</td>";
									echo "<td>".$rows["stamp"]."</td>";
									echo "</tr>";
								}
							}
						?>
				</tbody>
			</table>
  		</div>
	</div>
	
	<script>
		$(document).ready(function () {
    		var viewportWidth = $(window).width();
    		if (viewportWidth < 768) {
            	$(".nav-item").addClass("col-sm-12");
    		}
    		else {
    			$(".nav-item").removeClass("col-sm-12");
    		}
		});
		
		$(window).load(function () {
    		var viewportWidth = $(window).width();
    		if (viewportWidth < 768) {
            	$(".nav-item").addClass("col-sm-12");
    		}
    		else {
    			$(".nav-item").removeClass("col-sm-12");
    		}
		});
	</script>

</body>
</html>