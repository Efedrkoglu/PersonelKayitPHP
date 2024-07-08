<?php $title = "Personel Listesi"; ?>
<?php include 'header.php'; ?>

<div class="container mt-5">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr align="center">
                <th>Ad</th>
                <th>Soyad</th>
                <th>Departman</th>
                <th>Unvan</th>
                <th>Cinsiyet</th>
                <th>Proje</th>
                <th>Dogum Tarihi</th>
                <th>Ise Giris Tarihi</th>
                <th>Izin Tarihi</th>
            </tr>
        </thead>
        <tbody>
            <?php
           
            $ptds_sunucu = "localhost";
            $ptds_kullanici = "root";
            $ptds_sifre = ""; 
            $ptds_adi = "personelKayit";

            
            $baglan = mysqli_connect($ptds_sunucu, $ptds_kullanici, $ptds_sifre, $ptds_adi);
            if (!$baglan) {
                die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
            }

            
            $sql = "SELECT ad, soyad, department, unvan, cinsiyet, proje, dogum_tarihi, ise_giris, izin_tarihi FROM personel";
            $result = $baglan->query($sql);

            if ($result->num_rows > 0) {
                
                while ($row = $result->fetch_assoc()) {
                    echo "<tr align='center'>";
                    echo "<td>" . $row["ad"] . "</td>";
                    echo "<td>" . $row["soyad"] . "</td>";
                    echo "<td>" . $row["department"] . "</td>";
                    echo "<td>" . $row["unvan"] . "</td>";
                    echo "<td>" . $row["cinsiyet"] . "</td>";
                    echo "<td>" . $row["proje"] . "</td>";
                    echo "<td>" . $row["dogum_tarihi"] . "</td>";
                    echo "<td>" . $row["ise_giris"] . "</td>";
                    if($row["izin_tarihi"] == NULL) {
                        echo "<td>-</td>";
                    }
                    else {
                        echo "<td>" . $row["izin_tarihi"] . "</td>";
                    }
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
