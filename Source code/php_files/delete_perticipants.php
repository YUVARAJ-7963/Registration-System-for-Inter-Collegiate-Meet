<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eyes_2k24";

$table = $_POST['tablename'];
$college = $_POST['collegename'];
$department = $_POST['departmentname'];
$participant = $_POST['participantsname'];
$class = $_POST['classname'];


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
$sql = "DELETE FROM $table WHERE college_name='$college' AND department_name='$department' AND participants_name='$participant' AND class='$class';";

if ($conn->query($sql) === TRUE) {
    echo "Record Deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
