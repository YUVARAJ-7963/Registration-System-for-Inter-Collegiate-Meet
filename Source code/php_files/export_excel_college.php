<?php
require 'excel/vendor/autoload.php'; 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $college_name = $_POST['college_name'];
    $department_name = $_POST['department_name'];
    $conn = new mysqli("localhost", "root", "", "eyes_2k24");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $competitions = [
        "Software Contest" => "software_contest",
        "Web Designing" => "web_designing",
        "Software Debugging" => "software_debugging",
        "Art from E-Waste" => "art_from_e_waste",
        "TikTok" => "tiktok",
        "Quiz" => "quiz",
        "As You Like It" => "as_you_like_it"
    ];

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
   
   
    // Adjust column widths and set wrap text
    $sheet->getColumnDimension('A')->setWidth(20);
    $sheet->getColumnDimension('B')->setWidth(25);
    $sheet->getColumnDimension('C')->setWidth(15);
    $sheet->getColumnDimension('D')->setWidth(25);
    $sheet->getColumnDimension('E')->setWidth(30);
    
    // Add competition details
    $sheet->setCellValue('A1', 'Competitions');
    $sheet->setCellValue('B1', 'Participants Name');
    $sheet->setCellValue('C1', 'Class');
    $sheet->setCellValue('D1', 'Department Name');
    $sheet->setCellValue('E1', 'College Name');
    
    $rowCount = 2;
    foreach ($competitions as $competition => $table_name) {
        $sql = "SELECT participants_name, class FROM $table_name WHERE college_name='$college_name' AND department_name='$department_name'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $sheet->setCellValue('A' . $rowCount, $competition);
                $sheet->setCellValue('B' . $rowCount, $row['participants_name']);
                $sheet->setCellValue('C' . $rowCount, $row['class']);
                $sheet->setCellValue('D' . $rowCount, $department_name);
                $sheet->setCellValue('E' . $rowCount, $college_name);
                $rowCount++;
            }
        }
    }

    // Set page settings to A4 size
    $sheet->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A4);

    $writer = new Xlsx($spreadsheet);
    $filename = $college_name . '_' . $department_name . '_participants.xlsx';
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . urlencode($filename) . '"');
    
    $writer->save('php://output');
    exit();
}
?>
