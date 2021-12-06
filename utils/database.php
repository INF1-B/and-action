<?php
require_once "../src/database/credentials.php";

/* 
This file will contain everything that is related to databases. Think about a database
connection, database 
*/

// connect to the database, return the $conn var if the connection is succesful, if not return an error message
function dbConnect($server, $username, $password, $database){
  // check if the connection exists
  $conn = mysqli_connect($server, $username, $password, $database);
  if (!$conn) {
    exit("Could not connect to the database!");
  } 
  return $conn;
}

// Execute a select query on the database and return the results, this will retrieve multiple records.
// Result will be as follows:
//
// array
//  (
//  [0] => Array([column1] => "value", [column2] => "value", [column3] => "value"),
//  [1] => Array([column1] => "value", [column2] => "value", [column3] => "value"),
// )
// the [0], [1] represent the rows of the table.
//
// example : getTableRecords("SELECT * FROM user");
function getTableRecords($sql){
  $db = dbConnect(DB_HOST, DB_USER, DB_PASS, DB_NAME);  
  $stmt = mysqli_prepare($db, $sql) or die( mysqli_stmt_error($stmt) );
  mysqli_stmt_execute($stmt) or die( mysqli_stmt_error($stmt) );
  $result = mysqli_stmt_get_result($stmt) or die( mysqli_stmt_error($stmt));
  $rows = array();
  while($row = mysqli_fetch_assoc($result)) {
    array_push($rows, $row);
  }
  mysqli_stmt_close($stmt);
  mysqli_close($db);
  return $rows;
}

// execute a select query on the database and return a specific record, this will retrieve 1 single record.
// Result will be as follows: 
// 
// array (
//  [column1] => "value", [column2] => "value", [column3] => "value"
// )
//
// example : getTableRecord("SELECT * FROM user WHERE id = ?", $id); 
//
// NOTE: $id must be an integer (number)!
function getTableRecord($sql, $id){
  $db = dbConnect(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
  $stmt = mysqli_prepare($db, $sql) or die( mysqli_stmt_error($stmt) );
  mysqli_stmt_bind_param($stmt, 'i', $id) or die( mysqli_stmt_error($stmt) );
  mysqli_stmt_execute($stmt) or die( mysqli_stmt_error($stmt) );
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);
  mysqli_stmt_close($stmt);
  mysqli_close($db);
  return $row;
}



?>

<?php 
/* this part is reserved for the sub functions */

// prepares a query
function prepareQuery(){
  
}

// binds a query to an SQL statement
function bindQuery(){

}

?>
