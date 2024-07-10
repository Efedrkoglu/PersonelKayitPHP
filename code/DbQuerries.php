<?php
    include("DbConnection.php");
    include("Personel.php");

    function insertPersonel(Personel $personel) {
        try {
            $connection = connect();
            $sql = "INSERT INTO personel VALUES(DEFAULT, '{$personel->getAd()}', '{$personel->getSoyad()}',
                    '{$personel->getCinsiyet()}', '{$personel->getDogumTarihi()}', {$personel->getDepartment()->getId()},
                    '{$personel->getUnvan()->getId()}', '{$personel->getIseBaslamaTarihi()}', '{$personel->getIzinTarihi()}', '{$personel->getProje()}')";
            
            $result = $connection->exec($sql);
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function updatePersonel(Personel $personel) {
        try {
            $connection = connect();
            $sql = "UPDATE personel SET ad='{$personel->getAd()}', soyad='{$personel->getSoyad()}', 
                    cinsiyet='{$personel->getCinsiyet()}', dogum_tarihi='{$personel->getDogumTarihi()}', 
                    department_id={$personel->getDepartment()->getId()}, unvan_id='{$personel->getUnvan()->getId()}', 
                    ise_baslama_tarihi='{$personel->getIseBaslamaTarihi()}', izin_tarihi='{$personel->getIzinTarihi()}', 
                    proje='{$personel->getProje()}' WHERE id={$personel->getId()}";
            
            $result = $connection->exec($sql);
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function deletePersonel(Personel $personel) {
        try {
            $connection = connect();
            $sql = "DELETE FROM personel WHERE id={$personel->getId()}";
            
            $result = $connection->exec($sql);
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function selectPersonel() {
        try {
            $connection = connect();
            $sql = "SELECT * FROM personel";
            
            $result = $connection->query($sql);
            $personels = array();
            while($row = $result->fetch()) {
                if($row['department_id'] != NULL && $row['unvan_id'] != NULL) {
                    $personel = new Personel(
                        $row['id'],
                        $row['ad'],
                        $row['soyad'],
                        $row['cinsiyet'],
                        $row['dogum_tarihi'],
                        selectDepartmentById($row['department_id']),
                        selectUnvanById($row['unvan_id']),
                        $row['ise_baslama_tarihi'],
                        $row['izin_tarihi'],
                        $row['proje']
                    );
                }
                else if($row['department_id'] == NULL){
                    $personel = new Personel(
                        $row['id'],
                        $row['ad'],
                        $row['soyad'],
                        $row['cinsiyet'],
                        $row['dogum_tarihi'],
                        new Department(0, "null"),
                        selectUnvanById($row['unvan_id']),
                        $row['ise_baslama_tarihi'],
                        $row['izin_tarihi'],
                        $row['proje']
                    );
                }
                else if($row['unvan_id'] != NULL) {
                    $personel = new Personel(
                        $row['id'],
                        $row['ad'],
                        $row['soyad'],
                        $row['cinsiyet'],
                        $row['dogum_tarihi'],
                        selectDepartmentById($row['department_id']),
                        new Unvan(0, "null"),
                        $row['ise_baslama_tarihi'],
                        $row['izin_tarihi'],
                        $row['proje']
                    );
                }
                else {
                    $personel = new Personel(
                        $row['id'],
                        $row['ad'],
                        $row['soyad'],
                        $row['cinsiyet'],
                        $row['dogum_tarihi'],
                        new Department(0, "null"),
                        new Unvan(0, "null"),
                        $row['ise_baslama_tarihi'],
                        $row['izin_tarihi'],
                        $row['proje']
                    );
                }
                array_push($personels, $personel);
            }
            return $personels;
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function selectPersonelById($id) {
        try {
            $connection = connect();
            $sql = "SELECT * FROM personel WHERE id={$id}";

            $result = $connection->query($sql);
            $row = $result->fetch();
            if($row['department_id'] != NULL && $row['unvan_id'] != NULL) {
                $personel = new Personel(
                    $row['id'],
                    $row['ad'],
                    $row['soyad'],
                    $row['cinsiyet'],
                    $row['dogum_tarihi'],
                    selectDepartmentById($row['department_id']),
                    selectUnvanById($row['unvan_id']),
                    $row['ise_baslama_tarihi'],
                    $row['izin_tarihi'],
                    $row['proje']
                );
            }
            else if($row['department_id'] == NULL){
                $personel = new Personel(
                    $row['id'],
                    $row['ad'],
                    $row['soyad'],
                    $row['cinsiyet'],
                    $row['dogum_tarihi'],
                    new Department(0, "null"),
                    selectUnvanById($row['unvan_id']),
                    $row['ise_baslama_tarihi'],
                    $row['izin_tarihi'],
                    $row['proje']
                );
            }
            else if($row['unvan_id'] == NULL) {
                $personel = new Personel(
                    $row['id'],
                    $row['ad'],
                    $row['soyad'],
                    $row['cinsiyet'],
                    $row['dogum_tarihi'],
                    selectDepartmentById($row['department_id']),
                    new Unvan(0, "null"),
                    $row['ise_baslama_tarihi'],
                    $row['izin_tarihi'],
                    $row['proje']
                );
            }
            else {
                $personel = new Personel(
                    $row['id'],
                    $row['ad'],
                    $row['soyad'],
                    $row['cinsiyet'],
                    $row['dogum_tarihi'],
                    new Department(0, "null"),
                    new Unvan(0, "null"),
                    $row['ise_baslama_tarihi'],
                    $row['izin_tarihi'],
                    $row['proje']
                );
            }
            return $personel;
        }
        catch(PDOException $e) {
            die($e->getMessage());
        } 
    }

    function insertDepartment(Department $department) {
        try {
            $connection = connect();
            $sql = "INSERT INTO department VALUES(DEFAULT, '{$department->getName()}')";
            
            $result = $connection->exec($sql);
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function updateDepartment(Department $department) {
        try {
            $connection = connect();
            $sql = "UPDATE department SET name='{$department->getName()}' WHERE id={$department->getId()}";
            
            $result = $connection->exec($sql);
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function deleteDepartment(Department $department) {
        try {
            $connection = connect();
            $sql = "DELETE FROM department WHERE id={$department->getId()}";
            
            $result = $connection->exec($sql);
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function selectDepartment() {
        try {
            $connection = connect();
            $sql = "SELECT * FROM department";
            
            $result = $connection->query($sql);
            $deparmentsArray = array();
            while($row = $result->fetch()) {
                array_push($deparmentsArray, new Department($row['id'], $row['name']));
            }
            return $deparmentsArray;
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function selectDepartmentById($id) {
        $department;
        try {
            $connection = connect();
            $sql = "SELECT * FROM department WHERE id={$id}";
            
            $result = $connection->query($sql);
            $row = $result->fetch();
            $department = new Department($row['id'], $row['name']);
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }

        return $department;
    }

    function selectUnvan() {
        try {
            $connection = connect();
            $sql = "SELECT * FROM unvan";
            
            $result = $connection->query($sql);
            $unvanArray = array();
            while($row = $result->fetch()) {
                array_push($unvanArray, new Unvan($row['id'], $row['name']));
            }
            return $unvanArray;
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function selectUnvanById($id) {
        try {
            $connection = connect();
            $sql = "SELECT * FROM unvan WHERE id={$id}";
            
            $result = $connection->query($sql);
            $row = $result->fetch();
            $unvan = new Unvan($row['id'], $row['name']);
            return $unvan;
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }
?>