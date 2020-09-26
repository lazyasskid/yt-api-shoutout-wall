<?php

$no_of_channels = 10;
$myFile = "channels.json";
$arr_data = array(); // create empty array

try {
  $id = $_GET['id']; // get id from the url
	$jsondata = file_get_contents($myFile); // get data from existing json
  $arr_data = json_decode($jsondata, true); // converts json data into array
  
  function searchForId($arr_data, $id) {
    foreach ($arr_data as $value) {
      if ($value == $id) {
        return true;
      }
    }
    return false;
  }
  
  $check = searchForId($arr_data, $id);
  if ($check == false) {
    if (count($arr_data) > $no_of_channels-1) {
      array_shift($arr_data);
    }
    array_push($arr_data,$id);
    $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
    if (file_put_contents($myFile, $jsondata)) {
      echo "Your channel has been added to the list."; // success response
    }
  }
  else {
    echo "Your channel is already in the list."; // fail response
  }
}
catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), "\n";
   }
