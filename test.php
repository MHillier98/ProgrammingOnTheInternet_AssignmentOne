<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
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

        if(isset($_REQUEST['clear'])){
            //clear any data from cart array
            unset($cart);
            //clear all data from the session variables
            session_unset($_SESSION['numprod']);
            session_unset($_SESSION['total_cost']);
            session_unset($_SESSION['product_id']);
        }
        else {
            // get Variables
            $product_id=$_SESSION['product_id'];
            $quantity=$_REQUEST['quantity'];
            $cart="";
            // echo $product_id;
            // echo $quantity;



            //Construct query
            $query="select * from products where product_id=$product_id";
            // echo $query;



            $result = mysqli_query( $connection, $query);
            if (empty($result)) {
                echo "empty result";
            }

            print'  <table style="align:center;">
            <tr>
                <td>Product Name</td>
                <td>Unit Price</td>
                <td>Unit Quantity</td>
                <td>Required Quantity</td>
                <td>Total Cost</td>
            </tr>';


            if ( !empty( $_SESSION['cart'] ) ) {
                while ( $a_row = mysqli_fetch_assoc( $result ) ) {
                    $cost=$a_row[unit_price]*$quantity;
                    $cart= "<tr>"."<td>$a_row[product_name]</td>"."<td>$a_row[unit_price]</td>"."<td>$a_row[unit_quantity]</td>"."<td>$quantity</td>"."<td>".$cost."</td>"."</tr>";
                    // $cart= "<tr>\n"."<td>$a_row[product_name]</td>"."<td>$a_row[unit_price]</td>"."<td>$a_row[unit_quantity]</td>"."<td>$quantity</td>"."<td>".$cost."</td>"."</tr>";
                    print $cart;
                    print $_SESSION['cart'];
                }              
            }
            else {
                while ( $a_row = mysqli_fetch_assoc( $result ) ) {
                    $cost=$a_row[unit_price]*$quantity;
                    $cart= "<tr>"."<td>$a_row[product_name]</td>"."<td>$a_row[unit_price]</td>"."<td>$a_row[unit_quantity]</td>"."<td>$quantity</td>"."<td>".$cost."</td>"."</tr>";
                    // $cart= "<tr>\n"."<td>$a_row[product_name]</td>"."<td>$a_row[unit_price]</td>"."<td>$a_row[unit_quantity]</td>"."<td>$quantity</td>"."<td>".$cost."</td>"."</tr>";
                    print $cart;
                }
            }


            $numprod=$_SESSION['numprod'];
            $numprod=$numprod+1;
            print "<tr><td>Number of Products</td><td>$numprod</td></tr>";
            // print "<tr>\n<td>Number of Products</td><td>$numprod</td></tr>";
            $_SESSION['numprod']=$numprod;

            $total_cost=$_SESSION['total_cost'];
            $total_cost=$total_cost+$cost;
            print "<tr><td>Shopping Cart Total</td><td>$total_cost</td></tr>";
            // print "<tr>\n<td>Shopping Cart Total</td><td>$total_cost</td></tr>";
            $_SESSION['total_cost']=$total_cost;


            print '</table>';

            if (!empty($cart)) {
                print'<table style="align:center;">
                    <tr>
                        <td><form action="test.php" method="get"><input type="submit" name="clear" value="clear"></form></td>
                        <td><form action="checkout.php" method="post"><input type="submit" name="checkout" value="checkout"></form></td>
                    </tr>
                </table>';
            }

            $_SESSION['cart']=$_SESSION['cart'].$cart;
        }
        ?>

        <?
        msqli_close($connection);
        ?>
    </body>
</html>