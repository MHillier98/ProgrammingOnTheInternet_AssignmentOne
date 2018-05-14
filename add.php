 <?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>add.php</title>
    </head>
<body>

<?php

// connect to the products database
$connection = mysqli_connect( 'rerun', 'potiro', 'pcXZb(kL', 'poti' );

// connection check statement
if ( !$connection ) {
    die( "Can't connect to database!" );
}

// get variables passed from image map
$product_id = $_REQUEST['product_id'];

// we set session variable so it can be used in the cart.php page aswell
$_SESSION['product_id']=$product_id;

// query string for database, replace '*' with variable from image map
//$query_string = "select * from products"; // used to test database
$query_string = "select $product_id from products"; 

// query the database and store the result
$result = mysqli_query( $connection, $query_string );

$num_rows = mysqli_num_rows( $result );

//using associative array
// mysql_fetch_assoc: This function will return a row as an associative array where the column names will be the keys storing corresponding value.

// building the table to display the results from the query, only if there are results to display
if ( $num_rows > 0 ) {
    print "<table border='0'>";
    print "<tr>";
    print "<td>Product ID</td>";
    print "<td>Product Name</td>";
    print "<td>Unit Price</td>";
    print "<td>Unit Quantity</td>";
    print "<td>In Stock</td>";
    print "<td>Quantity</td>";
    print "</tr>";
    
    // will loop through all data from results and display the required information
    while ( $a_row = mysqli_fetch_assoc( $result ) ) {
        print "<tr>\n";
        print "<td>$a_row[product_id]</td>";
        print "<td>$a_row[product_name]</td>";
        print "<td>$a_row[unit_price]</td>";
        print "<td>$a_row[unit_quantity]</td>";
        print "<td>$a_row[in_stock]</td>";
        
        // create the quantity text box, and submit button, ready to send to cart.php
        print "<td>";
        print "<form action=\"cart.php\" method=\"post\">";
        print "<input type=\"text\" name=\"quantity\" size=\"3\"><input type=\"submit\" name=\"add\" value=\"add\">";
        print "</form>";
        print "</td>";
        print "</tr>";
    }
    
    print "</table>";
}

//close the connection to the database
mysqli_close( $connection );

?>

</body>
</html> 