<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Cart</title>
    </head>
    
    <body>

    <h1 style="text-align: center;">Shopping Cart</h1>

    <table style="align:center;">
    <tr>
        <td>Product Name</td>
        <td>Unit Price</td>
        <td>Unit Quantity</td>
        <td>Required Quantity</td>
        <td>Total Cost</td>
    </tr>

    <?php
    if (isset($_REQUEST['clear'])) {
    	//clear any data from cart array
    	unset($cart);
    	//clear all data from the session variables
    	session_unset();
    }
    else {
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
        $result = mysqli_query( $connection, $query_string );
        /*
        while ( $a_row = mysqli_fetch_assoc( $result ) ) {
            $cart = "<tr>\n<td>$a_row[product_name]</td><td>$a_row[unit_price]</td><td>$a_row[unit_quantity]</td><td>$quantity</td><td>" . $a_row[ unit_price ] * $quantity . "</td></tr>";
        }
        */

        //store the shopping cart
        $cart = array( );
        $cart = $_SESSION['cart'];
        //test if cart has contents already and print them
        if (isset($_REQUEST['clear'])) {
            
        }
        // add check for quantity not empty(for delete button purpose)

        //check if cart is empty
        /*
        if ( !empty( $cart ) ) {
            //add product to cart array
            if ( !empty( $result ) ) {
                while ( $a_row = mysqli_fetch_assoc( $result ) ) {
                    $cart = "<tr>\n<td>$a_row[product_name]</td><td>$a_row[unit_price]</td><td>$a_row[unit_quantity]</td><td>$quantity</td><td>" . $_SESSION[ 'total_cost' ] = $_SESSION[ 'total_cost' ] + ( $a_row[ unit_price ] * $quantity ) . "</td></tr>";
                }
            }
            //print all elements in cart
            foreach ($cart as $value) {
                print $value;
            }   
        }
        */
        //first time adding items to cart
        //else {
            //if ( !empty( $result ) ) {
                while ( $a_row = mysqli_fetch_assoc( $result ) ) {
                    $cart = "<tr><td>$a_row[product_name]</td><td>$a_row[unit_price]</td><td>$a_row[unit_quantity]</td><td>$quantity</td><td>" . $_SESSION[ 'total_cost' ] = $a_row[ unit_price ] * $quantity . "</td></tr>";
                    //$cart = "<tr>\n<td>$a_row[product_name]</td><td>$a_row[unit_price]</td><td>$a_row[unit_quantity]</td><td>$quantity</td><td>" . $_SESSION[ 'total_cost' ] = $a_row[ unit_price ] * $quantity . "</td></tr>";
                }
            //}
            //print all elements in cart
            foreach ($cart as $value) {
                print $value;
            }
        $_SESSION['numprod'] = count( $cart );
        $numprod=$_SESSION['numprod'];
        print "<tr><td>Number of Products</td><td>$numprod</td></tr>";
        print "<tr><td>Shopping Cart Total</td><td>$_SESSION['total_cost']</td></tr>";
        // print "<tr>\n<td>Number of Products</td><td>$numprod</td></tr>";
        // print "<tr>\n<td>Shopping Cart Total</td><td>$_SESSION['total_cost']</td></tr>";
        $_SESSION['cart']=$cart;
        msqli_close($connection);
    }
    ?>

    </table>
    <table style="align:center;">
    	<tr>
    		<td>
                <form action="cart.php" method="post">
                    <input type="submit" name="clear" value="clear">
                </form>
            </td>
    		<td>
                <form action="checkout.php" method="post">
                    <input type="submit" name="checkout" value="checkout">
                </form>
            </td>
    	</tr>
    </table>

    </body>
</html> 