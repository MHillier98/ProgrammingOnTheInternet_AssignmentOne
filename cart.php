 <?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cart.php</title>

</head>
<body>

<h1 style="text-align: center;">Shopping Cart</h1>

<table>
<tr>
    <td>Product Name</td>
    <td>Unit Price</td>
    <td>Unit Quantity</td>
    <td>Required Quantity</td>
    <td>Total Cost</td>
</tr>


<?php
//retrieve product id from the session
$product_id = $_SESSION[ 'product_id' ];

//retrieve quantity sent from past page
$quantity = $_REQUEST[ 'quantity' ];

//connect to database
$connection = mysqli_connect( 'rerun', 'potiro', 'pcXZb(kL', 'poti' );

// connection check statement
if ( !$connection ) {
    die( "Can't connect to database!" );
}

//query the database for the data we need
$query_string = "select $product_id from products";
$result       = mysqli_query( $connection, $query_string );

while ( $a_row = mysqli_fetch_assoc( $result ) ) {
    $cart = "<tr>\n<td>$a_row[product_name]</td><td>$a_row[unit_price]</td><td>$a_row[unit_quantity]</td><td>$quantity</td><td>" . $a_row[ unit_price ] * $quantity . "</td></tr>";
}


//store the shopping cart
$cart = array( );

//test if cart has contents already and print them
// add check for quantity not empty(for delete button purpose)
if ( !empty( $cart ) ) {
    print $cart;
    if ( !empty( $result ) ) {
        while ( $a_row = mysqli_fetch_assoc( $result ) ) {
            $cart = "<tr>\n<td>$a_row[product_name]</td><td>$a_row[unit_price]</td><td>$a_row[unit_quantity]</td><td>$quantity</td><td>" . $_SESSION[ 'total_cost' ] = $_SESSION[ 'total_cost' ] + ( $a_row[ unit_price ] * $quantity ) . "</td></tr>";
        }
    }
    
}
//first time adding items to cart
else {
    if ( !empty( $result ) ) {
        while ( $a_row = mysqli_fetch_assoc( $result ) ) {
            $cart = "<tr>\n<td>$a_row[product_name]</td><td>$a_row[unit_price]</td><td>$a_row[unit_quantity]</td><td>$quantity</td><td>" . $_SESSION[ 'total_cost' ] = $a_row[ unit_price ] * $quantity . "</td></tr>";
        }
    }
    print $cart;
}
$numprod = count( $cart );
print "<tr>\n<td>Number of Products</td><td>$numprod</td></tr>";
print "<tr>\n<td>Shopping Cart Total</td><td>$_SESSION['total_cost']</td></tr>";
?>

</table>

</body>
</html> 