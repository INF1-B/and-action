<?php 
/* This file is used for testing different parts of the project */
// ----- databases testing ----- //

require_once "database.php";

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
// testConn(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// test if multiple records can be retrieved from the database, if so, it prints it
function testGetRecords($query){
    print_r(getTableRecords($query));
}
// testGetRecords("SELECT * FROM table");

// test if a single record can be retrieved from the database, if so, it prints it
function testGetRecord($query, $id){
    print_r(getTableRecord($query, $id));
}
// testGetRecord("SELECT * FROM table WHERE id = ?", 100);

// test if a query can be executed
function testExecuteQuery(){

}

?>