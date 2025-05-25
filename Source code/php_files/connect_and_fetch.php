<?php
function connect_and_fetch($sql) {
    $conn = new mysqli("localhost", "root", "", "eyes_2k24");
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    } 

    $result = $conn->query($sql);
    $conn->close();
    return $result;
}
?>
