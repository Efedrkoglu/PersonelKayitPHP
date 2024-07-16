<?php include('DbQuerries.php')?>
<?php
    if(isset($_GET['year'])) {
        $year = $_GET['year'];
        $totalGelirByMonth = selectTotalGelirByMonth($year);
        echo json_encode($totalGelirByMonth);
    }
?>