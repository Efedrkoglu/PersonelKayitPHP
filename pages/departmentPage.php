<?php $title = "Departman";?>
<?php include 'navbar.php'?>
<?php include '../code/DbQuerries.php'?>
<?php include('../code/CheckAuthorized.php')?>
<?php
    if(isset($_POST['Kaydet'])) {
        $departmentID = $_POST['id'];
        $departmentName = $_POST['name'];

        if (!empty($departmentID)) {
            updateDepartment(new Department($departmentID, $departmentName));
        }
        else {
            insertDepartment(new Department(1, $departmentName));
        }

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    if(isset($_POST['Vazgec'])) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    if(isset($_GET['delete'])) {
        $department = selectDepartmentById($_GET['delete']);
        deleteDepartment($department);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
?>

<div class="container text-center mt-5">
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Silme Onayı</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
                </div>
                <div class="modal-body">
                    Bu departmanı silmek istediğinizden emin misiniz?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Vazgeç</button>
                    <a id="deleteConfirmButton" class="btn btn-danger" href="#">Sil</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?php
                $currentDepartment = null;
                if(isset($_GET['edit'])) {
                    $departmentId = $_GET['edit'];
                    $currentDepartment = selectDepartmentById($departmentId);
                }
            ?>
            <h5><?php echo isset($_GET['edit']) ? 'Departman Düzenle' : 'Departman Ekle' ;?></h5>
            <form action="" method="POST">
                <label for="name">Ad</label>
                <input type="hidden" name="id" value="<?php echo $currentDepartment ? $currentDepartment->getId() : ''; ?>">
                <input type="text" id="name" name="name" class="form-control" style="text-align: center;" value="<?php echo $currentDepartment ? $currentDepartment->getName() : ''; ?>"><br>
                <input type="submit" name="Kaydet" value="<?php echo isset($_GET['edit']) ? 'Güncelle' : 'Kaydet';?>" class="btn btn-success btn-sm text-center">
                <input type="<?php echo isset($_GET['edit']) ? 'submit' : 'hidden';?>" name="Vazgec" value="Vazgeç" class="btn btn-secondary btn-sm text-center">
            </form>
        </div>
        <div class="col">
            <h5>Departmanlar</h5>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr align="center">
                        <th>İsim</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $departments = selectDepartment();
                        
                        foreach($departments as $department) {
                            echo "<tr align='center'>";
                            echo "<td>" . $department->getName() . "</td>";
                            echo "<td><a class='btn btn-sm btn-secondary' data-toggle='tooltip' data-placement='bottom' title='Düzenle' href='?edit=" . $department->getId() . "'><i class='fa-regular fa-pen-to-square'></i></a><button class='btn btn-sm btn-danger' data-toggle='tooltip' data-placement='bottom' title='Sil' onclick='confirmDelete(" . $department->getId() . ")'><i class='fa-regular fa-trash-can'></button></td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
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

<?php include 'footer.php'?>