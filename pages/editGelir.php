<?php include('../code/DbQuerries.php')?>
<?php include('../code/CheckAuthorized.php')?>

<?php
    if(isset($_GET['edit'])) {
        $gelir = selectGelirById($_GET['edit']);
    }
    if(isset($_POST['güncelle'])) {
        $gelir->ad = $_POST['ad'];
        $gelir->miktar = $_POST['miktar'];
        $gelir->aciklama = $_POST['aciklama'];
        $gelir->tarih = $_POST['tarih'];
        updateGelir($gelir);
        header("Location: gelirList.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gelir Düzenle</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    </head>
    <body>
        <div class="container mt-5">
            <h4>Gelir Düzenle</h4>
            <form action="" method="POST">
                <div class="row mb-2">
                    <input class="form-control" type="text" name="ad" value="<?php echo $gelir->ad;?>" placeholder="Ad">
                </div>
                <div class="row mb-2">
                    <input class="form-control" type="number" name="miktar" value="<?php echo $gelir->miktar;?>" placeholder="Miktar">
                </div>
                <div class="row mb-2">
                    <input class="form-control" type="text" name="aciklama" value="<?php echo $gelir->aciklama;?>" placeholder="Açıklama">
                </div>
                <div class="row mb-2">
                    <input class="form-control" type="date" name="tarih" value="<?php echo $gelir->tarih;?>">
                </div>
                <input class="btn btn-success btn-sm" type="submit" name="güncelle" value="Güncelle">
                <a href="gelirList.php" class="btn btn-secondary btn-sm">Geri</a>
            </form>
        </div>
    </body>
</html>