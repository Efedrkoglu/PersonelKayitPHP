<?php
    include("DbConnection.php");
    include("Personel.php");
    include("User.php");
    include("Gelir.php");
    include("Gider.php");

    function insertPersonel(Personel $personel) {
        try {
            $connection = connect();
            $sql = "INSERT INTO personelTable VALUES(DEFAULT, '{$personel->getAd()}', '{$personel->getSoyad()}',
                    '{$personel->getCinsiyet()}', '{$personel->getDogumTarihi()}', {$personel->getDepartment()->getId()},
                    '{$personel->getUnvan()->getId()}', '{$personel->getIseBaslamaTarihi()}', '{$personel->getIzinBaslangic()}', '{$personel->getIzinBitis()}', '{$personel->getProje()}')";
            
            $result = $connection->exec($sql);
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function updatePersonel(Personel $personel) {
        try {
            $connection = connect();
            $sql = "UPDATE personelTable SET ad='{$personel->getAd()}', soyad='{$personel->getSoyad()}', 
                    cinsiyet='{$personel->getCinsiyet()}', dogum_tarihi='{$personel->getDogumTarihi()}', 
                    department_id={$personel->getDepartment()->getId()}, unvan_id='{$personel->getUnvan()->getId()}', 
                    ise_baslama_tarihi='{$personel->getIseBaslamaTarihi()}', izin_baslangic='{$personel->getIzinBaslangic()}', 
                    izin_bitis='{$personel->getIzinBitis()}', proje='{$personel->getProje()}' WHERE id={$personel->getId()}";
            
            $result = $connection->exec($sql);
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function deletePersonel(Personel $personel) {
        try {
            $connection = connect();
            $sql = "DELETE FROM personelTable WHERE id={$personel->getId()}";
            
            $result = $connection->exec($sql);
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function selectPersonel() {
        try {
            $connection = connect();
            $sql = "SELECT * FROM personelTable";
            
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
                        $row['izin_baslangic'],
                        $row['izin_bitis'],
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
                        $row['izin_baslangic'],
                        $row['izin_bitis'],
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
                        $row['izin_baslangic'],
                        $row['izin_bitis'],
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
                        $row['izin_baslangic'],
                        $row['izin_bitis'],
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
            $sql = "SELECT * FROM personelTable WHERE id={$id}";

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
                    $row['izin_baslangic'],
                    $row['izin_bitis'],
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
                    $row['izin_baslangic'],
                    $row['izin_bitis'],
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
                    $row['izin_baslangic'],
                    $row['izin_bitis'],
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
                    $row['izin_baslangic'],
                    $row['izin_bitis'],
                    $row['proje']
                );
            }
            return $personel;
        }
        catch(PDOException $e) {
            die($e->getMessage());
        } 
    }

    function selectLeavePersonel() {
        try {
            $connection = connect();
            $sql = "SELECT * FROM personelTable WHERE NOT izin_bitis = '0000-00-00'";

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
                        $row['izin_baslangic'],
                        $row['izin_bitis'],
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
                        $row['izin_baslangic'],
                        $row['izin_bitis'],
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
                        $row['izin_baslangic'],
                        $row['izin_bitis'],
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
                        $row['izin_baslangic'],
                        $row['izin_bitis'],
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

    function insertGelir(Gelir $gelir) {
        try {
            $connection = connect();
            $sql = "INSERT INTO gelir VALUES(DEFAULT, '{$gelir->ad}', {$gelir->miktar}, '{$gelir->aciklama}'
                    , '{$gelir->tarih}')";
            
            $result = $connection->exec($sql);
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function updateGelir(Gelir $gelir) {
        try {
            $connection = connect();
            $sql = "UPDATE gelir SET ad='{$gelir->ad}', miktar={$gelir->miktar}, aciklama='{$gelir->aciklama}'
                    , tarih='{$gelir->tarih}' WHERE id={$gelir->id}";
            
            $result = $connection->exec($sql);
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function deleteGelir(Gelir $gelir) {
        try {
            $connection = connect();
            $sql = "DELETE FROM gelir WHERE id={$gelir->id}";
            
            $result = $connection->exec($sql);
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function selectGelir() {
        try {
            $connection = connect();
            $sql = "SELECT * FROM gelir ORDER BY YEAR(tarih) DESC";

            $result = $connection->query($sql);
            $gelirler = array();
            while($row = $result->fetch()) {
                $gelir = new Gelir(
                    $row['id'],
                    $row['ad'],
                    $row['miktar'],
                    $row['aciklama'],
                    $row['tarih']
                );
                array_push($gelirler, $gelir);
            }
            return $gelirler;
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function selectGelirById($id) {
        try {
            $connection = connect();
            $sql = "SELECT * FROM gelir WHERE id={$id}";

            $result = $connection->query($sql);
            $row = $result->fetch();
            
            $gelir = new Gelir($row['id'], $row['ad'], $row['miktar'], $row['aciklama'], $row['tarih']);
            return $gelir;
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function selectTotalGelirByYear() {
        try {
            $connection = connect();
            $sql = "SELECT YEAR(tarih) AS year, sum(miktar) AS total FROM gelir GROUP BY YEAR(tarih)";

            $result = $connection->query($sql);
            $yearAndTotal = array();
            while($row = $result->fetch()) {
                $yearAndTotal[$row['year']] = $row['total'];
            }
            return $yearAndTotal;
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function selectTotalGelirByMonth($year) {
        try {
            $connection = connect();
            $sql = "SELECT month(tarih) AS month, sum(miktar) AS total FROM (SELECT * FROM gelir WHERE year(tarih) = '{$year}') AS x GROUP BY month(tarih)";

            $result = $connection->query($sql);
            $monthTotal = array();
            while($row = $result->fetch()) {
                $monthTotal[$row['month']] = $row['total'];
            }
            return $monthTotal;
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function selectTotalGelirByName() {
        try {
            $connection = connect();
            $sql = "SELECT ad AS name, sum(miktar) AS total FROM gelir GROUP BY ad";

            $result = $connection->query($sql);
            $nameAndTotal = array();
            while($row = $result->fetch()) {
                $nameAndTotal[$row['name']] = $row['total'];
            }
            return $nameAndTotal;
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function insertGider(Gider $gider) {
        try {
            $connection = connect();
            $sql = "INSERT INTO gider VALUES(DEFAULT, '{$gider->ad}', {$gider->miktar}, '{$gider->aciklama}'
                    , '{$gider->tarih}')";
            
            $result = $connection->exec($sql);
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function updateGider(Gider $gider) {
        try {
            $connection = connect();
            $sql = "UPDATE gider SET ad='{$gider->ad}', miktar={$gider->miktar}, aciklama='{$gider->aciklama}'
                    , tarih='{$gider->tarih}' WHERE id={$gider->id}";
            
            $result = $connection->exec($sql);
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function deleteGider(Gider $gider) {
        try {
            $connection = connect();
            $sql = "DELETE FROM gider WHERE id={$gider->id}";
            
            $result = $connection->exec($sql);
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function selectGider() {
        try {
            $connection = connect();
            $sql = "SELECT * FROM gider ORDER BY YEAR(tarih) DESC";

            $result = $connection->query($sql);
            $giderler = array();
            while($row = $result->fetch()) {
                $gider = new Gider(
                    $row['id'],
                    $row['ad'],
                    $row['miktar'],
                    $row['aciklama'],
                    $row['tarih']
                );
                array_push($giderler, $gider);
            }
            return $giderler;
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function selectGiderById($id) {
        try {
            $connection = connect();
            $sql = "SELECT * FROM gider WHERE id={$id}";

            $result = $connection->query($sql);
            $row = $result->fetch();
            
            $gider = new Gider($row['id'], $row['ad'], $row['miktar'], $row['aciklama'], $row['tarih']);
            return $gider;
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function selectTotalGiderByYear() {
        try {
            $connection = connect();
            $sql = "SELECT YEAR(tarih) AS year, sum(miktar) AS total FROM gider GROUP BY YEAR(tarih)";

            $result = $connection->query($sql);
            $yearAndTotal = array();
            while($row = $result->fetch()) {
                $yearAndTotal[$row['year']] = $row['total'];
            }
            return $yearAndTotal;
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function selectTotalGiderByMonth() {
        try {
            $connection = connect();
            $sql = "SELECT month(tarih) AS month, sum(miktar) AS total FROM (SELECT * FROM gider WHERE year(tarih) = '2023') AS x GROUP BY month(tarih)";

            $result = $connection->query($sql);
            $monthTotal = array();
            while($row = $result->fetch()) {
                $monthTotal[$row['month']] = $row['total'];
            }
            return $monthTotal;
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function selectTotalGiderByName() {
        try {
            $connection = connect();
            $sql = "SELECT ad as name, sum(miktar) AS total FROM gider GROUP BY ad";

            $result = $connection->query($sql);
            $nameAndTotal = array();
            while($row = $result->fetch()) {
                $nameAndTotal[$row['name']] = $row['total'];
            }
            return $nameAndTotal;
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function selectYears($table) {
        try {
            $connection = connect();
            $sql = "SELECT YEAR(tarih) AS years FROM {$table} GROUP BY YEAR(tarih)";

            $result = $connection->query($sql);
            $years = array();
            while($row = $result->fetch()) {
                array_push($years, $row['years']);
            }

            return $years;
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function authorizeUser(User $user) {
        try {
            $connection = connect();
            $sql = "SELECT * FROM users WHERE username='{$user->getUsername()}' AND password='{$user->getPassword()}'";

            $result = $connection->query($sql);
            $row = $result->fetchAll();
            $rowCount = count($row);

            if($rowCount == 1) {
                return true;
            }
            else {
                return false;
            } 
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
    }
?>