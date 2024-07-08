<?php $title = "Personel Listesi"; ?>
<?php include 'header.php'; ?>

<div class="container mt-5">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr align="center">
                <th>Ad</th>
                <th>Soyad</th>
                <th>Doğum Tarihi</th>
                <th>Cinsiyet</th>
                <th>İşe Giriş Tarihi</th>
                <th>Projeler</th>
            </tr>
        </thead>
        <tbody>
            <?php
           
            $ptds_sunucu = "localhost";
            $ptds_kullanici = "root";
            $ptds_sifre = ""; 
            $ptds_adi = "ptds";

            
            $baglan = mysqli_connect($ptds_sunucu, $ptds_kullanici, $ptds_sifre, $ptds_adi);
            if (!$baglan) {
                die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
            }

            
            $sql = "SELECT ad, soyad, dogum_tarihi, cinsiyet, ise_giris_tarihi, projeler FROM personeller";
            $result = $baglan->query($sql);

            if ($result->num_rows > 0) {
                
                while ($row = $result->fetch_assoc()) {
                    echo "<tr align='center'>";
                    echo "<td>" . $row["ad"] . "</td>";
                    echo "<td>" . $row["soyad"] . "</td>";
                    echo "<td>" . $row["dogum_tarihi"] . "</td>";
                    echo "<td>" . $row["cinsiyet"] . "</td>";
                    echo "<td>" . $row["ise_giris_tarihi"] . "</td>";
                    echo "<td>" . $row["projeler"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr align='center'><td colspan='6'>Kayıt bulunamadı</td></tr>";
            }

            mysqli_close($baglan);
            ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
