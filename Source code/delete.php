<?php
include 'php_files/connect_and_fetch.php';
$college_and_department = connect_and_fetch("SELECT * FROM college_and_department");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eyis' 2k24</title>
    <script src="js/jquery.min.js"></script>
    <style>
        body {
            background:  linear-gradient(to top, #a18cd1 0%, #fbc2eb 100%);
            background-repeat: no-repeat;
            
        }
        	div.header {
		display: flex;
		align-items: center;
		justify-content: center;
		height: 100%;
        margin: 20px;
	}
	.head1 {
        font-family: cursive;
		color: rgb(209, 143, 229); font-weight:bold; 		
        font-size: 40px;
        text-transform: uppercase;
        text-shadow: 0px 2px 5px black;
		animation: focus-in-contract 2s linear 0s 1 normal none;
        
	}
	@keyframes focus-in-contract {
			
		0% {
			letter-spacing:5px;
			filter:blur(12px);
			opacity:0;
		}
		100% {
			filter:blur(0);
			opacity:1;
		}
	}
    .navigation-bar
        {
            display: flex;
            margin-top: 30px;
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
            font-size: 20px;
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
       
        svg 
        {
            font-family:Courier New;
            width: 100%; height: 100%;
            letter-spacing: 0;
        }
        svg text 
        {
            animation: stroke 5s infinite alternate;
            stroke-width: 2;
            stroke: #000000;
            font-size: 50px;

        }
        @keyframes stroke 
        {
            0%   {
                fill: rgba(179,46,242,0); 
                stroke-dashoffset: 0%; stroke-dasharray: 0 25%; stroke-width: 2;
            }
            50%  {fill: rgba(179,46,242,0); }
            
            100% {
                fill: rgba(189,174,222,1); 
                stroke-dashoffset: 25%; stroke-dasharray: 50% 0; stroke-width: 2;
            }
        }
        .wrapper {background-color: transparent;font-weight: bold;letter-spacing: 2px;
                    text-align: center; text-transform: uppercase;}

details{
    margin: 10px;
    border-bottom: 2px solid black;
    padding: 10px;
}
.sum{
    width:825px;
    margin:0 auto;
    border-radius: 15px;
    box-shadow: 0px 0px 15px black;
    
    overflow: hidden;
    
}

summary{padding:20px;width:700px;
    font-size:25px;
    z-index:1;    
    cursor:pointer}

details[open] 

table{animation:det 2s}
@keyframes det
{0%{opacity:0}
100%{opacity:1}}
.sum{
    overflow: hidden;
    animation: delete_all 2s ease 0s 1 normal forwards;
}
@keyframes delete_all {
	0% {
		animation-timing-function: ease-in;
		opacity: 0;
		transform: translateY(250px);
	}

	38% {
		animation-timing-function: ease-out;
		opacity: 1;
		transform: translateY(0);
	}

	55% {
		animation-timing-function: ease-in;
		transform: translateY(65px);
	}

	72% {
		animation-timing-function: ease-out;
		transform: translateY(0);
	}

	81% {
		animation-timing-function: ease-in;
		transform: translateY(28px);
	}

	90% {
		animation-timing-function: ease-out;
		transform: translateY(0);
	}

	95% {
		animation-timing-function: ease-in;
		transform: translateY(8px);
	}

	100% {
		animation-timing-function: ease-out;
		transform: translateY(0);
	}
}
.outside_table{
    border: 2px solid black;
    margin: 25px;
    height: 100%;
    width: 750px;
    font-size: 20px;
    padding: 10px;
    border-collapse: collapse;
    box-shadow: 0 0 15px black;
   
}

.outside_table th,td{
    padding: 10px;
    text-align: left;
    margin: 0;
    border: 2px solid black;
}
.outside_table th{
    text-align: center;
    padding: 20px;
}
.outside_table td table td{
    border:none;
    margin: 0;
}

input[type=button]
        {
            border-radius: 4px;
            background-image: linear-gradient(to top, #a18cd1 0%, #fbc2eb 100%);
            border: none;
            text-align: center;
            font-size: 15px;
            padding: 7px;
            margin-left:15px;
            
            cursor: pointer;
            
            box-shadow: 0 10px 20px -8px rgba(0, 0, 0,.7);
        }

button 
        {
            border-radius: 4px;
            background-image: linear-gradient(to top, #a18cd1 0%, #fbc2eb 100%);
            border: none;
            text-align: center;
            font-size: 20px;
            padding: 15px 16px;
            width: 170px;
            transition: all 0.5s;
            cursor: pointer;
            
            box-shadow: 0 10px 20px -8px rgba(0, 0, 0,.7);
        }

        button
        {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
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
            right: 45px;
        }
    </style>

    <script>
        function delete_participants(tablename,college_name,department_name,participants_name,class_name,competition)
        {
            console.log(tablename,college_name,department_name,participants_name,class_name);
            
            var yes_or_no=prompt("Competition= "+competition+"\nCollege= "+college_name+"\nDepartment= "+department_name+"\nName= "+participants_name+"\nClass= "+class_name+"\nYou Want to Delete this Participant  (Y/N)? :");
            if(yes_or_no!=null)
            {
                if(yes_or_no=='y' || yes_or_no=='Y')
                {
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "php_files/delete_perticipants.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            alert(xhr.responseText);
                        }
                    };
                    var data = "tablename=" + tablename + "&collegename=" + college_name + "&departmentname=" + department_name+ "&participantsname=" + participants_name + "&classname=" + class_name;
                    xhr.send(data);
                    location.reload();
                }
            }
        }
        
    </script>

</head>
<body>
<div class='header'>
        <div class='head1' >Department of Information Technology</div>
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

    <div class="main">
        <div class="wrapper">
            <svg>
                <text x="50%" y="50%"  text-anchor="middle">eyis' 2k24</text>
            </svg>
            <h2 style="margin-top: -50px;"> Inter-Collegiate Competitions</h2>
        </div><br>
        <center><h1> COLLEGES  DELETE</h1></center>
        <div class='sum'>
        <?php
        function display_college_participants($college_name, $department_name, $competition, $table_name) {
            $result = connect_and_fetch("SELECT participants_name, class FROM $table_name WHERE college_name='$college_name' and department_name='$department_name'");
            echo "<tr><td>$competition</td>";
            echo "<td><table>";
            while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>{$row['participants_name']}</td></tr>";
            }
            echo "</table></td><td><table>";
            $result->data_seek(0); 
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['class']}</td></tr>";
            }
            echo "</table></td><td><table>";
            $result->data_seek(0); 
            while ($row = $result->fetch_assoc()) {
                $participants_name=$row['participants_name'];
                $class=$row['class'];
                echo "<tr><td><input type='button' value='Delete Participant' onclick=\"delete_participants('$table_name','$college_name','$department_name','$participants_name','$class','$competition');\" /></td></tr>";
            }
            echo "</table></td></tr>";
            
        }

        while ($row0 = $college_and_department->fetch_assoc()) {
            $clg_name = $row0['college_name'];
            $dep_name = $row0['department_name'];
            echo "<details><summary>$clg_name ($dep_name)</summary>";
            
            echo "<table class='outside_table'>
                    <tr>
                        <th>Competitions</th>
                        <th>Participants Name</th>
                        <th>Class</th>
                        <th>Delete</th>
                    </tr>";
            display_college_participants($clg_name, $dep_name, "Software Contest", "software_contest");
            display_college_participants($clg_name, $dep_name, "Web Designing", "web_designing");
            display_college_participants($clg_name, $dep_name, "Software Debugging", "software_debugging");
            display_college_participants($clg_name, $dep_name, "Art from E-Waste", "art_from_e_waste");
            display_college_participants($clg_name, $dep_name, "TikTok", "tiktok");
            display_college_participants($clg_name, $dep_name, "Quiz", "quiz");
            display_college_participants($clg_name, $dep_name, "As You Like It", "as_you_like_it");
            echo "</table>";
            echo "<form action='php_files/delete_process.php' method='post'>
                    <input type='hidden' name='college_name' value='$clg_name'>
                    <input type='hidden' name='department_name' value='$dep_name'>
                    <center><button type='submit'>Delete College</button></center>
                  </form></details>";
        }
        ?>
        </div>
    </div>
    <div class="footer"></div>
    <script>$(document).ready(function() {
            $("details").on("click", function() {
                $("details[open]")
                    .not(this)
                    .removeAttr("open");
            });
        });</script>
</body>
</html>
