<?php include('../code/DbQuerries.php')?>
<?php include('../code/CheckAuthorized.php')?>

<?php
    if(isset($_GET['edit'])) {
        $gider = selectGiderById($_GET['edit']);
    }
    if(isset($_POST['güncelle'])) {
        $gider->ad = $_POST['ad'];
        $gider->miktar = $_POST['miktar'];
        $gider->aciklama = $_POST['aciklama'];
        $gider->tarih = $_POST['tarih'];
        updateGider($gider);
        header("Location: giderList.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gider Düzenle</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    </head>
    <body>
        <div class="container mt-5">
            <h4>Gider Düzenle</h4>
            <form action="" method="POST">
                <div class="row mb-2">
                    <input class="form-control" type="text" name="ad" value="<?php echo $gider->ad;?>" placeholder="Ad">
                </div>
                <div class="row mb-2">
                    <input class="form-control" type="number" name="miktar" value="<?php echo $gider->miktar;?>" placeholder="Miktar">
                </div>
                <div class="row mb-2">
                    <input class="form-control" type="text" name="aciklama" value="<?php echo $gider->aciklama;?>" placeholder="Açıklama">
                </div>
                <div class="row mb-2">
                    <input class="form-control" type="date" name="tarih" value="<?php echo $gider->tarih;?>">
                </div>
                <input class="btn btn-success btn-sm" type="submit" name="güncelle" value="Güncelle">
                <a href="giderList.php" class="btn btn-secondary btn-sm">Geri</a>
            </form>
        </div>
    </body>
</html>