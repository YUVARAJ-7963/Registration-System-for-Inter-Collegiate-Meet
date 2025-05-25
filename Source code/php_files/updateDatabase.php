<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eyes_2k24";

$oldValue = $_POST['oldValue'];
$newValue = $_POST['newValue'];
$table = $_POST['table'];
$column = $_POST['column'];
$college = $_POST['college'];
$department = $_POST['department'];


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
$sql = "UPDATE $table SET $column='$newValue' WHERE $column='$oldValue' AND department_name='$department' AND college_name = '$college'";


if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
