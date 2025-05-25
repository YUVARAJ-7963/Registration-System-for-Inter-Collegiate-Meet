<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eyes_2k24";

$oldValue = $_POST['oldValue'];
$newValue = $_POST['newValue'];
$column = $_POST['column'];
$college = $_POST['college'];
$department = $_POST['department'];

$tables=['college_and_department','software_contest','web_designing','software_debugging','art_from_e_waste','tiktok','quiz','as_you_like_it'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
$flag=0;
if($column=="college_name")
{
    foreach($tables as $table)
    {
        $sql = "UPDATE $table SET $column='$newValue' WHERE $column='$oldValue' AND department_name='$department'";
        if ($conn->query($sql) === TRUE) 
            $flag=1;
         else 
            $flag=0;
        
    }
}
else
{
    foreach($tables as $table)
    {
        $sql = "UPDATE $table SET $column='$newValue' WHERE $column='$oldValue' AND college_name = '$college'";
        if ($conn->query($sql) === TRUE) 
            $flag=1;
         else 
            $flag=0;
    }
    
}

if ($flag==1) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
