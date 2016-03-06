
<?php
 
/*
 * Following code will find locations nearby
 */
 
// array for JSON response
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();

$latitude = $_GET["latitude"];
$longitude = $_GET["longitude"];
$low_lat = $latitude-10000000000000000000;
$high_lat = $latitude+100000000000000;
$low_long = $longitude-10000000000000;
$high_long = $longitude+10000000000000;


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
$rating = $row['AVG(ratings)'];
$latitude = $row['latitude'];
$longitude = $row['longitude'];
  array_push($rows, array('address' => $address, 'name' => $name, 'free' => $free, 'handicapped' => $handicapped,  'ratings' => $rating, 'longitude' => $longitude, 'latitude' => $latitude));
}//end while
 echo json_encode($rows);
}
else{
echo "database is empty";
}


?>
