<?php $title = "Personel Listesi"; ?>
<?php include 'header.php'; ?>
<?php include('DbQuerries.php')?>

<div class="container mt-5">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr align="center">
                <th>Ad</th>
                <th>Soyad</th>
                <th>Cinsiyet</th>
                <th>Doğum Tarihi</th>
                <th>Departman</th>
                <th>Unvan</th>
                <th>İşe Başlama Tarihi</th>
                <th>Proje</th>
                <th>İzin Tarihi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $personels = selectPersonel();

                foreach($personels as $personel) {
                    echo "<tr align='center'>";
                    echo "<td>" . $personel->getAd() . "</td>";
                    echo "<td>" . $personel->getSoyad() . "</td>";
                    echo "<td>" . $personel->getCinsiyet() . "</td>";
                    echo "<td>" . $personel->getDogumTarihi() . "</td>";
                    echo "<td>" . $personel->getDepartment()->getName() . "</td>";
                    echo "<td>" . $personel->getUnvan()->getName() . "</td>";
                    echo "<td>" . $personel->getIseBaslamaTarihi() . "</td>";
                    echo "<td>" . $personel->getProje() . "</td>";
                    if($personel->getIzinTarihi() == "0000-00-00") {
                        echo "<td>-</td>";
                    }
                    else {
                        echo "<td>" . $personel->getIzinTarihi() . "</td>";
                    }
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
