<?php
  // Store useful variables
  $sessionId   = $_POST["sessionId"];
  $serviceCode = $_POST["serviceCode"];
  $phoneNumber = $_POST["phoneNumber"];
  $text        = $_POST["text"];

  $connect = mysqli_connect("localhost", "root", "", "dummylag");
  //$connect = mysqli_connect("localhost", "id2015884_dayjee", "iamll", "id2015884_ollt");
  $d1 = date('Y');
  $d2 = $d1 + 1;
  $academic_session = $d1 ."/". $d2;

  if ($text == "") {
	  $response  = "CON Welcome to LagMobile. What can we do for you today? \n";
    $response .= "1. LagMobile Payment Status \n";
    $response .= "2. View Matric Number";
  } 
  else if ($text == "1") {
    $query = mysqli_query($connect, "SELECT * FROM `subscribers` where `tel_no` = '$phoneNumber' and `session`='$academic_session' and `status`='Paid'");

    if (mysqli_num_rows($query) > 0) {
      while ($row = mysqli_fetch_row($query)) {
        $p1 = $row[1];
        $p2 = $row[2];
        $p3 = $row[9];
      }
      $response = "END Dear " .$p2 .", your LagMobile subscription for ".$academic_session." session was activated on " .$p3. ".\nThanks.";    
    }
    else {
      $response = "END Your number, $phoneNumber, as not been activated for this service yet. Please contact support.";
    }
  }
  else if ($text == "2") { 
    $query = mysqli_query($connect, "SELECT * FROM `subscribers` where `tel_no` = '$phoneNumber' and `session`='$academic_session' and `status`='Paid'");
    
    if (mysqli_num_rows($query) > 0) {
      while ($row = mysqli_fetch_row($query)) {
        $p1 = $row[1];
        $p2 = $row[2];
      }
      $response = "END Dear " .$p2 .", your matriculation number is " .$p1. "\nThanks.";    
    }
    else {
      $response = "END Your number has not been identified as that of a student of University of Lagos. Please contact CITS if this is an error.";
    }
  }
 
  // Enforce content type
  header('Content-type: text/plain');
  echo $response;
?>