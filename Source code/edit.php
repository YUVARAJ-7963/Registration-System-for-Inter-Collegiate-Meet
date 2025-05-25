<?php
$conn = new mysqli("localhost", "root", "", "eyes_2k24");
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM college_and_department";
$college_and_department = $conn->query($sql);
$conn->close();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Eyis' 2k24</title>
    <script>
        var old__value = '';
        var new_value = '';

        function all_clg_dep_edit(field_id, value, hide_id, visible_id) {
            old_value = value;
            document.getElementById(field_id).disabled = false;
            document.getElementById(hide_id).style.display = "none";
            document.getElementById(visible_id).style.display = "inline-block";
        }

        function all_clg_dep_done(field_id, visible_id, hide_id,column_name,college_name,department_name) {
            document.getElementById(field_id).disabled = true;
            new_value = document.getElementById(field_id).value;
            var college=document.getElementById(college_name).value;
            var department=document.getElementById(department_name).value;
            document.getElementById(visible_id).style.display = "inline-block";
            document.getElementById(hide_id).style.display = "none";

            console.log(new_value);
            console.log(old_value);
            console.log(college);
            console.log(department);
            console.log(column_name);
            

            document.cookie = "oldvalue=" + old_value;
            document.cookie = "newvalue=" + new_value;
            document.cookie = "column=" + column_name;
            document.cookie = "college=" + college;
            document.cookie = "department=" + department;

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "php_files/update_all_Database.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText);
                }
            };
            var data = "oldValue=" + old_value + "&newValue=" + new_value + "&column=" + column_name+ "&college=" + college + "&department=" + department;
            xhr.send(data);
        }

        function edit_text(field_id, value, hide_id, visible_id) {
            old_value = value;
            document.getElementById(field_id).readOnly = false;
            document.getElementById(hide_id).style.display = "none";
            document.getElementById(visible_id).style.display = "inline-block";
        }

        function done_edit(field_id, visible_id, hide_id, tablename, column_name,college_name,department_name) {
            document.getElementById(field_id).readOnly = true;
            new_value = document.getElementById(field_id).value;
            var college=document.getElementById(college_name).value;
            var department=document.getElementById(department_name).value;
            document.getElementById(visible_id).style.display = "inline-block";
            document.getElementById(hide_id).style.display = "none";

            document.cookie = "oldvalue=" + old_value;
            document.cookie = "newvalue=" + new_value;
            document.cookie = "table=" + tablename;
            document.cookie = "column=" + column_name;
            document.cookie = "college=" + college;
            document.cookie = "department=" + department;

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "php_files/updateDatabase.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText);
                }
            };
            var data = "oldValue=" + old_value + "&newValue=" + new_value + "&table=" + tablename + "&column=" + column_name+ "&college=" + college + "&department=" + department;
            xhr.send(data);
        }

        function autoSelectDropdown(dropdownId, value) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.value = value;
        }

        function add_participant(tablename,clgname,depname,ticket_count,total_count)
        {
            console.log(tablename,clgname,depname,ticket_count,total_count);
            console.log(typeof(ticket_count));
            console.log(typeof(total_count));
            var flag=1;
            document.cookie= "tablename=" + tablename;
            document.cookie= "clgname=" + clgname;
            document.cookie= "depname=" + depname;
            for(var i=ticket_count; ; )
            {
                var name=prompt("Enter Participant Name: ");
                if(name==null)
                {
                    flag=0;
                    break;
                }
                var clas=prompt("Enter Class: ");
                if(clas==null)
                {
                    flag=0;
                    break;
                }
                document.cookie= "name=" + name;
                document.cookie= "class=" + clas;

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "php_files/add_more_participants.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        alert(xhr.responseText);
                    }
                };
                var data = "tablename=" + tablename + "&clgname=" + clgname + "&depname=" + depname + "&name=" + name + "&class=" +clas;
                xhr.send(data);
                i++;
                if(i<total_count)
                {
                    var yes_or_no=prompt("Add More Participants(Y/N): ");
                    if(yes_or_no==null)
                    {
                        flag=0;
                        break;
                    }
                    if(yes_or_no=='n' || yes_or_no=='N')
                    {
                        break;
                    }
                }
                else{
                    break;
                }
            }
            if(flag==1)
            {
                location.reload();
            }
        }
    </script>
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
form {
    background: transparent;
    padding: 20px;
    border: 2px solid rgb(198, 158, 216);
    border-radius: 8px ;
    box-shadow: 0 0 30px rgba(0, 0, 0, 1);
    width:max-content;
    margin: auto;
    padding: 20px 60px;
    font-size:  18px;
}

form h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}


.form_head1, .form_head2{
    width: 66%;
    
}
form h4 {
    color: #444;
    margin-top: 30px;
    font-size: 1.1em;
    margin-bottom: 10px;
}


input[type="text"],
select {
    
    padding: 8px;
    margin: 8px 0;
    border: 2px solid #c980ed;
    border-radius: 4px;
    transition: all 0.3s ease;
    margin-right: 20px;
}


input[type="text"]:focus,
select:focus {
    border-color:  #c980ed;
    box-shadow: 0 0 5px #070707;
    outline: none;
}




input[type="text"],
select {
    animation: fadeIn 1 ease-in-out;
}



@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-10px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}



.sum{
    width:850px;
    margin:0 auto;
    border-radius: 15px;
    box-shadow: 0px 0px 15px black;
    overflow: hidden;
    animation: edit_all 2s ease 0s 1 normal forwards;
}

@keyframes edit_all {
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

summary{padding:20px;width:700px;
    font-size:25px;
    z-index:1;    
    cursor:pointer}

details[open] 

form{animation:det 2s}
@keyframes det
{0%{opacity:0}
100%{opacity:1}}

input[type=button] 
        {
            border-radius: 1px;
            background-image: linear-gradient(to top, #a18cd1 0%, #fbc2eb 100%);
            border:1px solid black;
            text-align: center;
            margin-right: 10px;
           
            padding: 5px 8px;
            transition: all 0.5s;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 0 10px 20px -8px rgba(0, 0, 0,.7);
            
            
        }
input[type=button]:hover
{
    animation: submit_button 0.5s 0s 1 normal forwards;
}

 @keyframes submit_button {
	0% {
		transform: scale(1);
	}

	100% {
		transform: scale(1.1);
	}
}
    </style>

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
        <center><h1> COMPETITIONS  EDIT</h1></center>
        <div class='sum'>
        <?php
        $parti_count=0;
        while ($row0 = $college_and_department->fetch_assoc()) {
            $clg_name = $row0['college_name'];
            $dep_name = $row0['department_name'];
            $lot = $row0['lot'];
            $parti_count++;
        ?>
 
            <details>
                <summary><?php echo "$clg_name ($dep_name)"; ?>
            </summary>
                <form>
                College Name: <input type="text" style="width:385px; margin-left:30px;" name="clgname" id="clgname_<?php echo $parti_count; ?>" value="<?php echo $clg_name; ?>" disabled />
                <input type="button" onclick="all_clg_dep_edit('clgname_<?php echo $parti_count; ?>', '<?php echo $clg_name; ?>', 'clg_edit_button_<?php echo $parti_count; ?>', 'clg_done_button_<?php echo $parti_count; ?>');" id="clg_edit_button_<?php echo $parti_count; ?>" value="Edit" />
                <input type="button" style="display: none;" onclick="all_clg_dep_done('clgname_<?php echo $parti_count; ?>', 'clg_edit_button_<?php echo $parti_count; ?>', 'clg_done_button_<?php echo $parti_count; ?>', 'college_name','clgname_<?php echo $parti_count; ?>','dep_name_<?php echo $parti_count; ?>');" id="clg_done_button_<?php echo $parti_count; ?>" value="Done" /><br>

                Department Name: <select name="depname" disabled id="dep_name_<?php echo $parti_count; ?>" style="width:405px;">
                <option value="Computer Science">Computer Science</option>
                <option value="Computer Science SELF">Computer Science SELF</option>
                <option value="Computer Science REGULAR">Computer Science REGULAR</option>
                <option value="Information Technology">Information Technology</option>
                <option value="Computer Application">Computer Application</option>
                <option value="CS/IT/BCA">CS/IT/BCA</option>
                <option value="Data Science">Data Science</option>
                </select>

                <input type="button" onclick="all_clg_dep_edit('dep_name_<?php echo $parti_count; ?>', '<?php echo $dep_name; ?>', 'dep_edit_button_<?php echo $parti_count; ?>', 'dep_done_button_<?php echo $parti_count; ?>');" id="dep_edit_button_<?php echo $parti_count; ?>" value="Edit" />
                <input type="button" style="display: none;" onclick="all_clg_dep_done('dep_name_<?php echo $parti_count; ?>', 'dep_edit_button_<?php echo $parti_count; ?>', 'dep_done_button_<?php echo $parti_count; ?>', 'department_name','clgname_<?php echo $parti_count; ?>','dep_name_<?php echo $parti_count; ?>');" id="dep_done_button_<?php echo $parti_count; ?>" value="Done" /><br>

                lot: <input type="text" style="width:385px; margin-left:113px;" name="lot" id="lot_<?php echo $parti_count; ?>" value="<?php echo $lot; ?>" readonly />
                <input type="button" onclick="edit_text('lot_<?php echo $parti_count; ?>', '<?php echo $lot; ?>', 'lot_edit_button_<?php echo $parti_count; ?>', 'lot_done_button_<?php echo $parti_count; ?>');" id="lot_edit_button_<?php echo $parti_count; ?>" value="Edit" />
                <input type="button" style="display: none;" onclick="done_edit('lot_<?php echo $parti_count; ?>', 'lot_edit_button_<?php echo $parti_count; ?>', 'lot_done_button_<?php echo $parti_count; ?>', 'college_and_department', 'lot','clgname_<?php echo $parti_count; ?>','dep_name_<?php echo $parti_count; ?>');" id="lot_done_button_<?php echo $parti_count; ?>" value="Done" /><br>

                
                <script>
                    autoSelectDropdown('dep_name_<?php echo $parti_count; ?>', '<?php echo $dep_name; ?>');
                </script>

                <h2>Competitions</h2>
                <h4>1. Software Contest:</h4>
                <?php
                $conn = new mysqli("localhost", "root", "", "eyes_2k24");
                if ($conn->connect_error) {
                    die("Connection Failed: " . $conn->connect_error);
                }
                $sql = "SELECT participants_name, class FROM software_contest WHERE college_name='$clg_name' AND department_name='$dep_name'";
                $software_contest = $conn->query($sql);
                $conn->close();
                
                $ticket_count=0;
                while ($row1 = $software_contest->fetch_assoc()) 
                {
                    $ticket_count++;
                ?>
                    Name: <input type="text" name="sft_cst_name" id="sft_cst_name_<?php echo $parti_count; ?>" value="<?php echo $row1['participants_name']; ?>" readonly />
                    <input type="button" onclick="edit_text('sft_cst_name_<?php echo $parti_count; ?>', '<?php echo $row1['participants_name']; ?>', 'contest_edit_button_<?php echo $parti_count; ?>', 'contest_done_button_<?php echo $parti_count; ?>');" id="contest_edit_button_<?php echo $parti_count; ?>" value="Edit" />
                    <input type="button" style="display: none;" onclick="done_edit('sft_cst_name_<?php echo $parti_count; ?>', 'contest_edit_button_<?php echo $parti_count; ?>', 'contest_done_button_<?php echo $parti_count; ?>', 'software_contest', 'participants_name','clgname_<?php echo $parti_count; ?>','dep_name_<?php echo $parti_count; ?>');" id="contest_done_button_<?php echo $parti_count; ?>" value="Done" />

                    Class: <input type="text" name="sft_cst_class" id="sft_cst_class_<?php echo $row1['class']; ?>" value="<?php echo $row1['class']; ?>" readonly />
                    <input type="button" onclick="edit_text('sft_cst_class_<?php echo $row1['class']; ?>', '<?php echo $row1['class']; ?>', 'contest_class_edit_button_<?php echo $parti_count; ?>', 'contest_class_done_button_<?php echo $parti_count; ?>');" id="contest_class_edit_button_<?php echo $parti_count; ?>" value="Edit" />
                    <input type="button" style="display: none;" onclick="done_edit('sft_cst_class_<?php echo $row1['class']; ?>', 'contest_class_edit_button_<?php echo $parti_count; ?>', 'contest_class_done_button_<?php echo $parti_count; ?>', 'software_contest', 'class','clgname_<?php echo $parti_count; ?>','dep_name_<?php echo $parti_count; ?>');" id="contest_class_done_button_<?php echo $parti_count; ?>" value="Done" />

               <?php } 
                if($ticket_count<1)
                { ?>
                    <center><input type="button" onclick="add_participant('software_contest','<?php echo $clg_name; ?>','<?php echo $dep_name; ?>',<?php echo $ticket_count; ?>,1);" id="add_participant_button<?php echo $parti_count; ?>" value="ADD" /></center>

            <?php    }
                ?>


                <h4>2. Web Designing:</h4>
                <?php
                $conn = new mysqli("localhost", "root", "", "eyes_2k24");
                if ($conn->connect_error) {
                    die("Connection Failed: " . $conn->connect_error);
                }
                $sql = "SELECT participants_name, class FROM web_designing WHERE college_name='$clg_name' AND department_name='$dep_name'";
                $web_designing = $conn->query($sql);
                $conn->close();

                $ticket_count=0;
                while ($row2 = $web_designing->fetch_assoc()) {
                    $ticket_count++;
                ?>
                    Name: <input type="text" name="web_des_name" id="web_des_name_<?php echo $parti_count; ?>" value="<?php echo $row2['participants_name']; ?>" readonly />
                    <input type="button" onclick="edit_text('web_des_name_<?php echo $parti_count; ?>', '<?php echo $row2['participants_name']; ?>', 'web_des_edit_button_<?php echo $parti_count; ?>', 'web_des_done_button_<?php echo $parti_count; ?>');" id="web_des_edit_button_<?php echo $parti_count; ?>" value="Edit" />
                    <input type="button" style="display: none;" onclick="done_edit('web_des_name_<?php echo $parti_count; ?>', 'web_des_edit_button_<?php echo $parti_count; ?>', 'web_des_done_button_<?php echo $parti_count; ?>', 'web_designing', 'participants_name','clgname_<?php echo $parti_count; ?>','dep_name_<?php echo $parti_count; ?>');" id="web_des_done_button_<?php echo $parti_count; ?>" value="Done" />

                    Class: <input type="text" name="web_des_class" id="web_des_class_<?php echo $parti_count; ?>" value="<?php echo $row2['class']; ?>" readonly />
                    <input type="button" onclick="edit_text('web_des_class_<?php echo $parti_count; ?>', '<?php echo $row2['class']; ?>', 'web_des_class_edit_button_<?php echo $parti_count; ?>', 'web_des_class_done_button_<?php echo $parti_count; ?>');" id="web_des_class_edit_button_<?php echo $parti_count; ?>" value="Edit" />
                    <input type="button" style="display: none;" onclick="done_edit('web_des_class_<?php echo $parti_count; ?>', 'web_des_class_edit_button_<?php echo $parti_count; ?>', 'web_des_class_done_button_<?php echo $parti_count; ?>', 'web_designing', 'class','clgname_<?php echo $parti_count; ?>','dep_name_<?php echo $parti_count; ?>');" id="web_des_class_done_button_<?php echo $parti_count; ?>" value="Done" />
                <?php } 
                if($ticket_count<1)
                { ?>
                    <center><input type="button" onclick="add_participant('web_designing','<?php echo $clg_name; ?>','<?php echo $dep_name; ?>',<?php echo $ticket_count; ?>,1);" id="add_participant_button<?php echo $parti_count; ?>" value="ADD" /></center>

            <?php    }
                ?>


                <h4>3.Software Debugging : </h4>
                <?php
                    $conn= new mysqli("localhost","root","","eyes_2k24");
                        if($conn->connect_error)
                            die("connection Failed : ".$conn->connect_error);
                        $sql="SELECT participants_name, class FROM software_debugging WHERE college_name='$clg_name' and department_name='$dep_name'";
                        $software_debugging=$conn->query($sql);
                        $conn->close();

                        $ticket_count=0;
                        while($row1=$software_debugging->fetch_assoc())
                        { 
                            $ticket_count++;
                        ?>
                Name: <input type="text" name="debug_name" id="debug_name_<?php echo $parti_count; ?>" value="<?php echo $row1['participants_name'];?>" readonly/> 
                <input type="button"  onclick="edit_text('debug_name_<?php echo $parti_count; ?>','<?php echo $row1['participants_name'];?>','debug_edit_button_<?php echo $parti_count; ?>','debug_done_button_<?php echo $parti_count; ?>');" id="debug_edit_button_<?php echo $parti_count; ?>" value="Edit"/>
                <input type="button" style="display: none;" onclick="done_edit('debug_name_<?php echo $parti_count; ?>','debug_edit_button_<?php echo $parti_count; ?>','debug_done_button_<?php echo $parti_count; ?>','software_debugging','participants_name','clgname_<?php echo $parti_count; ?>','dep_name_<?php echo $parti_count; ?>');" id="debug_done_button_<?php echo $parti_count; ?>" value="Done"/>
                
                Class: <input type="text" name="debug_class" id="debug_class_<?php echo $parti_count; ?>" value="<?php echo $row1['class'];?>" readonly/>
                <input type="button"  onclick="edit_text('debug_class_<?php echo $parti_count; ?>','<?php echo $row1['class'];?>','debug_class_edit_button_<?php echo $parti_count; ?>','debug_class_done_button_<?php echo $parti_count; ?>');" id="debug_class_edit_button_<?php echo $parti_count; ?>" value="Edit"/>
                <input type="button" style="display: none;" onclick="done_edit('debug_class_<?php echo $parti_count; ?>','debug_class_edit_button_<?php echo $parti_count; ?>','debug_class_done_button_<?php echo $parti_count; ?>','software_debugging','class','clgname_<?php echo $parti_count; ?>','dep_name_<?php echo $parti_count; ?>');" id="debug_class_done_button_<?php echo $parti_count; ?>" value="Done"/>
                <?php } 
                if($ticket_count<1)
                { ?>
                    <center><input type="button" onclick="add_participant('software_debugging','<?php echo $clg_name; ?>','<?php echo $dep_name; ?>',<?php echo $ticket_count; ?>,1);" id="add_participant_button<?php echo $parti_count; ?>" value="ADD" /></center>

            <?php    }
                ?>


                <br><h4>4.Art from E-Waste : </h4>
                <?php
                        $conn= new mysqli("localhost","root","","eyes_2k24");
                        if($conn->connect_error)
                            die("connection Failed : ".$conn->connect_error);
                        $sql="SELECT participants_name , class FROM art_from_e_waste WHERE college_name='$clg_name' and department_name='$dep_name'";
                        $art=$conn->query($sql);
                        $conn->close();

                        $counter=0;
                        $ticket_count=0;
                        while($row1=$art->fetch_assoc())
                        { 
                            $counter++;
                            $ticket_count++;
                ?>
                Name: <input type="text" name="art_name" id="art_name_<?php echo $parti_count.'_'.$counter; ?>" value="<?php echo $row1['participants_name'];?>" readonly/>

                <input type="button"  onclick="edit_text('art_name_<?php echo $parti_count.'_'.$counter; ?>','<?php echo $row1['participants_name'];?>','art_edit_button_<?php echo $parti_count.'_'.$counter; ?>','art_done_button_<?php echo $parti_count.'_'.$counter; ?>');" id="art_edit_button_<?php echo $parti_count.'_'.$counter; ?>" value="Edit"/>
                <input type="button" style="display: none;" onclick="done_edit('art_name_<?php echo $parti_count.'_'.$counter; ?>','art_edit_button_<?php echo $parti_count.'_'.$counter; ?>','art_done_button_<?php echo $parti_count.'_'.$counter; ?>','art_from_e_waste','participants_name','clgname_<?php echo $parti_count; ?>','dep_name_<?php echo $parti_count; ?>');" id="art_done_button_<?php echo $parti_count.'_'.$counter; ?>" value="Done"/>
                
                Class: <input type="text" name="art_class" id="art_class_<?php echo $parti_count.'_'.$counter; ?>" value="<?php echo $row1['class'];?>" readonly/>

                <input type="button"  onclick="edit_text('art_class_<?php echo $parti_count.'_'.$counter; ?>','<?php echo $row1['class'];?>','art_class_edit_button_<?php echo $parti_count.'_'.$counter; ?>','art_class_done_button_<?php echo $parti_count.'_'.$counter; ?>');" id="art_class_edit_button_<?php echo $parti_count.'_'.$counter; ?>" value="Edit"/>
                <input type="button" style="display: none;" onclick="done_edit('art_class_<?php echo $parti_count.'_'.$counter; ?>','art_class_edit_button_<?php echo $parti_count.'_'.$counter; ?>','art_class_done_button_<?php echo $parti_count.'_'.$counter; ?>','art_from_e_waste','class','clgname_<?php echo $parti_count; ?>','dep_name_<?php echo $parti_count; ?>');" id="art_class_done_button_<?php echo $parti_count.'_'.$counter; ?>" value="Done"/><br>
                <?php } 
                if($ticket_count<2)
                { ?>
                    <center><input type="button" onclick="add_participant('art_from_e_waste','<?php echo $clg_name; ?>','<?php echo $dep_name; ?>',<?php echo $ticket_count; ?>,2);" id="add_participant_button<?php echo $parti_count; ?>" value="ADD" /></center>

            <?php    }
                ?>


                        <br><h4>5.Tiktok : </h4>
                    <?php
                        $conn= new mysqli("localhost","root","","eyes_2k24");
                        if($conn->connect_error)
                            die("connection Failed : ".$conn->connect_error);
                        $sql="SELECT participants_name , class FROM tiktok WHERE college_name='$clg_name' and department_name='$dep_name'";
                        $tiktok=$conn->query($sql);
                        $conn->close();

                        $counter=0;
                        $ticket_count=0;
                        while($row1=$tiktok->fetch_assoc())
                        { 
                            $counter++;
                            $ticket_count++;
                    ?>
                        Name: <input type="text" name="tiktok_name" id="tiktok_name_<?php echo $parti_count.'_'.$counter; ?>" value="<?php echo $row1['participants_name'];?>" readonly/> 

                        <input type="button"  onclick="edit_text('tiktok_name_<?php echo $parti_count.'_'.$counter; ?>','<?php echo $row1['participants_name'];?>','tiktok_edit_button_<?php echo $parti_count.'_'.$counter; ?>','tiktok_done_button_<?php echo $parti_count.'_'.$counter; ?>');" id="tiktok_edit_button_<?php echo $parti_count.'_'.$counter; ?>" value="Edit"/>
                <input type="button" style="display: none;" onclick="done_edit('tiktok_name_<?php echo $parti_count.'_'.$counter; ?>','tiktok_edit_button_<?php echo $parti_count.'_'.$counter; ?>','tiktok_done_button_<?php echo $parti_count.'_'.$counter; ?>','tiktok','participants_name','clgname_<?php echo $parti_count; ?>','dep_name_<?php echo $parti_count; ?>');" id="tiktok_done_button_<?php echo $parti_count.'_'.$counter; ?>" value="Done"/>

                        Class: <input type="text" name="tiktok_class" id="tiktok_class_<?php echo $parti_count.'_'.$counter; ?>" value="<?php echo $row1['class'];?>" readonly/>
                        <input type="button"  onclick="edit_text('tiktok_class_<?php echo $parti_count.'_'.$counter; ?>','<?php echo $row1['class'];?>','tiktok_class_edit_button_<?php echo $parti_count.'_'.$counter; ?>','tiktok_class_done_button_<?php echo $parti_count.'_'.$counter; ?>');" id="tiktok_class_edit_button_<?php echo $parti_count.'_'.$counter; ?>" value="Edit"/>
                <input type="button" style="display: none;" onclick="done_edit('tiktok_class_<?php echo $parti_count.'_'.$counter; ?>','tiktok_class_edit_button_<?php echo $parti_count.'_'.$counter; ?>','tiktok_class_done_button_<?php echo $parti_count.'_'.$counter; ?>','tiktok','class','clgname_<?php echo $parti_count; ?>','dep_name_<?php echo $parti_count; ?>');" id="tiktok_class_done_button_<?php echo $parti_count.'_'.$counter; ?>" value="Done"/><br>
                        <?php }

                        if($ticket_count<2)
                        { ?>
                            <center><input type="button" onclick="add_participant('tiktok','<?php echo $clg_name; ?>','<?php echo $dep_name; ?>',<?php echo $ticket_count; ?>,2);" id="add_participant_button<?php echo $parti_count; ?>" value="ADD" /></center>
        
                    <?php    }
                        ?>
        
                    <br><h4>6.Quiz : </h4>
                    <?php
                        $conn= new mysqli("localhost","root","","eyes_2k24");
                        if($conn->connect_error)
                            die("connection Failed : ".$conn->connect_error);
                        $sql="SELECT participants_name ,class FROM quiz WHERE college_name='$clg_name' and department_name='$dep_name'";
                        $quiz=$conn->query($sql);
                        $conn->close();

                        $counter=0;
                        $ticket_count=0;
                        while($row1=$quiz->fetch_assoc())
                        { 
                            $counter++;
                            $ticket_count++;
                    ?>
                            Name: <input type="text" name="quiz_name" id="quiz_name_<?php echo $parti_count.'_'.$counter; ?>" value="<?php echo $row1['participants_name'];?>" readonly/> 
                            <input type="button"  onclick="edit_text('quiz_name_<?php echo $parti_count.'_'.$counter; ?>','<?php echo $row1['participants_name'];?>','quiz_edit_button_<?php echo $parti_count.'_'.$counter; ?>','quiz_done_button_<?php echo $parti_count.'_'.$counter; ?>');" id="quiz_edit_button_<?php echo $parti_count.'_'.$counter; ?>" value="Edit"/>
                <input type="button" style="display: none;" onclick="done_edit('quiz_name_<?php echo $parti_count.'_'.$counter; ?>','quiz_edit_button_<?php echo $parti_count.'_'.$counter; ?>','quiz_done_button_<?php echo $parti_count.'_'.$counter; ?>','quiz','participants_name','clgname_<?php echo $parti_count; ?>','dep_name_<?php echo $parti_count; ?>');" id="quiz_done_button_<?php echo $parti_count.'_'.$counter; ?>" value="Done"/>

                            Class: <input type="text" name="quiz_class" id="quiz_class_<?php echo $parti_count.'_'.$counter; ?>" value="<?php echo $row1['class'];?>" readonly/>
                            <input type="button"  onclick="edit_text('quiz_class_<?php echo $parti_count.'_'.$counter; ?>','<?php echo $row1['class'];?>','quiz_class_edit_button_<?php echo $parti_count.'_'.$counter; ?>','quiz_class_done_button_<?php echo $parti_count.'_'.$counter; ?>');" id="quiz_class_edit_button_<?php echo $parti_count.'_'.$counter; ?>" value="Edit"/>
                <input type="button" style="display: none;" onclick="done_edit('quiz_class_<?php echo $parti_count.'_'.$counter; ?>','quiz_class_edit_button_<?php echo $parti_count.'_'.$counter; ?>','quiz_class_done_button_<?php echo $parti_count.'_'.$counter; ?>','quiz','class','clgname_<?php echo $parti_count; ?>','dep_name_<?php echo $parti_count; ?>');" id="quiz_class_done_button_<?php echo $parti_count.'_'.$counter; ?>" value="Done"/><br>
                    <?php } 
                    if($ticket_count<2)
                    { ?>
                        <center><input type="button" onclick="add_participant('quiz','<?php echo $clg_name; ?>','<?php echo $dep_name; ?>',<?php echo $ticket_count; ?>,2);" id="add_participant_button<?php echo $parti_count; ?>" value="ADD" /></center>
    
                <?php    }
                    ?>
    

                    <br><h4>7.As You Like It : </h4>
                    <?php
                        $conn= new mysqli("localhost","root","","eyes_2k24");
                        if($conn->connect_error)
                            die("connection Failed : ".$conn->connect_error);
                        $sql="SELECT participants_name , class FROM as_you_like_it WHERE college_name='$clg_name' and department_name='$dep_name'";
                        $software_contest=$conn->query($sql);
                        $conn->close();

                        $counter=0;
                        $ticket_count=0;
                    while($row1=$software_contest->fetch_assoc())
                        { 
                            $counter++;
                            $ticket_count++;
                        ?>
                        Name: <input type="text" name="as_you_like_it_name" id="as_you_like_it_name_<?php echo $parti_count.'_'.$counter; ?>" value="<?php echo $row1['participants_name'];?>" readonly/>
                        <input type="button"  onclick="edit_text('as_you_like_it_name_<?php echo $parti_count.'_'.$counter; ?>','<?php echo $row1['participants_name'];?>','as_you_like_it_edit_button_<?php echo $parti_count.'_'.$counter; ?>','as_you_like_it_done_button_<?php echo $parti_count.'_'.$counter; ?>');" id="as_you_like_it_edit_button_<?php echo $parti_count.'_'.$counter; ?>" value="Edit"/>
                        <input type="button" style="display: none;" onclick="done_edit('as_you_like_it_name_<?php echo $parti_count.'_'.$counter; ?>','as_you_like_it_edit_button_<?php echo $parti_count.'_'.$counter; ?>','as_you_like_it_done_button_<?php echo $parti_count.'_'.$counter; ?>','as_you_like_it','participants_name','clgname_<?php echo $parti_count; ?>','dep_name_<?php echo $parti_count; ?>');" id="as_you_like_it_done_button_<?php echo $parti_count.'_'.$counter; ?>" value="Done"/>

                        Class: <input type="text" name="as_you_like_it_class" id="as_you_like_it_class_<?php echo $parti_count.'_'.$counter; ?>" value="<?php echo $row1['class'];?>" readonly/>
                        <input type="button"  onclick="edit_text('as_you_like_it_class_<?php echo $parti_count.'_'.$counter; ?>','<?php echo $row1['class'];?>','as_you_like_it_class_edit_button_<?php echo $parti_count.'_'.$counter; ?>','as_you_like_it_class_done_button_<?php echo $parti_count.'_'.$counter; ?>');" id="as_you_like_it_class_edit_button_<?php echo $parti_count.'_'.$counter; ?>" value="Edit"/>
                        <input type="button" style="display: none;" onclick="done_edit('as_you_like_it_class_<?php echo $parti_count.'_'.$counter; ?>','as_you_like_it_class_edit_button_<?php echo $parti_count.'_'.$counter; ?>','as_you_like_it_class_done_button_<?php echo $parti_count.'_'.$counter; ?>','as_you_like_it','class','clgname_<?php echo $parti_count; ?>','dep_name_<?php echo $parti_count; ?>');" id="as_you_like_it_class_done_button_<?php echo $parti_count.'_'.$counter; ?>" value="Done"/><br>
                    <?php } 
                            if($ticket_count<5)
                            { ?>
                                <center><input type="button" onclick="add_participant('as_you_like_it','<?php echo $clg_name; ?>','<?php echo $dep_name; ?>',<?php echo $ticket_count; ?>,5);" id="add_participant_button<?php echo $parti_count; ?>" value="ADD" /></center>
            
                        <?php    }
                            ?>
            
                </form>
            </details>
        <?php } ?>
        </div>
    </div>
        <script>
        $(document).ready(function() {
            $("details").on("click", function() {
                $("details[open]")
                    .not(this)
                    .removeAttr("open");
            });
        });
    </script>
</body>

</html>
