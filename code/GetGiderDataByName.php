<?php include('DbQuerries.php')?>
<?php
    $totalGiderByName = selectTotalGiderByName();
    echo json_encode($totalGiderByName);
?>