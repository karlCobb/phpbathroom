
<?php
 
/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for get data
if (isset($_GET["address"])) {
    $address = $_GET["address"];
 
    // get a product from products table
    $result = mysql_query("SELECT name, address, free, handicapped FROM bathrooms WHERE address = '$address'");
 
    if ($result) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);

            $address = $result["address"];
            $name = $result["name"];
            $free = $result["free"];

            $handicapped = $result["handicapped"];
 		$success = "1";
            // success
//            $response["success"] = "1";
 
  array_push($response, array('address' => $address, 'name' => $name, 'free' => $free, 'handicapped' => $handicapped,
'success' => $success));
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
        $success = "0";
 	$message = "That address does not exist 2";
 array_push($response, array('success' => $success, 'message' => $message));
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $success = "0";
 	$message = "That address does not exist 2";
 array_push($response, array('success' => $success, 'message' => $message));
        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing -1 to differentiate from 0
         $success = "-1";
 	$message = "Required field(s) is missing";
 array_push($response, array('success' => $success, 'message' => $message));
    // echoing JSON response
    echo json_encode($response);
}
?>
