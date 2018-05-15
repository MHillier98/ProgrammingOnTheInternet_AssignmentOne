<!DOCTYPE html>
<html>
	<head>
		<title>mail.php</title>
	</head>
	
	<body>

	<?php
	session_start();

	$fname=$_REQUEST['fname'];
	$lname=$_REQUEST['lname'];
	$address=$_REQUEST['address'];
	$suburb=$_REQUEST['suburb'];
	$state=$_REQUEST['state'];
	$country=$_REQUEST['country'];
	$pcode=$_REQUEST['pcode'];
	$email=$_REQUEST['email'];

	//get cart from session and store it
	$cart = $_SESSION['cart'];

	$to = $email;
	$subject = "Shopping Cart Checkout Email";

	$message = "
	<html>
	<head>
	<title>HTML email</title>
	</head>
	<body>
	<p>Your contact details are:</p>
	<table>
	<tr>
		<td>Name:</td>
		<td>$fname $lname</td>
	</tr>
	<tr>
		<td>Address:</td>
		<td>$address</td>
	</tr>
	<tr>
		<td>Suburb:</td>
		<td>$suburb</td>
	</tr>
	<tr>
		<td>State:</td>
		<td>$state</td>
	</tr>
	<tr>
		<td>Country:</td>
		<td>$country</td>
	</tr>
	<tr>
		<td>Postal Code:</td>
		<td>$pcode</td>
	</tr>
	<tr>
		<td>Email:</td>
		<td>$email</td>
	</tr>
	</table>
	<br>
	<p>Your order details are:</p>


	<table>
	<tr>
		<td>Product Name</td>
		<td>Unit Price</td>
		<td>Unit Quantity</td>
		<td>Required Quantity</td>
		<td>Total</td>
	</tr>
	";
	//add cart to the message string
		$messge = $message.$cart;

	$message=$message."
	<tr>\n<td>Number of Products</td><td>$_SESSION['numprod']</td></tr>
	<tr>\n<td>Shopping Cart Total</td><td>$_SESSION['total_cost']</td></tr>
	</table>
	</body>
	</html>
	";

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	mail($to,$subject,$message,$headers);
	?> 

	</body>
</html>