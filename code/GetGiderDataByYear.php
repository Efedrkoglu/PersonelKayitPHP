<?php include('DbQuerries.php')?>
<?php
    $totalGiderByYear = selectTotalGiderByYear();
    echo json_encode($totalGiderByYear);
?>