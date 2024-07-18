<?php $title = "Gelir Ekle";?>
<?php include('navbar.php')?>
<?php include('../code/CheckAuthorized.php')?>
<?php include('../code/DbQuerries.php')?>

<?php
    if(isset($_POST['addGelir'])) {
        $gelir = new Gelir(
            0,
            $_POST['ad'],
            $_POST['miktar'],
            $_POST['aciklama'],
            $_POST['tarih']
        );

        insertGelir($gelir);
    }
    if(isset($_POST['addGider'])) {
        $gider = new Gider(
            0,
            $_POST['ad'],
            $_POST['miktar'],
            $_POST['aciklama'],
            $_POST['tarih']
        );

        insertGider($gider);
    }
?>

<div class="container mt-5">
    <h4>Gelir Ekle</h4>
    <form action="" method="POST">
        <div class="row mb-2">
            <input class="form-control" type="text" name="ad" placeholder="Ad">
        </div>
        <div class="row mb-2">
            <input class="form-control" type="number" name="miktar" placeholder="Miktar">
        </div>
        <div class="row mb-2">
            <input class="form-control" type="text" name="aciklama" placeholder="Açıklama">
        </div>
        <div class="row mb-2">
            <input class="form-control" type="date" name="tarih">
        </div>
        <input class="btn btn-success btn-sm" type="submit" name="addGelir" value="Kaydet">
    </form>
    <hr>
    <h4>Gider Ekle</h4>
    <form action="" method="POST">
        <div class="row mb-2">
            <input class="form-control" type="text" name="ad" placeholder="Ad">
        </div>
        <div class="row mb-2">
            <input class="form-control" type="number" name="miktar" placeholder="Miktar">
        </div>
        <div class="row mb-2">
            <input class="form-control" type="text" name="aciklama" placeholder="Açıklama">
        </div>
        <div class="row mb-2">
            <input class="form-control" type="date" name="tarih">
        </div>
        <input class="btn btn-success btn-sm" type="submit" name="addGider" value="Kaydet">
    </form>
</div>

<?php include('footer.php')?>