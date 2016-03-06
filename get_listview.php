<?php
 
/*
 * Following code will find locations nearby
 */
// array for JSON response
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
$rows = array();
// connecting to db
$db = new DB_CONNECT();

if(isset($_GET["address"]))
	$address = $_GET["address"];
$result = mysql_query("SELECT name, reviews, ratings, free, handicapped FROM reviews, bathrooms
 WHERE bathrooms.address = '$address' and bathrooms.address = reviews.address");
if(!empty($result)){

        // check for empty result
if (mysql_num_rows($result) > 0){
        while($row = mysql_fetch_array($result)) {
$name = $row['name'];
$free = $row['free'];
$handicapped = $row['handicapped'];
$reviews = $row['reviews'];
$ratings = $row['ratings']; 
  array_push($rows, array('address' => $address, 'name' => $name, 'free' => $free, 'handicapped' => $handicapped, 
'reviews' => $reviews, 'ratings' => $ratings, 'latitude' => $latitude, 'longitude' => $longitude));
}//end while
 echo json_encode($rows);
}else
echo "database is empty";
}
else{
echo "database is empty";
}


?>
