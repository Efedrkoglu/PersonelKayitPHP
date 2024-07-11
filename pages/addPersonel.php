<?php $title = "Personel Ekle"?>
<?php include 'header.php'?>
<?php include('../code/DbQuerries.php')?>
<?php include('../code/CheckAuthorized.php')?>


<div class="container mt-5">
    <h4>Personel Ekle</h4>
    <form action="" method="POST">
        <div class="row">
            <div class="col">
                <input type="text" id="ad" name="ad" class="form-control" placeholder="Ad">
            </div>
            <div class="col">
                <input type="text" id="soyad" name="soyad" class="form-control" placeholder="Soyad">
            </div>
            <div class="col">
                <select name="cinsiyet" class="form-select">
                    <option value="Erkek">Erkek</option>
                    <option value="Kadın">Kadın</option>
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
                            echo "<option value='" . $department->getId() . "'>" . $department->getName() . "</option>";
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
                            echo "<option value='" . $unvan->getId() . "'>" . $unvan->getName() . "</option>";
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col">
            <label for="proje" class="form-label">Proje</label>
                <input type="text" id="proje" name="proje" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="ise_giris_tarihi">İşe Giris Tarihi</label>
                <input type="date" id="ise_baslama_tarihi" name="ise_baslama_tarihi" class="form-control">
            </div>
            <div class="col">
                <label for="dogum_tarihi">Doğum Tarihi</label>
                <input type="date" id="dogum_tarihi" name="dogum_tarihi" class="form-control">
            </div>
        </div>
        <input class="btn btn-success btn-sm mt-2" type="submit" name="Kaydet" value="Kaydet">
    </form>
</div>
<?php
    if(isset($_POST['Kaydet'])) {
        $personel = new Personel(
            1,
            $_POST['ad'],
            $_POST['soyad'],
            $_POST['cinsiyet'],
            $_POST['dogum_tarihi'],
            selectDepartmentById($_POST['department']),
            selectUnvanById($_POST['unvan']),
            $_POST['ise_baslama_tarihi'],
            "",
            "",
            $_POST['proje']
        );
        insertPersonel($personel);
    }
?>
<?php include 'footer.php'?>