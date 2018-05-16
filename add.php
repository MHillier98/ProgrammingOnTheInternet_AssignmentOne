<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Add</title>

        <script language="javascript">
            function validateForm() {
                var x = Number(document.forms["addForm"]["quantity"].value);

                if (isNaN(x)) {
                    alert("The data in the field isn't a number.");
                    return false;
                }
                if (x == "") {
                    alert("A quantity is needed to add a product.");
                    return false;
                }
                if (x > 20) {
                    alert("The quantity can't be over 20.");
                    return false;
                }

                return true;
            }
		</script>
    </head>

    <body>

    <h1>Add product</h1>

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
    $query_string = "select * from products where product_id = $product_id;"; 

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
            print "<form action=\"test.php\" name=\"addForm\" onsubmit=\"return validateForm();\" method=\"post\" target=\"bottom-right_frame\">";
            print "<input type=\"text\" name=\"quantity\" size=\"3\"><input type=\"submit\" name=\"Add\" value=\"add\">";
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