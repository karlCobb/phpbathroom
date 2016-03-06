<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['address']) && isset($_POST['free']) &&
isset($_POST['handicapped']) && isset($_POST['reviews']) && isset($_POST['ratings'])) {
 
    $address = $_POST['address'];
    $free = $_POST['free'];
    $handicapped = $_POST['handicapped'];
    $reviews = $_POST['reviews'];
    $ratings = $_POST['ratings'];
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
    // mysql inserting a new row
    $result = mysql_query("UPDATE bathrooms SET free = '$free', handicapped = '$handicapped' WHERE address='$address'");
    $result_two = mysql_query("INSERT INTO reviews(address, reviews, ratings) VALUES('$address', '$reviews', '$ratings')");  
  
    // check if row inserted or not
    if ($result && $result_two) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Product successfully created.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>
