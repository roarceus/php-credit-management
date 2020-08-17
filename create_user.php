
<?php
	include "connect.php";
	session_start();

	$uname = htmlspecialchars($_POST["uname"]);
	$email = htmlspecialchars($_POST["email"]);
	$credits = htmlspecialchars($_POST["credits"]);
	$sql =  "INSERT INTO user (name,email,current_credits) values ('$uname','$email','$credits')";
	$conn->query($sql);
?>

<!DOCTYPE html>
<html lang = "en">
<head>
	<title>Credit Management</title>
	<meta charset = "utf-8">
	<meta name = "viewport" content = "width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="5; url=index.php">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

	<div class="confirmation">
		<h1>User Created</h1>
	</div>
	
	<div class="redirect_message">
		<p>
		You are being automatically redirected to a new location.<br />
    	If your browser does not redirect you, or you do
    	not wish to wait, <a href="index.php">click here</a>.
    	</p>
	</div>
	
</body>
</html>