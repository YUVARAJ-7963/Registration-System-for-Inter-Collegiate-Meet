<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS eyes_2k24";
if ($conn->query($sql) === FALSE) {
    die("Error creating database: " . $conn->error);
}
$conn->close();
?>

<?php
// Connect to the database
$conn = new mysqli($servername, $username, $password, "eyes_2k24");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL statements to create tables
$tables = [
    "CREATE TABLE IF NOT EXISTS `college_and_department` (
        `college_name` TEXT NOT NULL,
        `department_name` TEXT NOT NULL,
        `lot` TEXT NOT NULL
    )",
    "CREATE TABLE IF NOT EXISTS `software_contest` (
        `college_name` TEXT NOT NULL,
        `department_name` TEXT NOT NULL,
        `participants_name` TEXT NOT NULL,
        `class` TEXT NOT NULL
    )",
    "CREATE TABLE IF NOT EXISTS `web_designing` (
        `college_name` TEXT NOT NULL,
        `department_name` TEXT NOT NULL,
        `participants_name` TEXT NOT NULL,
        `class` TEXT NOT NULL
    )",
    "CREATE TABLE IF NOT EXISTS `software_debugging` (
        `college_name` TEXT NOT NULL,
        `department_name` TEXT NOT NULL,
        `participants_name` TEXT NOT NULL,
        `class` TEXT NOT NULL
    )",
    "CREATE TABLE IF NOT EXISTS `art_from_e_waste` (
        `college_name` TEXT NOT NULL,
        `department_name` TEXT NOT NULL,
        `participants_name` TEXT NOT NULL,
        `class` TEXT NOT NULL
    )",
    "CREATE TABLE IF NOT EXISTS `tiktok` (
        `college_name` TEXT NOT NULL,
        `department_name` TEXT NOT NULL,
        `participants_name` TEXT NOT NULL,
        `class` TEXT NOT NULL
    )",
    "CREATE TABLE IF NOT EXISTS `quiz` (
        `college_name` TEXT NOT NULL,
        `department_name` TEXT NOT NULL,
        `participants_name` TEXT NOT NULL,
        `class` TEXT NOT NULL
    )",
    "CREATE TABLE IF NOT EXISTS `as_you_like_it` (
        `college_name` TEXT NOT NULL,
        `department_name` TEXT NOT NULL,
        `participants_name` TEXT NOT NULL,
        `class` TEXT NOT NULL
    )"
];

foreach ($tables as $sql) {
    if ($conn->query($sql) === FALSE) {
        die("Error creating table: " . $conn->error);
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eyis' 2k24</title>
    <style>
        body {
            background-image:  linear-gradient(to top, #a18cd1 0%, #fbc2eb 100%);
            animation: home 1s cubic-bezier(0.87, 0, 0.13, 1) 0s 1 normal none;
        }
@keyframes home {
	0% {
		opacity: 0;
		transform: scale(0.6);
	}

	100% {
		opacity: 1;
		transform: scale(1);
	}
}
        .header{
            display:flex;
            justify-content:space-evenly;
            margin: 20px;
            animation: navi 2s ease 0s 1 normal forwards;
        }
        .header h1
        {
            font-size: 37px;
        }
        img
        {
            height: 100px;
            width: 100px;
        }

        .navigation-bar
        {
            display: flex;
            justify-content:center;
            animation: navi 2s ease 0s 1 normal forwards;
        }
        .navigation-bar ul
        {
            border: 1px solid black;
            border-radius: 10px;
            display: flex;
            padding: 0;
            margin: 0px;
            box-shadow: 0px 0px 7px black;
            justify-content: space-around;
            list-style: none;
            overflow: hidden;
            font-size: 23px;
            overflow: hidden;
        }
        .navigation-bar li
        {
            padding: 10px 0px;
            text-transform: uppercase;
        }
        .navigation-bar a
        {
            padding: 50px 50px;
            text-decoration: none;
            font-weight: bold;
            color: black;
        }
        ul:hover>:not(:hover){ opacity: 0.2;}

        .btn-shine
        {
            padding: 12px 48px;
            color: #ffffff;
            background: linear-gradient(to right, #4d4d4d 0, white 10%, #4d4d4d 20%);
            background-position: 0;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shine 4s infinite linear alternate;
            animation-fill-mode: forwards;
            -webkit-text-size-adjust: none;
            font-weight: 600;
            font-size: 16px;
            text-decoration: none;
            white-space: nowrap;
        }
    
        @keyframes shine
        {
            0%{background-position: 0;}
            100%{background-position: 600px;}
        }
                
        .main
        {
            text-align: center;
            margin: 0px;
            animation: navi 2s ease 0s 1 normal forwards;   
        }
        
        svg 
        {
            font-family:  cursive;
            width: 100%; height: 100%;
        }
        svg text 
        {
            animation: stroke 5s infinite alternate;
            stroke-width: 2;
            stroke: #000000;
            font-size: 100px;
        }
        @keyframes stroke 
        {
            0%   {
                fill: rgba(179,46,242,0); 
                stroke-dashoffset: 25%; stroke-dasharray: 0 50%; stroke-width: 2;
            }
            70%  {fill: rgba(179,46,242,0); }
            80%  {fill: rgba(179,46,242,0); stroke: rgba(0,0,0,1); stroke-width: 3; }
            100% {
                fill: rgba(189,174,222,1); 
                stroke-dashoffset: -25%; stroke-dasharray: 50% 0; stroke-width: 3;
            }
        }

        .wrapper {background-color: transparent;font-weight: bold;letter-spacing: 5px};


        h1 
        {
            color: #333;
            font-family: tahoma;
            font-size: 3rem;
            font-weight: 100;
            line-height: 1.5;
            text-transform: uppercase;
            white-space: nowrap;
            overflow: hidden;
            position: relative;
            width: 550px;
        }
        .head{
            text-align: center;
        }

        button 
        {
            border-radius: 4px;
            background-image: linear-gradient(to top, #a18cd1 0%, #fbc2eb 100%);
            border: none;
            text-align: center;
            font-size: 25px;
            padding: 15px 16px;
            width: 170px;
            transition: all 0.5s;
            cursor: pointer;
            margin: 36px;
            box-shadow: 0 10px 20px -8px rgba(0, 0, 0,.7);
        }

        button
        {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
        }
        a{
            text-decoration: none;
            font-weight: bold;
            color: black;
            
        }

        button:after 
        {
            content: '»';
            position: absolute;
            opacity: 0;  
            top: 14px;
            right: -20px;
            transition: 0.5s;
        }

        button:hover
        {
            padding-right: 24px;
            padding-left:8px;
        }
        button:hover:after 
        {
            opacity: 1;
            right: 10px;
        }

    .footer{
                text-align: center;
                animation: navi 2s ease 0s 1 normal forwards;
            }
    </style>
</head>
<body>
    <div class="header">
        <img src="images/logo.png" align="middle" />
        <h1> Virudhunagar Hindu Nadars SenthiKumara Nadar College </h1>
        <img align="middle" src="images/statue logo.png" /><br>
    </div>

    <div class="navigation-bar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="register.html">Register</a></li>
            <li><a href="edit.php">Edit</a></li>
            <li><a href="delete.php">Delete</a></li>
            <li><a href="show.php">Show</a></li>
        </ul>
    </div>

    <div class="header" style="margin: 8px;"> <h1 class="btn-shine">Department of Information Technology</h1></div>

    <div class="main"> 
        <div class="wrapper">
            <svg>
                <text x="50%" y="50%" dy=".35em" text-anchor="middle">EYIS'  2k24</text>
            </svg>
            <h2 style="margin: 10px;"> Inter-Collegiate Competitions</h2>
        </div>

    <a href="register.html"><button>Register</button></a>
    </div>

    <div class="footer">@Department of Information Technology, Vhnsnc.  </div>
</body>
</html>
