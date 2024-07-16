<?php include('DbQuerries.php')?>
<?php
    if(isset($_GET['year'])) {
        $year = $_GET['year'];
        $totalGiderByMonth = selectTotalGiderByMonth($year);
        echo json_encode($totalGiderByMonth);
    }
?>