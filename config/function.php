<?php 
session_start();

require 'dbcon.php';

//Input field validation
function validate($inputData){

    global $conn;
    $validatedData = mysqli_real_escape_string($conn, $inputData);
    return trim($validatedData);
}

// Redirect from 1 page to another page with the message (status)
function redirect($url, $status){
    
    $_SESSION['status'] = $status;
    header('Location: '.$url);
    exit(0);
}


//Display messages or status after any process
function alertMessage(){

    if(isset($_SESSION['status'])){
        $_SESSION['status'];
        echo '<div class="alert alert-warning alert-dismissible fade show mb-1 mt-1 pt-1" style="height: 2rem;" role="alert">
            <h6 class="mt-0">'.$_SESSION['status'].'</h6>
            <button type="button" class="btn-close mt-0 pt-0" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['status']);
    }
}


//Insert record using this function
function insert($tableName, $data){

    global $conn;

    $table = validate($tableName);

    $columns = array_keys($data);
    $values = array_values($data);

    $finalColumn = implode(',', $columns);
    $finalValues = "'".implode("', '", $values)."'";

    $query = "INSERT INTO $table ($finalColumn) VALUES ($finalValues)";
    $result = mysqli_query($conn, $query);
    return $result;
}

//Update data using this function
function update($tableName, $id, $data){

    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $updateDataString = "";

    foreach($data as $column => $value){

        $updateDataString .= $column. '='."'$value',";

    }

    $finalUpdateData = substr(trim($updateDataString),0,-1);

    $query = "UPDATE $table SET $finalUpdateData WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    return $result;
}

function getAll($tableName, $condition = "", $status = NULL) {
    global $conn;

    // Validate and escape table name to prevent SQL injection
    $table = mysqli_real_escape_string($conn, $tableName);
    $condition = !empty($condition) ? " $condition" : ""; // Ensure proper spacing

    // Check if filtering by status is needed
    if ($status == 'status') {
        $query = "SELECT * FROM `$table` WHERE status='0'";
    } else {
        $query = "SELECT * FROM `$table`$condition"; // Use dynamic conditions
    }

    // Execute the query
    return mysqli_query($conn, $query);
}


function getById($tableName, $id){

    global $conn;
    
    $table = validate($tableName);
    $id = validate($id);

    $query = "SELECT * FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if($result){

        if(mysqli_num_rows($result) == 1){

            $row = mysqli_fetch_assoc($result);
            $response = [
                'status' => 200,
                'data' => $row,
                'message' => 'Record Found'
            ];
            return $response;

        }else{
            $response = [
                'status' => 404,
                'message' => 'No Data Found'
            ];
            return $response;
        }

    }else{
        $response = [
            'status' => 500,
            'message' => 'Something Went Wrong'
        ];
        return $response;
    }

}

//Delete data from database using id
function deleteById($tableName, $id){

    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $query = "DELETE FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
}
function checkParamId($type){

    if(isset($_GET[$type])){
        if($_GET[$type] != ''){
            return $_GET[$type];
        }else{
            return'<h5>No Id Found</h5>';
        }
    }
    else
    {
        return '<h5>No Id Given</h5>';
    }

}


//function for logout
function logoutSession(){

    unset($_SESSION['loggedIn']);
    unset($_SESSION['loggedInUser']);
}

function getAllWithLimit($table, $start, $limit) {
    global $conn; // Your database connection
    $query = "SELECT * FROM $table LIMIT $start, $limit";
    return mysqli_query($conn, $query);
}


//function for jsonRes
function jsonResponse($status, $status_type, $message){

    $response = [
        'status' => $status,
        'status_type' => $status_type,
        'message' => $message
    ];
    echo json_encode($response);
    return;
}


//function for dashboard analytics
function getCount($tableName) {
    global $conn;

    $table = validate($tableName);

    $query = "SELECT * FROM $table";
    $query_run = mysqli_query($conn, $query);
    if($query_run) {
        $totalCount = mysqli_num_rows($query_run);
        return $totalCount;
    }else{
        return 'Something Went Wrong';
    }
       
}

// Function for dashboard analyticsinclude('db_connection.php');

// Define the function if not already included in another file
function getUniqueCustomerCount($tableName, $columnName) {
    global $conn;

    // Validate inputs to prevent SQL injection
    $table = mysqli_real_escape_string($conn, $tableName);
    $column = mysqli_real_escape_string($conn, $columnName);

    // Query to count distinct customer_id
    $query = "SELECT DISTINCT $column FROM $table";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        // Count the number of distinct customer IDs
        $totalCount = mysqli_num_rows($query_run);
        return $totalCount;
    } else {
        return 'Something Went Wrong';
    }
}


function getTableAndColumnName($tableName, $columnName) {
    global $conn;

    // Validate inputs to avoid SQL injection
    $table = mysqli_real_escape_string($conn, $tableName);
    $column = mysqli_real_escape_string($conn, $columnName);

    // Query to check if the table and column exist
    $query = "SELECT TABLE_NAME, COLUMN_NAME 
              FROM INFORMATION_SCHEMA.COLUMNS 
              WHERE TABLE_NAME = '$table' AND COLUMN_NAME = '$column' 
              LIMIT 1";
    $query_run = mysqli_query($conn, $query);

    if ($query_run && mysqli_num_rows($query_run) > 0) {
        $result = mysqli_fetch_assoc($query_run);
        return $result; // Returns an associative array with TABLE_NAME and COLUMN_NAME
    } else {
        return 'Table or Column not found';
    }
}

// Function to retrieve customer data from table and column
function getTableColumnData($tableName, $columns) {
    global $conn;

    // Validate inputs to prevent SQL injection
    $table = mysqli_real_escape_string($conn, $tableName);
    $columns = mysqli_real_escape_string($conn, $columns);

    // Query to retrieve data from the specified columns in the table
    $query = "SELECT $columns FROM `$table`";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $data = [];
        while ($row = mysqli_fetch_assoc($query_run)) {
            $data[] = $row;
        }
        return $data; // Returns an array of rows from the specified columns
    } else {
        return null; // Return null if the query fails
    }
}


function getTableColumnSum($tableName, $columnName) {
    global $conn;

    // Validate inputs to prevent SQL injection
    $table = mysqli_real_escape_string($conn, $tableName);
    $column = mysqli_real_escape_string($conn, $columnName);

    // Query to calculate the sum of the specified column
    $query = "SELECT SUM($column) AS total_sum FROM `$table`";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $result = mysqli_fetch_assoc($query_run);
        return $result['total_sum'] ?? 0; // Return the sum or 0 if no rows
    } else {
        return null; // Return null if the query fails
    }
}

function getTotalValueByStock($tableName, $priceColumn, $stockLevelColumn) {
    global $conn;

    // Validate inputs to prevent SQL injection
    $table = mysqli_real_escape_string($conn, $tableName);
    $price = mysqli_real_escape_string($conn, $priceColumn);
    $stock = mysqli_real_escape_string($conn, $stockLevelColumn);

    // Query to calculate the total sum of price * stock_level
    $query = "SELECT SUM($price * $stock) AS totalValue FROM `$table`";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $result = mysqli_fetch_assoc($query_run);
        return $result['totalValue'] ?? 0; // Return the total value or 0 if null
    } else {
        return null; // Return null if the query fails
    }
}



?>



