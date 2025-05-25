<?php
require_once('pdf/vendor/autoload.php');
include 'connect_and_fetch.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $college_name = $_POST['college_name'];
    $department_name = $_POST['department_name'];

    $competitions = [
        'Software Contest' => 'software_contest',
        'Web Designing' => 'web_designing',
        'Software Debugging' => 'software_debugging',
        'Art from E-Waste' => 'art_from_e_waste',
        'TikTok' => 'tiktok',
        'Quiz' => 'quiz',
        'As You Like It' => 'as_you_like_it'
    ];

    $pdf = new TCPDF();
    $pdf->AddPage();

    // Set title and author
    $pdf->SetTitle("Participants from $college_name ($department_name)");
    $pdf->SetAuthor('Department of Information Technology');

    $html = '<html>
                <style>
                body {
                    font-family: DejaVu Sans, Arial, sans-serif;
                    border: 2px solid #000;
                    padding: 20px;
                }
                h1 {
                    text-align: center;
                }
                .outside_table {
                    width: 100%;
                    border: 2px solid black;
                    border-collapse: collapse;
                    margin-top: 20px;
                    font-size:10px;
                }
                .outside_table th, .outside_table td {
                    padding: 10px;
                    text-align: center;
                    border: 1px solid black;
                }
                .outside_table th {
                    background-color: #cf9be9;
                    padding: 15px;
                    
                    
                }
                    .
                .outside_table td table {
                    width: 100%;
                    border-collapse: collapse;
                }
                .outside_table td table td {
                    padding: 10px;
                    text-align: center;
                    border: 1px solid black;
                }
                h3 {
                    text-align: left;
                }
                .info {
                    text-align: center;
                }
               .header-table {
                        width: 100%;
                        margin-bottom: 20px;
                        
                        width:900px;
                    }
                    .header-table td {
                        text-align: center;
                       
                    }
                 img {
                        height: 70px;
                        width: 70px;
                    }      
            </style>
                <body>
                    <table class="header-table">
                        <tr>
                            <td style="width:55px;"><br><br><img src="../images/logo.jpg" alt="Logo" /></td>
                            <td style="width:415px;"><br><h1 style="font-size:20px;"> V.H.N.SenthiKumara Nadar College</h1></td>
                            <td style="width:55px;"><br><br><img src="../images/statue logo.jpg" alt="Statue Logo" /></td>
                        </tr>
                        <tr>
                            <td style="width:35px;"></td>
                            <td style="width:45px;"><br><br><img src="../images/department_logo.jpg" alt="Logo" /></td>
                            <td style="width:365px;"><br><h1 style="font-size:16px;"> Department of Information Technology</h1></td>
                            <td style="width:45px;"><br><br><img src="../images/silver_jubliee_logo.jpg" alt="Logo" /></td>
                        </tr>
                    </table>
                    <h1> EYIS\' 2K24 <br><img src="../images/eyis 2k24 logo.jpg" width="60" height="45" alt="Logo" /> </h1>
                    <h4>College Name: ' . $college_name .'<br>Department Name: '. $department_name . '</h4>';
    
    $html .= '<table class="outside_table">
                <tr>
                    <th><br><br>COMPETITIONS<br></th>
                    <th><br><br>PARTICIPANTS  NAME<br></th>
                    <th><br><br>CLASS<br></th>
                    <th><br><br>SIGNATURE<br></th>
                </tr>';

    foreach ($competitions as $competition_name => $table_name) {
        $result = connect_and_fetch("SELECT participants_name, class FROM $table_name WHERE college_name='$college_name' and department_name='$department_name'");
        if ($result->num_rows > 0) {
                $html .= '<tr>
                            <td><br><br>' . $competition_name . '<br></td>
                            <td><table><br><br>';
                                while ($row = $result->fetch_assoc()) {
                                    $html .= "<tr><td><br>{$row['participants_name']}<br></td></tr>";
                                }
                                $html .= "</table></td><td><table><br><br>";
                                $result->data_seek(0); 
                                while ($row = $result->fetch_assoc()) {
                                    $html .= "<tr><td><br>{$row['class']}<br></td></tr>";
                                }
                                $html .= "</table></td><td><table>";
                                $result->data_seek(0); 
                                while ($row = $result->fetch_assoc()) {
                                    $html.= "<tr><td><br><br></td></tr>";
                                }
                                $html .= "</table></td></tr>";
            }
        }
    }

    $html .= '</table></body></html>';
    $pdf->writeHTML($html, true, false, true, false, '');

    // Output PDF document
    $pdf->Output("Participants_from_" . str_replace(' ', '_', $college_name) . "_" . str_replace(' ', '_', $department_name) . ".pdf", 'I'); // 'I' for preview
    $pdf->Output("Participants_from_" . str_replace(' ', '_', $college_name) . "_" . str_replace(' ', '_', $department_name) . ".pdf", 'D'); // 'D' for download

?>
