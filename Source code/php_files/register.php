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
        REGISTER SUCCESSFUL
    </div>
</div>

<?php
function connect_db() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "eyes_2k24";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }
    return $conn;
}

function insert_into_table($conn, $table, $columns, $values) {
    $columns_str = implode(",", $columns);
    $values_str = "'" . implode("','", $values) . "'";
    $sql = "INSERT INTO $table ($columns_str) VALUES ($values_str)";

    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$college_name = $_POST['clgname'];
$department_name = $_POST['depname'];
$lot = $_POST['lot'];

// Insert college and department
$conn = connect_db();
insert_into_table($conn, "college_and_department", ["college_name", "department_name", "lot"], [$college_name, $department_name, $lot]);
$conn->close();

// Insert software contest data
$sft_cst_prts_name = $_POST['sft_cst_name'];
$sft_cst_prts_class = $_POST['sft_cst_class'];
if (!empty($sft_cst_prts_name) && !empty($sft_cst_prts_class)) {
    $conn = connect_db();
    insert_into_table($conn, "software_contest", ["college_name", "department_name", "participants_name", "class"], [$college_name, $department_name, $sft_cst_prts_name, $sft_cst_prts_class]);
    $conn->close();
}

// Insert web designing data
$web_des_prts_name = $_POST['web_des_name'];
$web_des_prts_class = $_POST['web_des_class'];
if (!empty($web_des_prts_name) && !empty($web_des_prts_class)) {
    $conn = connect_db();
    insert_into_table($conn, "web_designing", ["college_name", "department_name", "participants_name", "class"], [$college_name, $department_name, $web_des_prts_name, $web_des_prts_class]);
    $conn->close();
}

// Insert software debugging data
$debug_prts_name = $_POST['debug_name'];
$debug_prts_class = $_POST['debug_class'];
if (!empty($debug_prts_name) && !empty($debug_prts_class)) {
    $conn = connect_db();
    insert_into_table($conn, "software_debugging", ["college_name", "department_name", "participants_name", "class"], [$college_name, $department_name, $debug_prts_name, $debug_prts_class]);
    $conn->close();
}

// Insert art from e-waste data
$art_prts_name = array_filter($_POST['art_name']);
$art_prts_class = array_filter($_POST['art_class']);
if (!empty($art_prts_name) && !empty($art_prts_class)) {
    $conn = connect_db();
    foreach (array_combine($art_prts_name, $art_prts_class) as $name => $class) {
        insert_into_table($conn, "art_from_e_waste", ["college_name", "department_name", "participants_name", "class"], [$college_name, $department_name, $name, $class]);
    }
    $conn->close();
}

// Insert tiktok data
$tiktok_prts_name = array_filter($_POST['tiktok_name']);
$tiktok_prts_class = array_filter($_POST['tiktok_class']);

if (!empty($tiktok_prts_name) && !empty($tiktok_prts_class)) {
    $conn = connect_db();
    foreach (array_combine($tiktok_prts_name, $tiktok_prts_class) as $name => $class) {
        insert_into_table($conn, "tiktok", ["college_name", "department_name", "participants_name", "class"], [$college_name, $department_name, $name, $class]);
    }
    $conn->close();
}

// Insert quiz data
$quiz_prts_name = array_filter($_POST['quiz_name']);
$quiz_prts_class = array_filter($_POST['quiz_class']);
if (!empty($quiz_prts_name) && !empty($quiz_prts_class)) {
    $conn = connect_db();
    foreach (array_combine($quiz_prts_name, $quiz_prts_class) as $name => $class) {
        insert_into_table($conn, "quiz", ["college_name", "department_name", "participants_name", "class"], [$college_name, $department_name, $name, $class]);
    }
    $conn->close();
}

// Insert as you like it data
$as_you_likeit_prts_name = array_filter($_POST['as_you_like_it_name']);
$as_you_likeit_prts_class = array_filter($_POST['as_you_like_it_class']);

if (!empty($as_you_likeit_prts_name) && !empty($as_you_likeit_prts_class)) {
    $conn = connect_db();
    foreach (array_combine($as_you_likeit_prts_name, $as_you_likeit_prts_class) as $name => $class) {
        insert_into_table($conn, "as_you_like_it", ["college_name", "department_name", "participants_name", "class"], [$college_name, $department_name, $name, $class]);
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
