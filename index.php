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

	<!-- Experimental navbar 
	<ul class="nav nav-tabs bg-dark responsive" id="nav-tab" role="tablist">
  		<li class="nav-item">
    		<a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab">Home</a>
  		</li>
  		<li class="nav-item">
    		<a class="nav-link" id="nav-viewusers-tab" data-toggle="tab" href="#nav-view-users" role="tab">View Users</a>
  		</li>
  		<li class="nav-item">
    		<a class="nav-link" id="nav-createuser-tab" data-toggle="tab" href="#nav-create-user" role="tab">Create Users</a>
  		</li>
  		<li class="nav-item">
    		<a class="nav-link" id="nav-updateuser-tab" data-toggle="tab" href="#nav-update-user" role="tab">Update User</a>
  		</li>
  		<li class="nav-item">
    		<a class="nav-link" id="nav-deleteuser-tab" data-toggle="tab" href="#nav-delete-user" role="tab">Delete User</a>
  		</li>
  		<li class="nav-item">
    		<a class="nav-link" id="nav-selectuser-tab" data-toggle="tab" href="#nav-select-user" role="tab">Select User to transfer credits</a>
  		</li>
  		<li class="nav-item">
    		<a class="nav-link" id="nav-alltransactions-tab" data-toggle="tab" href="#nav-all-transaction-history" role="tab">View all Transaction History</a>
  		</li>
	</ul>
	-->

	
	<nav>
  		<div class="nav nav-tabs bg-dark" id="nav-tab" role="tablist">
    		<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab">Home</a>
   			<a class="nav-item nav-link" id="nav-viewusers-tab" data-toggle="tab" href="#nav-view-users" role="tab">View Users</a>
   			<a class="nav-item nav-link" id="nav-createuser-tab" data-toggle="tab" href="#nav-create-user" role="tab">Create User</a>
   			<a class="nav-item nav-link" id="nav-updateuser-tab" data-toggle="tab" href="#nav-update-user" role="tab">Update User</a>
   			<a class="nav-item nav-link" id="nav-deleteuser-tab" data-toggle="tab" href="#nav-delete-user" role="tab">Delete User</a>
   			<a class="nav-item nav-link" id="nav-selectuser-tab" data-toggle="tab" href="#nav-select-user" role="tab">Select User to transfer credits</a>
   			<a class="nav-item nav-link" id="nav-alltransactions-tab" data-toggle="tab" href="#nav-all-transaction-history" role="tab">View all Transaction History</a>
		</div>
	</nav>
	

	<!-- Home Tab Panel -->
	<div class="tab-content responsive" id="nav-tabContent">
  		<div class="tab-pane fade show active" id="nav-home" role="tabpanel">
  			<br>
  			<img src="img/main.png">
  			<h1>Credit Management System</h1>
  			<p>
  				Credit Transfer made easy!
  			</p>
  			<br>
  			<br>
  			<p>
  				User can perform actions by accessing tabs from the navigation bar.
  			</p>
  		</div>

  		<!-- View Users Tab Panel -->
  		<div class="tab-pane fade" id="nav-view-users" role="tabpanel">
  			<table class="table table-striped table-bordered table-hover table-dark">
  				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Credits</th>
					</tr>
				</thead>
				<tbody>
					<?php
							$sql = "SELECT id, name, email, current_credits from user";
							$result = $conn->query($sql);
							while($row = $result->fetch_assoc()){	
								echo "<tr>";
								echo "<td data-label=\"ID\">".$row["id"]."</td>";
								echo "<td data-label=\"Name\">".$row["name"]."</td>";
								echo "<td data-label=\"Email\">".$row["email"]."</td>";
								echo "<td data-label=\"Credits\">".$row["current_credits"]."</td>";
								echo "</tr>";	
							}
						?>
				</tbody>
  			</table>
  		</div>

  		<!-- Create User Tab Panel -->
  		<div class="tab-pane fade" id="nav-create-user" role="tabpanel">
  			<form action = <?php echo htmlspecialchars("create_user.php");?> method = "post" id = "create_user">
  				<center>
					<div class = "form-group">
						<br>
						<i class="fa fa-user"></i>
						<br>
						<br>
						<label for = "amount">Enter Name:</label>
						<input type="text" class="form-control" name = "uname" required style="width: 20%">
						<br>
						<label for = "amount">Enter Email:</label>
						<input type="email" class="form-control" name = "email" required style="width: 20%">
						<br>
						<label for = "amount">Enter Credits:</label>
						<input type="number" class="form-control" name = "credits" required style="width: 20%">
					</div>
					<br>
					<button onclick="createUser()" type="submit" class="btn btn-primary">Create User</button>
				</center>
			</form>
  		</div>

  		<!-- Update User Tab Panel -->
  		<div class="tab-pane fade" id="nav-update-user" role="tabpanel">
  			<form action = <?php echo htmlspecialchars("update_user.php");?> method = "post" id = "create_user">
  				<center>
					<div class = "form-group">
						<br>
						<i class="fa fa-user-edit"></i>
						<br>
						<br>
						<select class = "form-control" id = "user" name = "update_name" style="width: 20%">
							<?php
								$sql = "SELECT name from user";
								$result = $conn->query($sql);
								while($row = $result->fetch_assoc()){
										echo "<option>".$row["name"]."</option>";
								}
							?>
						</select>
					</div>
					<div class = "form-group">
						<label for = "amount">Enter Amount:</label>
						<input type="number" class="form-control" name = "amount" required style="width: 20%">
					</div>
					<br>
					<button type="submit" class="btn btn-primary">Update</button>
				</center>
			</form>
  		</div>

  		<!-- Delete User Tab Panel -->
  		<div class="tab-pane fade" id="nav-delete-user" role="tabpanel">
  			<form action = <?php echo htmlspecialchars("delete_user.php");?> method = "post" id = "create_user">
  				<center>
					<div class = "form-group">
						<br>
						<i class="fa fa-user-slash"></i>
						<br>
						<br>
						<select class = "form-control" id = "user" name = "delete_name" style="width: 20%">
							<?php
								$sql = "SELECT name from user";
								$result = $conn->query($sql);
								while($row = $result->fetch_assoc()){
										echo "<option>".$row["name"]."</option>";
								}
							?>
						</select>
					</div>
					<br>
					<button type="submit" class="btn btn-primary">Delete</button>
				</center>
			</form>
  		</div>

  		<!-- Select User Tab Panel -->
  		<div class="tab-pane fade" id="nav-select-user" role="tabpanel">
  			<div class = "container">
				<form action = <?php echo htmlspecialchars("user_page.php");?> method = "get" id = "view_user">
					<center>
						<div class = "form-group">
							<br>
							<i class="fa fa-exchange-alt"></i>
							<br>
							<br>
							<select class = "form-control" id = "user" name = "user_name" style="width: 35%">
								<?php
									$sql = "SELECT name from user";
									$result = $conn->query($sql);
									while($row = $result->fetch_assoc()){
											echo "<option>".$row["name"]."</option>";
									}
								?>
							</select>
						</div>
						<br>
						<button type="submit" class="btn btn-primary">Select</button>
					</center>
				</form>
			</div>
  		</div>

  		<!-- All Transaction History Tab Panel -->
  		<div class="tab-pane fade" id="nav-all-transaction-history" role="tabpanel">
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
						
							$sql = "SELECT name,sentTo,sentAmount,stamp from transaction where status = 'sent'";
							
							if($result = $conn->query($sql)){
								while($rows = $result->fetch_assoc()){
									echo "<tr>";
									echo "<td data-label=\"Sent by\">".$rows["name"]."</td>";
									echo "<td data-label=\"Received by\">".$rows["sentTo"]."</td>";
									echo "<td data-label=\"Sent/Received Amount\">".$rows["sentAmount"]."</td>";
									echo "<td data-label=\"Date & Time\">".$rows["stamp"]."</td>";
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
		
		$(window).resize(function () {
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