<?php
ini_set('gd.jpeg_ignore_warning', 1); // Suppress GD warnings

require_once('pdf/vendor/autoload.php'); // Ensure this path is correct
include 'connect_and_fetch.php'; // Ensure this file exists and is correct

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $competition = $_POST['competition'];

    // Initialize TCPDF
    $pdf = new TCPDF();
    $pdf->AddPage();

    // Set PDF metadata
    $pdf->SetTitle(ucfirst(str_replace('_', ' ', $competition)));
    $pdf->SetAuthor('Department of Information Technology');

    // Start generating HTML content
    $html = '<html>
                <style>
                    body {
                        font-family: DejaVu Sans, Arial, sans-serif;
                        border: 2px solid #000;
                        padding: 20px;
                    }
                    h1, h2 {
                        text-align: center;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        font-size: 10px;
                        
                    }
                    th, td {
                        text-align: center;
                        
                    }
                    th {
                        background-color: #f2f2f2;
                    }
                    tr:nth-child(odd) {
                        background-color: #f9f9f9;
                    }
                    tr:nth-child(even) {
                        background-color: #ffffff;
                    }
                    .lot {
                        width: 25px;
                    }
                    .sign {
                        width: 85px;
                    }
                    .name {
                        width: 114px;
                    }
                    .college {
                        width: 132px;
                    }
                    .cls {
                        width: 75px;
                    }
                    .dep {
                        width: 80px;
                    }
                    .s_no {
                        width: 25px;
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
                    .hed2{
                        line-height:50%;
                        font-size:10px;}
                    h1{
                        margin:0px;}
                    
                </style>
                <body><br>
                    <table class="header-table">
                        <tr>
                            <td style="width:55px;"><br><br><img src="../images/logo.jpg" alt="Logo" /></td>
                            <td style="width:415px;"><br><h1 style="font-size:20px;"> V.H.N.SenthiKumara Nadar College 
                            <div class="hed2">An Autonomous Instution, Affliated to Madurai Kamaraj University</div></h1></td>
                            <td style="width:55px;"><br><br><img src="../images/statue logo.jpg" alt="Statue Logo" /></td>
                        </tr>
                    </table>
                    <table class="header-table">
                        <tr>
                            <td style="width:35px;"></td>
                            <td style="width:45px;"><br><br><img src="../images/department_logo.jpg" alt="Logo" /></td>
                            <td style="width:365px;"><br><h1 style="font-size:16px;"> Department of Information Technology</h1></td>
                            <td style="width:45px;"><br><br><img src="../images/silver_jubliee_logo.jpg" alt="Logo" /></td>
                        </tr>
                    </table>
                    <h1> EYIS\' 2K24 <br><img src="../images/eyis 2k24 logo.jpg" width="60" height="45" alt="Logo" /> </h1>
                    <h1></h1>
                    <h3 style="text-align:left;">Competition Name: ' . ucfirst(str_replace('_', ' ', $competition)) . '</h3>
                    <table border="1" cellpadding="4">
                        <tr>
                            <th class="s_no">S. No</th>
                            <th class="lot">Lot</th>
                            <th class="name">Participants Name</th>
                            <th class="cls">Class</th>
                            <th class="dep">Department Name</th>
                            <th class="college">College Name</th>
                            <th class="sign">Signature</th>
                        </tr>';

    $serial_no = 0;
    $college_department = connect_and_fetch("SELECT * FROM college_and_department");
    $college_department->data_seek(0);

    while ($row0 = $college_department->fetch_assoc()) {
        $clg_name = $row0['college_name'];
        $dep_name = $row0['department_name'];
        $lot = $row0['lot'];

        // Fetch competition data
        $result = connect_and_fetch("SELECT participants_name, class FROM $competition WHERE college_name='$clg_name' AND department_name='$dep_name'");
        
        if ($result->num_rows > 0) {
            $serial_no++;
            $html .= "<tr>
                        <td><br><br>$serial_no<br></td>
                        <td><br><br>$lot<br></td>
                        <td><table>";

            $result->data_seek(0);
            while ($row = $result->fetch_assoc()) {
                $html .= "<tr><td><br><br>{$row['participants_name']}<br></td></tr>";
            }
            $html .= "</table></td>
                      <td><table>";

            $result->data_seek(0);
            while ($row = $result->fetch_assoc()) {
                $html .= "<tr><td><br><br>{$row['class']}<br></td></tr>";
            }
            $html .= "</table></td>
                      <td><br><br>$dep_name<br></td>
                      <td><br><br>$clg_name<br></td>
                      <td></td>
                      </tr>";
        }
    }
    
    $html .= '</table></body></html>';

    // Write HTML to PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Output PDF
    $pdf->Output(ucfirst(str_replace('_', ' ', $competition)) . '.pdf', 'I');
}
?>
