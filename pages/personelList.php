<?php $title = "Personel Listesi"; ?>
<?php include 'header.php'; ?>
<?php include('../code/DbQuerries.php')?>

<?php
    if(isset($_GET['delete'])) {
        $personel = selectPersonelById($_GET['delete']);
        deletePersonel($personel);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
?>

<div class="container mt-5">    
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Silme Onayı</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
                </div>
                <div class="modal-body">
                    Bu personeli silmek istediğinizden emin misiniz?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Vazgeç</button>
                    <a id="deleteConfirmButton" class="btn btn-danger" href="#">Sil</a>
                </div>
            </div>
        </div>
    </div>

    <input class="form-control mb-4" id="searchInput" type="text" placeholder="Arama...">

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
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody id="personelTable">
            <?php
                $personels = selectPersonel();

                foreach($personels as $personel) {
                    echo "<tr align='center'>";
                    echo "<td>" . $personel->getAd() . "</td>";
                    echo "<td>" . $personel->getSoyad() . "</td>";
                    echo "<td>" . $personel->getCinsiyet() . "</td>";
                    echo "<td>" . $personel->getDogumTarihi() . "</td>";
                    if($personel->getDepartment()->getId() != 0) {
                        echo "<td>" . $personel->getDepartment()->getName() . "</td>";
                    }
                    else {
                        echo "<td>-</td>";
                    }
                    if($personel->getUnvan()->getId() != 0) {
                        echo "<td>" . $personel->getUnvan()->getName() . "</td>";
                    }
                    else {
                        echo "<td>-</td>";
                    }
                    echo "<td>" . $personel->getIseBaslamaTarihi() . "</td>";
                    echo "<td>" . $personel->getProje() . "</td>";
                    if($personel->getIzinTarihi() == "0000-00-00") {
                        echo "<td>-</td>";
                    } else {
                        echo "<td>" . $personel->getIzinTarihi() . "</td>";
                    }
                    echo "<td><a class='btn btn-sm btn-secondary' href='editPersonel.php?edit=" . $personel->getId() . "'>Düzenle</a><button class='btn btn-sm btn-danger' onclick='confirmDelete(" . $personel->getId() . ")'>Sil</button></td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<script>
    function confirmDelete(id) {
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
            keyboard: false
        });
        document.getElementById('deleteConfirmButton').setAttribute('href', '?delete=' + id);
        deleteModal.show();
    }
</script>

<?php include 'footer.php'; ?>
