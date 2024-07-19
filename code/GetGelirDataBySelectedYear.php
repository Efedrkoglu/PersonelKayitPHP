<?php include('DbQuerries.php')?>
<?php
    if(isset($_GET['year'])) {
        $year = $_GET['year'];
        $totalGelirBySelectedYear = selectTotalGelirBySelectedYear($year);
        echo json_encode($totalGelirBySelectedYear);
    }
?>