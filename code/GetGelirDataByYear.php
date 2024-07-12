<?php include('DbQuerries.php')?>
<?php
    $totalGelirByYear = selectTotalGelirByYear();
    echo json_encode($totalGelirByYear);
?>