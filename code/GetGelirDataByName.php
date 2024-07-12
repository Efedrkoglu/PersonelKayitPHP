<?php include('DbQuerries.php')?>
<?php
    $totalGelirByName = selectTotalGelirByName();
    echo json_encode($totalGelirByName);
?>