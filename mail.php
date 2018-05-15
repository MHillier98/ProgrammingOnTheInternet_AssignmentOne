<!DOCTYPE html>
<html>
	<head>
        <link rel="stylesheet" href="style.css">
		<title>mail.php</title>
	</head>
	
	<body>
		<?php
			session_start(); 
			//echo("<script>console.log('~mail started~');</script>");
		?>

		<?php
		if (isset($_REQUEST['mail'])) {
			//echo("<script>console.log('~~ mail started 1');</script>");
		}

		//session_start();

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

		// echo("<script>console.log('fname: ".$fname."');</script>");
		// echo("<script>console.log('lname: ".$lname."');</script>");
		// echo("<script>console.log('address: ".$address."');</script>");
		// echo("<script>console.log('suburb: ".$suburb."');</script>");
		// echo("<script>console.log('state: ".$state."');</script>");
		// echo("<script>console.log('country: ".$country."');</script>");
		// echo("<script>console.log('pcode: ".$pcode."');</script>");
		// echo("<script>console.log('email: ".$email."');</script>");
		// echo("<script>console.log('to: ".$to."');</script>");
		// echo("<script>console.log('subject: ".$subject."');</script>");
		// echo("<script>console.log('cart: ".$cart."');</script>");
		
		$message = "<html><head><title>HTML email</title></head><body><p>Your contact details are:</p><table><tr><td>Name:</td><td>$fname $lname</td></tr><tr><td>Address:</td><td>$address</td></tr><tr><td>Suburb:</td><td>$suburb</td></tr><tr><td>State:</td><td>$state</td></tr><tr><td>Country:</td><td>$country</td></tr><tr><td>Postal Code:</td><td>$pcode</td></tr><tr><td>Email:</td><td>$email</td></tr></table><br><p>Your order details are:</p><table><tr><td>Product Name</td><td>Unit Price</td><td>Unit Quantity</td><td>Required Quantity</td><td>Total</td></tr>";
		// echo("<script>console.log('cart: ".$message."');</script>");

		// add cart to the message string
		$messge = $message.$cart;
		// echo("<script>console.log('message1: ".$messge."');</script>");

		// echo("<script>console.log('numprod: ".$_SESSION['numprod']."');</script>");
		// echo("<script>console.log('total_cost: ".$_SESSION['total_cost']."');</script>");

		$message=$message."<tr><td>Number of Products</td><td>".$_SESSION['numprod']."</td></tr><tr><td>Shopping Cart Total</td><td>".$_SESSION['total_cost']."</td></tr></table></body></html>";
		//$message=$message."<tr>\n<td>Number of Products</td><td>$_SESSION['numprod']</td></tr><tr>\n<td>Shopping Cart Total</td><td>$_SESSION['total_cost']</td></tr></table></body></html>";
		// echo("<script>console.log('message2: ".$message."');</script>");

		//Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0\r\nContent-type:text/html;charset=UTF-8";

		// echo("<script>console.log('MAIL:');</script>");
		// echo("<script>console.log('to: ".$to."');</script>");
		// echo("<script>console.log('subject: ".$subject."');</script>");
		// echo("<script>console.log('message: ".$message."');</script>");
		//echo("<script>console.log('headers: ".$headers."');</script>");

		mail($to,$subject,$message,$headers);
		?> 
	</body>
</html>