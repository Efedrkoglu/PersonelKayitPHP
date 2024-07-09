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
                    department_id={$personel->getDepartment()->getId()}, unvan='{$personel->getUnvan()->getId()}', 
                    ise_baslama_tarihi='{$personel->getIseBaslamaTarihi()}', izin_tarihi='{$personel->getIzinTarihi()}' 
                    WHERE id={$personel->getId()}";
            
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
                $personel = new Personel(
                    $row['id'],
                    $row['ad'],
                    $row['soyad'],
                    $row['cinsiyet'],
                    $row['dogum_tarihi'],
                    selectDepartmentById($row['departmen_id']),
                    selectUnvanById($row['unvan_id']),
                    $row['ise_baslama_tarihi'],
                    $row['izin_tarihi'],
                    $row['proje']
                );
                array_push($personels, $personel);
            }
            return $personels;
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
        
        try {
            $connection = connect();
            $sql = "SELECT * FROM department WHERE id={$id}";
            
            $result = $connection->query($sql);
            $row = $result->fetch();
            $department = new Department($row['id'], $row['name']);
            return $department;
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }

       
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