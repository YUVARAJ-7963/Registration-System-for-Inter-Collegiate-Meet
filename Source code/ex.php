<?php

if($title)

include 'php_files/connect_and_fetch.php';
$college_department = connect_and_fetch("SELECT * FROM college_and_department");
$software_contest = connect_and_fetch("SELECT * FROM software_contest");
$web_designing = connect_and_fetch("SELECT * FROM web_designing");
$debugging = connect_and_fetch("SELECT * FROM software_debugging");
$art = connect_and_fetch("SELECT * FROM art_from_e_waste");
$tiktok = connect_and_fetch("SELECT * FROM tiktok");
$quiz = connect_and_fetch("SELECT * FROM quiz");
$as_you_like_it = connect_and_fetch("SELECT * FROM as_you_like_it");
?>
<!DOCTYPE html>
<html>
<head>
    <title>eyes' 2k24</title>
</head>
<body>
    <div class="header">
        <h1>eyes' 2k24 Participants List</h1>
    </div>

    <div class="navigation-bar">
        <ul>
            <li><a href="register.html">Register</a></li>
            <li><a href="edit.php">Edit</a></li>
            <li><a href="delete.php">Delete</a></li>
            <li><a href="show.php">Show</a></li>
        </ul>
    </div>

    <div class="main">
        <button><a href="show_clg.php">College</a></button>

        <?php
        function display_table($title, $result, $competition) {
            echo "<details><summary style='font-size: 20px;'>$title</summary>";
            echo "<form action='php_files/export_excel_compatition.php' method='post'>
                    <input type='hidden' name='competition' value='$competition'>
                    <button type='submit'>Convert to Excel</button>
                  </form>";
            echo "<table>
                    <tr>
                        <th>College Name</th>
                        <th>Department Name</th>
                        <th>Participants Name</th>
                        <th>class</th>
                        <th>Signature</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['college_name']}</td>
                        <td>{$row['department_name']}</td>
                        <td>{$row['participants_name']}</td>
                        <td>{$row['class']}</td>
                        <td></td>
                      </tr>";
            }
            echo "</table></details><br><br>";
        }

        display_table("1. Software Contest", $software_contest, "software_contest");
        display_table("2. Web Designing", $web_designing, "web_designing");
        display_table("3. Software Debugging", $debugging, "software_debugging");
        display_table("4. Art from E-Waste", $art, "art_from_e_waste");
        display_table("5. TikTok", $tiktok, "tiktok");
        display_table("6. Quiz", $quiz, "quiz");
        display_table("7. As You Like It", $as_you_like_it, "as_you_like_it");
        ?>
    </div>
    <div class="footer"></div>
</body>
</html>
