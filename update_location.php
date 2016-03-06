get_product_details.php
<?php
 
/*
 * Following code will get single product details
 * A product is identified by product id (id)
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_GET["id"])) {
    $id = $_GET['id'];
 
    // get a product from products table
    $result = mysql_query("SELECT *FROM bathrooms WHERE id = $id");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $bathrooms = array();
            $bathrooms["id"] = $result["id"];
            $bathrooms["name"] = $result["name"];
            $bathrooms["address"] = $result["address"];
            $bathrooms["free"] = $result["free"];
            $bathrooms["handicapped"] = $result["handicapped"];
            $bathrooms["review"] = $result["review"];
            $bathrooms["rating"] = $result["rating"];
            // success
            $response["success"] = 1;
 
            // user node
            $response["bathrooms"] = array();
 
            array_push($response["bathrooms"], $product);
 $result = mysql_query("UPDATE bathrooms SET address = '$address', name = '$name', free = '$free', handicapped = '$handicapped', review = '$review', rating = '$rating' WHERE id = $id");
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No product found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No product found";
 
        // echo no users JSON
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
