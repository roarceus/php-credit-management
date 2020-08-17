<?php
	include "connect.php";
	session_start();

	$delete_name = htmlspecialchars($_POST["delete_name"]);
	$sql =  "DELETE from user WHERE name = '$delete_name'";
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
		<h1>User Deleted</h1>
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