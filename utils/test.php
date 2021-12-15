<?php 
/* This file is used for testing different parts of the project */
// ----- databases testing ----- //

require_once "database.php";
require_once "functions.php";

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
function testGetRecord($query, $dataTypes, $values){
  print_r(getTableRecord($query, $dataTypes, $values));
}
// testGetRecord("SELECT * FROM table WHERE id = ?", "i", "4");

// test if a query can be executed
function testExecuteQuery(){
  // insert query - insert an user
  // executeQuery("INSERT INTO gebruiker (rol_id, abonnement_id, geverifieerd, ingelogd, gebruikersnaam, wachtwoord, email) VALUES (?, ?, ?, ?, ?, ?, ?)", "iiiisss", array(1, 1, 1, 0, "TEST100", generateHash("testWachtwoord"), "TEST100@test.nl"));

  // update query - update an users name, only use if function above has inserted values.
  // executeQuery("UPDATE gebruiker SET gebruikersnaam=?, email=? WHERE gebruikersnaam = ? AND email = ?", "ssss", array("updated_bruh", "updated_bruh@test.nl", "TEST100", "TEST100@test.nl"));

  // delete query - delete an user account
  // executeQuery("DELETE FROM gebruiker WHERE gebruikersnaam = ? AND email = ?", "ss", array("updated_bruh", "updated_bruh@test.nl"));
}

// testExecuteQuery();
?>