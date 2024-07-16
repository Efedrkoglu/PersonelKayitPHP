<?php $title = "Gelirler";?>
<?php include('header.php')?>
<?php include('../code/CheckAuthorized.php')?>
<?php include('../code/DbQuerries.php')?>

<?php
    $maxPage = getMaxPage("gelir");
    $page;
    if(isset($_GET['page'])) {
        $page = $_GET['page'];
    }
    else {
        $page = 1;
    }

    if(isset($_GET['delete'])) {
        $gelir = selectGelirById($_GET['delete']);
        deleteGelir($gelir);
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
                    Bu geliri silmek istediğinizden emin misiniz?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Vazgeç</button>
                    <a id="deleteConfirmButton" class="btn btn-danger" href="#">Sil</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped table-bordered table-hover">
            <h4>Gelirler</h4>
            <thead>
                <tr align="center">
                    <th>Ad</th>
                    <th>Miktar</th>
                    <th>Açıklama</th>
                    <th>Tarih</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $gelirler = selectGelir($page);

                    foreach($gelirler as $gelir) {
                        echo "<tr align='center'>";
                        echo "<td>" . $gelir->ad . "</td>";
                        echo "<td>" . $gelir->miktar . "₺" . "</td>";
                        echo "<td>" . $gelir->aciklama . "</td>";
                        echo "<td>" . $gelir->tarih . "</td>";
                        echo "<td><a class='btn btn-sm btn-secondary' href='editGelir.php?edit=" . $gelir->id . "'><i class='fa-regular fa-pen-to-square'></i></a><button class='btn btn-sm btn-danger' onclick='confirmDelete(" . $gelir->id . ")'><i class='fa-regular fa-trash-can'></button></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <a href="?page=<?php echo max(1, $page - 1); ?>" class="btn btn-secondary btn-sm <?php if($page == 1) echo 'disabled';?>"><i class="fa-solid fa-arrow-left"></i></a>
    <?php echo $page . "/" . $maxPage; ?>
    <a href="?page=<?php echo min($maxPage, $page + 1); ?>" class="btn btn-secondary btn-sm <?php if($page == $maxPage) echo 'disabled';?>"><i class="fa-solid fa-arrow-right"></i></a>
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

<?php include('footer.php')?>