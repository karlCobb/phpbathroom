get_all_locations.php
<?php
 
/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */
 
// array for JSON response
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
$result = mysql_query("SELECT * FROM bathrooms");
if(result){ 
$rows = array();
        // check for empty result
        while($row = mysql_fetch_array($result)) {
 
  array_push($rows, $row);
}
 echo json_encode($rows);
}
else{
echo "database is empty";
}


?>
