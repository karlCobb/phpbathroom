
<?php
 
/*
 * Following code will find locations nearby
 */
 
// array for JSON response
 
// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

$low_lat =  $_GET["min_lat"];
$high_lat = $_GET["max_lat"];
$low_long = $_GET["min_lng"];
$high_long = $_GET["max_lng"];
$rating = $_GET["rating"];


$result = mysql_query("SELECT reviews.address, name, handicapped, free, AVG(ratings), latitude, longitude FROM bathrooms join(reviews) WHERE latitude BETWEEN $low_lat AND $high_lat AND longitude BETWEEN $low_long AND $high_long AND reviews.address = bathrooms.address group by reviews.address");
if(result){

$rows = array();
        // check for empty result
        while($row = mysql_fetch_array($result)) {
$name = $row['name'];
$address = $row['address'];
$free = $row['free'];
$handicapped = $row['handicapped'];
//$review = $row['review'];
$avg_ratings = $row['AVG(ratings)'];
$latitude = $row['latitude'];
$longitude = $row['longitude'];

if($avg_ratings >= $rating){
  array_push($rows, array('address' => $address, 'name' => $name, 'free' => $free, 'handicapped' => $handicapped,  'ratings' => $avg_ratings, 'longitude' => $longitude, 'latitude' => $latitude));
}//end if
}//end while
 echo json_encode($rows);
}
else{
echo "database is empty";
}


?>
