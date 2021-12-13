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

/* Execute a select query on the database and return the results, this will retrieve multiple records.
* Result will be as follows:
*
* array
*  (
*  [0] => Array([column1] => "value", [column2] => "value", [column3] => "value"),
*  [1] => Array([column1] => "value", [column2] => "value", [column3] => "value"),
* )
* the [0], [1] represent the rows of the table.
*
* example : getTableRecords("SELECT * FROM user");
*/
function getTableRecords($sql){
    $db = dbConnect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $stmt = prepareQuery($db, $sql);
    executePreparedQuery($stmt);
    $result = getResult($stmt);
    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        array_push($rows, $row);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($db);
    return $rows;
}

/* execute a select query on the database and return a specific record, this will retrieve 1 single record.
* Result will be as follows:
*
* array (
*  [column1] => "value", [column2] => "value", [column3] => "value"
* )
*
* example : getTableRecord("SELECT * FROM user WHERE id = ?", $id);
*
* NOTE: $id must be an integer (number)!
*/
function getTableRecord($sql, $id){
    $db = dbConnect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // prepare the query
    $stmt = prepareQuery($db, $sql);
    // bind the query & execute the query
    bindSelectQuery($stmt, $id);
    executePreparedQuery($stmt);
    // fetch the record
    $result = getResult($stmt);
    $row = mysqli_fetch_assoc($result);
    // close the statement & close the connection
    mysqli_stmt_close($stmt);
    mysqli_close($db);
    return $row;
}

/* execute a insert, delete or update query, example:
* insert query - insert an user
* executeQuery("INSERT INTO gebruiker (rol_id, abonnement_id, geverifieerd, ingelogd, gebruikersnaam, wachtwoord, email) VALUES (?, ?, ?, ?, ?, ?, ?)", "iiiisss", array(1, 1, 1, 0, "TEST100", generateHash("testWachtwoord"), "TEST100@test.nl"));
*
* update query - update an users name, only use if function above has inserted values.
* executeQuery("UPDATE gebruiker SET gebruikersnaam=?, email=? WHERE gebruikersnaam = ? AND email = ?", "ssss", array("updated_bruh", "updated_bruh@test.nl", "TEST100", "TEST100@test.nl"));
*
* delete query - delete an user account
* executeQuery("DELETE FROM gebruiker WHERE gebruikersnaam = ? AND email = ?", "ss", array("updated_bruh", "updated_bruh@test.nl"));
*/
function executeQuery($sql, $dataTypes, $values){
    $db = dbConnect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // prepare the query
    $stmt = mysqli_prepare($db, $sql) or die( mysqli_stmt_error($stmt));
    $stmt = bindQuery($stmt, $dataTypes, $values);
    $result = executePreparedQuery($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($db);
    return $result;
}

// ------------------------------------------- //
/* this part is reserved for the sub functions */
// ------------------------------------------- //

// prepares a query
function prepareQuery($db, $sql){
    $stmt = mysqli_prepare($db, $sql) or die( mysqli_stmt_error($stmt));
    return $stmt;
}

// binds a query to an SQL statement by id. ID must be of type int.
function bindSelectQuery($stmt, $id){
    mysqli_stmt_bind_param($stmt, 'i', $id) or die( mysqli_stmt_error($stmt));
}

// executes a prepared and binded query
function executePreparedQuery($stmt){
    if (mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        return false;
    }
}

// retrieve a result from a SELECT query, doesn't work if function value is directly returned!
function getResult($stmt){
    $result = mysqli_stmt_get_result($stmt) or die(mysqli_stmt_error($stmt));
    return $result;
}

// bind an update, delete or insert query
function bindQuery($stmt, $dataTypes, $values){
    mysqli_stmt_bind_param($stmt, $dataTypes, ...$values) or die( mysqli_stmt_error($stmt));
    return $stmt;
}

?>
