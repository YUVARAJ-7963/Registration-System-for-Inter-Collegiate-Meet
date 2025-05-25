<!DOCTYPE html>
<head>
    
    <title>Success</title>
    <style>
        .success-message {
            display: none;
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: black;
            font-weight: bold;
            font-size: 24px;

        }
        .success-message.show {
            display: flex;
            animation: fadeInOut 6s;
        }
        @keyframes fadeInOut {
            0% { opacity: 0; }
            50% { opacity: 1; }
            100% { opacity: 0; }
        }
        .tick-mark {
            font-size: 50px;
            color: #28a745;
        }
    </style>
</head>
<body>

<div class="success-message" id="successMessage">
    <div>
        <div class="tick-mark">✔</div>
        DELETED SUCCESSFUL
    </div>
</div>


<?php
include 'connect_and_fetch.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $college_name = $_POST['college_name'];
    $department_name = $_POST['department_name'];

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'eyes_2k24');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete from college_and_department table
    $sql = "DELETE FROM college_and_department WHERE college_name='$college_name' AND department_name='$department_name'";
    if ($conn->query($sql) === FALSE) {
        die("Error deleting record: " . $conn->error);
    } 

    // Delete from other tables
    $tables = [
        'software_contest',
        'web_designing',
        'software_debugging',
        'art_from_e_waste',
        'tiktok',
        'quiz',
        'as_you_like_it'
    ];
    
    foreach ($tables as $table) {
        $sql = "DELETE FROM $table WHERE college_name='$college_name' AND department_name='$department_name'";
        if ($conn->query($sql) === FALSE) {
            die("Error deleting record: " . $conn->error);
        }
    }

    $conn->close();
}
?>
<script>
    document.getElementById('successMessage').classList.add('show');
    setTimeout(function() {
        window.location.href = document.referrer;
    }, 6000);
</script>

</body>
</html>