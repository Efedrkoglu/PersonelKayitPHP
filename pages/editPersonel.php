<?php include('../code/DbQuerries.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personel Düzenle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        if(isset($_GET['edit'])) {
            $personel = selectPersonelById($_GET['edit']);
        }
    ?>
    <div class="container mt-5">
        <form action="" method="POST" class="mt-2">
            <div class="row">
                <div class="col">
                    <input type="text" id="ad" name="ad" class="form-control" value="<?php echo $personel->getAd();?>" placeholder="Ad">
                </div>
                <div class="col">
                    <input type="text" id="soyad" name="soyad" class="form-control" value="<?php echo $personel->getSoyad();?>" placeholder="Soyad">
                </div>
                <div class="col">
                    <select name="cinsiyet" class="form-select">
                        <option value="Erkek" <?php echo $personel->getCinsiyet() == 'Erkek' ? 'selected' : ''; ?>>Erkek</option>
                        <option value="Kadın" <?php echo $personel->getCinsiyet() == 'Kadın' ? 'selected' : ''; ?>>Kadın</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="department" class="form-label">Department</label>
                    <select id="department" name="department" class="form-select">
                        <?php
                            $departments = selectDepartment();
                            foreach($departments as $department) {
                                $selected = $department->getId() == $personel->getDepartment()->getId() ? 'selected' : '';
                                echo "<option value='" . $department->getId() . "' {$selected}>" . $department->getName() . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <label for="unvan" class="form-label">Unvan</label>
                    <select id="unvan" name="unvan" class="form-select">
                        <?php
                            $unvanArray = selectUnvan();
                            foreach($unvanArray as $unvan) {
                                $selected = $unvan->getId() == $personel->getUnvan()->getId() ? 'selected' : '';
                                echo "<option value='" . $unvan->getId() . "' {$selected}>" . $unvan->getName() . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                <label for="proje" class="form-label">Proje</label>
                    <input type="text" id="proje" name="proje" class="form-control" value="<?php echo $personel->getProje();?>">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="ise_giris_tarihi">İşe Giris Tarihi</label>
                    <input type="date" id="ise_baslama_tarihi" name="ise_baslama_tarihi" class="form-control" value="<?php echo $personel->getIseBaslamaTarihi();?>">
                </div>
                <div class="col">
                    <label for="dogum_tarihi">Doğum Tarihi</label>
                    <input type="date" id="dogum_tarihi" name="dogum_tarihi" class="form-control" value="<?php echo $personel->getDogumTarihi();?>">
                </div>
            </div>
            <div class="row">
            <div class="col">
                    <label for="ise_giris_tarihi">İzin Tarihi</label>
                    <input type="date" id="izin_tarihi" name="izin_tarihi" class="form-control" value="<?php echo $personel->getIzinTarihi();?>">
                </div>
            </div>
            <input class="btn btn-secondary btn-sm mt-2" type="submit" name="Güncelle" value="Güncelle">
            <a class="btn btn-secondary btn-sm mt-2" href="personelList.php">Geri</a>
        </form>
    </div>
</body>
</html>
<?php
    if(isset($_POST['Güncelle'])) {
        $personel->setAd($_POST['ad']);
        $personel->setSoyad($_POST['soyad']);
        $personel->setCinsiyet($_POST['cinsiyet']);
        $personel->setDogumTarihi($_POST['dogum_tarihi']);
        $personel->setDepartment(selectDepartmentById($_POST['department']));
        $personel->setUnvan(selectUnvanById($_POST['unvan']));
        $personel->setIseBaslamaTarihi($_POST['ise_baslama_tarihi']);
        $personel->setIzinTarihi($_POST['izin_tarihi']);
        $personel->setProje($_POST['proje']);
        updatePersonel($personel);
        header("Location: personelList.php");
        exit();
    }
?>

<?php include('footer.php')?>