<!DOCTYPE html>
<html>
<head>
	<title>cart.php</title>
</head>
<body>
<?php
session_start(); 
?>

<?
// connect to the products database
$connection = mysqli_connect( 'rerun', 'potiro', 'pcXZb(kL', 'poti' );

// connection check statement
if ( !$connection ) {
    die( "Can't connect to database!" );
}
?>

<h1>Shopping Cart</h1>

<?
// get Variables
$product_id=$_SESSION['product_id'];
$quantity=$_REQUEST['add'];
$cart=array();
?>

<?
//Construct query
$query="select * from products where product_id=$product_id";
print $query
?>

<?
$result = mysqli_query( $connection, $query);
        if (empty($result)) {
            echo "empty result";
        }
?>


    <table style="align:center;">
    <tr>
        <td>Product Name</td>
        <td>Unit Price</td>
        <td>Unit Quantity</td>
        <td>Required Quantity</td>
        <td>Total Cost</td>
    </tr>

<?
if ( !empty( $_SESSION['cart'] ) ) {
//add product to cart array
$cart = $_SESSION['cart'];
                   	while ( $a_row = mysqli_fetch_assoc( $result ) ) {
       					$cost=$a_row[unit_price]*$quantity;
        				$cart= "<tr>\n"."<td>$a_row[product_name]</td>"."<td>$a_row[unit_price]</td>"."<td>$a_row[unit_quantity]</td>"."<td>$quantity</td>"."<td>".$cost."</td>"."</tr>";
    				}
            
            //print all elements in cart
            foreach ($cart as $value) {
                print $value;
            }   
        }


else{
   while ( $a_row = mysqli_fetch_assoc( $result ) ) {
        $cost=$a_row[unit_price]*$quantity;
        $cart= "<tr>\n"."<td>$a_row[product_name]</td>"."<td>$a_row[unit_price]</td>"."<td>$a_row[unit_quantity]</td>"."<td>$quantity</td>"."<td>".$cost."</td>"."</tr>";
        print $cart;
    }
}
?>

<?
$_SESSION['numprod'] = count($cart);
$_SESSION['total_cost']=$_SESSION['total_cost']+$cost;
print "<tr>\n<td>Number of Products</td><td>$_SESSION['numprod']</td></tr>";
print "<tr>\n<td>Shopping Cart Total</td><td>$_SESSION['total_cost']</td></tr>";
?>

</table>

<?

$_SESSION['cart']=$cart;
msqli_close($connection);
?>
</body>
</html>