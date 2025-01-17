<?php $title = "Giderler";?>
<?php include('navbar.php')?>
<?php include('../code/CheckAuthorized.php')?>
<?php include('../code/DbQuerries.php')?>

<?php
    $maxPage = getMaxPage("gider");
    $page;
    if(isset($_GET['page'])) {
        $page = $_GET['page'];
    }
    else {
        $page = 1;
    }

    if(isset($_GET['delete'])) {
        $gider = selectGiderById($_GET['delete']);
        deleteGider($gider);
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
                    Bu gideri silmek istediğinizden emin misiniz?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Vazgeç</button>
                    <a id="deleteConfirmButton" class="btn btn-danger" href="#">Sil</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <h4>Giderler</h4>
        <input class="form-control mb-4" id="searchInput" type="text" placeholder="Arama...">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr align="center">
                    <th>Ad</th>
                    <th>Miktar</th>
                    <th>Açıklama</th>
                    <th>Tarih</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody id="giderTable">
                <?php
                    $giderler = selectGider($page);

                    foreach($giderler as $gider) {
                        echo "<tr align='center'>";
                        echo "<td>" . $gider->ad . "</td>";
                        echo "<td>" . $gider->miktar . "₺" . "</td>";
                        echo "<td>" . $gider->aciklama . "</td>";
                        echo "<td>" . $gider->tarih . "</td>";
                        echo "<td><a class='btn btn-sm btn-secondary' data-toggle='tooltip' data-placement='bottom' title='Düzenle' href='editGider.php?edit=" . $gider->id . "'><i class='fa-regular fa-pen-to-square'></i></a><button class='btn btn-sm btn-danger' data-toggle='tooltip' data-placement='bottom' title='Sil' onclick='confirmDelete(" . $gider->id . ")'><i class='fa-regular fa-trash-can'></button></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <a href="?page=<?php echo max(1, $page - 1); ?>" class="btn btn-secondary btn-sm <?php if($page == 1) echo 'disabled';?>"><i class="fa-solid fa-arrow-left"></i></a>
    <?php
        if($maxPage == 0) {
            echo "0/0";
        }
        else {
            echo $page . "/" . $maxPage; 
        }
    ?>
    <a href="?page=<?php echo min($maxPage, $page + 1); ?>" class="btn btn-secondary btn-sm <?php if($page == $maxPage || $maxPage == 0) echo 'disabled';?>"><i class="fa-solid fa-arrow-right"></i></a>
</div>

<script>
    function confirmDelete(id) {
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
            keyboard: false
        });
        document.getElementById('deleteConfirmButton').setAttribute('href', '?delete=' + id);
        deleteModal.show();
    }

    document.getElementById('searchInput').addEventListener('keyup', function() {
        var input = document.getElementById('searchInput');
        var filter = input.value.toLowerCase();
        var rows = document.getElementById('giderTable').getElementsByTagName('tr');
        
        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName('td');
            var match = false;
            
            for (var j = 0; j < cells.length; j++) {
                if (cells[j].innerText.toLowerCase().indexOf(filter) > -1) {
                    match = true;
                    break;
                }
            }
            
            if (match) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    });
</script>

<?php include('footer.php')?>