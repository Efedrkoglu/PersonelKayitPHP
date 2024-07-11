<?php include('../code/DbQuerries.php')?>
<?php include('../code/CheckAuthorized.php')?>

<?php
    if(isset($_GET['edit'])) {
        $personel = selectPersonelById($_GET['edit']);
    }
?>
<?php
    if(isset($_POST['Güncelle'])) {
        $personel->setAd($_POST['ad']);
        $personel->setSoyad($_POST['soyad']);
        $personel->setCinsiyet($_POST['cinsiyet']);
        $personel->setDogumTarihi($_POST['dogum_tarihi']);
        $personel->setDepartment(selectDepartmentById($_POST['department']));
        $personel->setUnvan(selectUnvanById($_POST['unvan']));
        $personel->setIseBaslamaTarihi($_POST['ise_baslama_tarihi']);
        $personel->setIzinBaslangic($_POST['izin_baslangic']);
        $personel->setIzinBitis($_POST['izin_bitis']);
        $personel->setProje($_POST['proje']);
        updatePersonel($personel);
        header("Location: personelList.php");
        exit();
    }
?>

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
      <script>
        document.addEventListener("DOMContentLoaded", function() {
            const izinSuresiInput = document.getElementById('izin_suresi');
            const izinBaslangicTarihiInput = document.getElementById('izin_baslangic');
            const izinBitisTarihiInput = document.getElementById('izin_bitis');

            const today = new Date().toISOString().split('T')[0];
            izinBaslangicTarihiInput.value = today;

            izinSuresiInput.addEventListener('input', function() {
                let duration = parseInt(this.value);
                if (isNaN(duration) || duration < 0) {
                    this.value = 0;
                    duration = 0;
                }
                const startDate = new Date(izinBaslangicTarihiInput.value);
                startDate.setDate(startDate.getDate() + duration);
                izinBitisTarihiInput.value = startDate.toISOString().split('T')[0];
            });

            izinBitisTarihiInput.addEventListener('input', function() {
                const endDate = new Date(this.value);
                const startDate = new Date(izinBaslangicTarihiInput.value);
                const duration = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
                izinSuresiInput.value = duration >= 0 ? duration : 0;
            });

            izinBaslangicTarihiInput.addEventListener('input', function() {
                const duration = parseInt(izinSuresiInput.value);
                if (!isNaN(duration) && duration >= 0) {
                    const startDate = new Date(this.value);
                    startDate.setDate(startDate.getDate() + duration);
                    izinBitisTarihiInput.value = startDate.toISOString().split('T')[0];
                }
            });
        });
    </script> 
</head>
<body>
    <div class="container mt-5">
        <h4>Personel Düzenle</h4>
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
                    <label for="izin_suresi">İzin Süresi (gün)</label>
                    <input type="number" id="izin_suresi" name="izin_suresi" class="form-control" min="0">
                </div>
                <div class="col">
                    <label for="ise_giris_tarihi">İzin Başlangıç</label>
                    <input type="date" id="izin_baslangic" name="izin_baslangic" class="form-control" value="<?php echo $personel->getIzinBaslangic();?>">
                </div>
                <div class="col">
                    <label for="ise_giris_tarihi">İzin Bitiş</label>
                    <input type="date" id="izin_bitis" name="izin_bitis" class="form-control" value="<?php echo $personel->getIzinBitis();?>">
                </div>
            </div>
            <input class="btn btn-success btn-sm mt-2" type="submit" name="Güncelle" value="Güncelle">
            <a class="btn btn-secondary btn-sm mt-2" href="personelList.php">Geri</a>
        </form>
    </div>
</body>
</html>