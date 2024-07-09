<?php $title = "Personel Ekle"?>
<?php include('header.php')?>
<?php include('DbQuerries.php')?>


<div class="container mt-5">
    <form action="" method="POST">
        <div class="row">
            <div class="col">
                <label for="ad" class="form-label">Ad</label>
                <input type="text" id="ad" name="ad" class="form-control">
            </div>
            <div class="col">
                <label for="Soyad" class="form-label">Soyad</label>
                <input type="text" id="soyad" name="soyad" class="form-control">
            </div>
        </div>
        <div class="row">
        <div class="col">
                <label for="cinsiyet" class="form-label">Cinsiyet</label>
                <select id="cinsiyet" name="cinsiyet" class="form-select">
                    <option>Erkek</option>
                    <option>Kadın</option>
                </select>
            </div>
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
                <label for="ise_giris_tarihi">Ise giris tarihi</label>
                <input type="date" id="ise_baslama_tarihi" name="ise_baslama_tarihi" class="form-control">
            </div>
            <div class="col">
                <label for="dogum_tarihi">Dogum tarihi</label>
                <input type="date" id="dogum_tarihi" name="dogum_tarihi" class="form-control">
            </div>
        </div>
        <input class="btn btn-secondary btn-sm" type="submit" name="Kaydet" value="Kaydet">
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
            $_POST['proje']
        );
        insertPersonel($personel);
    }
?>
<?php include 'footer.php'?>