<?php $title = "Personel Ekle"?>
<?php include 'header.php'?>

<div class="container mt-5">
    <form action="" method="post">
        <div class="row">
            <div class="col">
                <input type="text" name="ad" class="form-control" placeholder="Ad" aria-label="Ad" required>
            </div>
            <div class="col">
                <input type="text" name="soyad" class="form-control" placeholder="Soy Ad" aria-label="Soy Ad" required>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="department" class="form-label">Department</label>
                <select id="department" name="department" class="form-select" required>
                    <option>dep1</option>
                    <option>dep2</option>
                    <option>dep3</option>
                </select>
            </div>
            <div class="col">
                <label for="unvan" class="form-label">Unvan</label>
                <select id="unvan" name="unvan" class="form-select" required>
                    <option>unvan1</option>
                    <option>unvan2</option>
                    <option>unvan3</option>
                </select>
            </div>
            <div class="col">
                <label for="cinsiyet" class="form-label">Cinsiyet</label>
                <select id="cinsiyet" name="cinsiyet" class="form-select" required>
                    <option>Erkek</option>
                    <option>Kadın</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input type="text" name="proje" class="form-control" placeholder="Proje" aria-label="Proje" required>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="ise_giris_tarihi">Ise giris tarihi</label>
                <input type="date" id="ise_giris_tarihi" name="ise_giris_tarihi" class="form-control" required>
            </div>
            <div class="col">
                <label for="dogum_tarihi">Dogum tarihi</label>
                <input type="date" id="dogum_tarihi" name="dogum_tarihi" class="form-control" required>
            </div>
        </div>
        <input type="submit" value="Kaydet">
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ptds_sunucu = "localhost";
    $ptds_kullanici = "root";
    $ptds_sifre = ""; 
    $ptds_adi = "ptds";

    
    $baglan = mysqli_connect($ptds_sunucu, $ptds_kullanici, $ptds_sifre, $ptds_adi);
    if (!$baglan) {
        die("Veri Tabanı Bağlantısı Başarısız: " . mysqli_connect_error());
    }

    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];
    $dogum_tarihi = $_POST['dogum_tarihi'];
    $cinsiyet = $_POST['cinsiyet'];
    $ise_giris_tarihi = $_POST['ise_giris_tarihi'];
    $proje = $_POST['proje'];

    
    $ekle = "INSERT INTO personeller (ad, soyad, dogum_tarihi, cinsiyet, ise_giris_tarihi, projeler) 
             VALUES ('$ad', '$soyad', '$dogum_tarihi', '$cinsiyet', '$ise_giris_tarihi', '$proje')";

    
    if ($baglan->query($ekle) === TRUE) {
        echo "Veritabanına veri eklendi";
    } else {
        echo "Hata: " . $ekle . "<br>" . $baglan->error;
    }

    
    mysqli_close($baglan);
}
?>

<?php include 'footer.php'?>