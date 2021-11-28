<?php 

include "credentials.php";

// test if a connection could be made to the database server
function testConn($server, $username, $password, $database){
  // check if the connection exists
  $conn = mysqli_connect($server, $username, $password, $database);
  if (!$conn) {
    echo "could not connect to the database!";
  } else {
    echo "Connection succesfull!";
  }
  mysqli_close($conn);
}

testConn(DB_HOST, DB_USER, DB_PASS, DB_NAME);

?>