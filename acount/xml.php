<?php
    require_once __DIR__.'/boot.php';
    $array = $_SESSION['arr'];
    $filename =  time().".xls";      
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");

    ExportFile($array);
    function ExportFile($records) {
        $heading = false;
            if(!empty($records))
            foreach($records as $row) {
                if(!$heading) {
                echo implode("\t", array_keys($row)) . "\n";
                $heading = true;
                }
                echo implode("\t", array_values($row)) . "\n";
            }
        exit;
    }


?>