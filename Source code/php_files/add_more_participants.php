<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eyes_2k24";

$table= $_POST['tablename'];
$clg_name = $_POST['clgname'];
$dep_name = $_POST['depname'];
$name = $_POST['name'];
$class = $_POST['class'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

    $sql = "INSERT INTO $table (college_name, department_name, participants_name, class) VALUES ('$clg_name','$dep_name','$name','$class')";

if ($conn->query($sql) === TRUE) {
    echo "Record Added successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
