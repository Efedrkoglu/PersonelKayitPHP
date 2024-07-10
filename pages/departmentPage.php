<?php $title = "Departman"?>
<?php include 'header.php'?>
<?php include '../code/DbQuerries.php'?>

<div class="container text-center mt-5">
    <div class="row">
        <div class="col">
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
                            echo "<td><a href='?edit=" . $department->getId() . "' class='btn btn-secondary btn-sm'>Düzenle</a><a href='?delete=" . $department->getId() . "' class='btn btn-danger btn-sm'>Sil</a></td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col">
            <?php
                $currentDepartment = null;
                if(isset($_GET['edit'])) {
                    $departmentId = $_GET['edit'];
                    $currentDepartment = selectDepartmentById($departmentId);
                }
            ?>
            <form action="" method="POST">
                <label for="name">Ad</label>
                <input type="hidden" name="id" value="<?php echo $currentDepartment ? $currentDepartment->getId() : ''; ?>">
                <input type="text" id="name" name="name" class="form-control" style="text-align: center;" value="<?php echo $currentDepartment ? $currentDepartment->getName() : ''; ?>"><br>
                <input type="submit" name="Kaydet" value="Kaydet" class="btn btn-secondary btn-sm text-center">
            </form>
        </div>
    </div>
    <hr>
</div>

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

    if(isset($_GET['delete'])) {
        $department = selectDepartmentById($_GET['delete']);
        deleteDepartment($department);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
?>

<?php include 'footer.php'?>