<?php
    include("Department.php");
    include("Unvan.php");
    class Personel {
        private $id;
        private $ad;
        private $soyad;
        private $cinsiyet;
        private $dogum_tarihi;
        private $department;
        private $unvan;
        private $ise_baslama_tarihi;
        private $izin_tarihi;
        private $proje;

        public function __construct($id, $ad, $soyad, $cinsiyet, $dogum_tarihi, Department $department, 
                                    Unvan $unvan, $ise_baslama_tarihi, $izin_tarihi, $proje)
        {
            $this->id = $id;
            $this->ad = $ad;
            $this->soyad = $soyad;
            $this->cinsiyet = $cinsiyet;
            $this->dogum_tarihi = $dogum_tarihi;
            $this->department = $department;
            $this->unvan = $unvan;
            $this->ise_baslama_tarihi = $ise_baslama_tarihi;
            $this->izin_tarihi = $izin_tarihi;
            $this->proje = $proje;    
        }

        public function getId() {
            return $this->id;
        }

        public function getAd() {
            return $this->ad;
        }

        public function setAd($ad) {
            $this->ad = $ad;
        }

        public function getSoyad() {
            return $this->soyad;
        }

        public function setSoyadd($soyad) {
            $this->soyad = $soyad;
        }

        public function getCinsiyet() {
            return $this->cinsiyet;
        }

        public function setCinsiyet($cinsiyet) {
            $this->cinsiyet = $cinsiyet;
        }

        public function getDogumTarihi() {
            return $this->dogum_tarihi;
        }

        public function setDogumTarihi($dogum_tarihi) {
            $this->dogum_tarihi = $dogum_tarihi;
        }

        public function getDepartment() {
            return $this->department;
        }

        public function setDepartment(Department $department) {
            $this->department = $department;
        }

        public function getUnvan() {
            return $this->unvan;
        }

        public function setUnvan(Unvan $unvan) {
            $this->unvan = $unvan;
        }

        public function getIseBaslamaTarihi() {
            return $this->ise_baslama_tarihi;
        }

        public function setIseBaslamaTarihi($ise_baslama_tarihi) {
            $this->ise_baslama_tarihi = $ise_baslama_tarihi;
        }

        public function getIzinTarihi() {
            return $this->izin_tarihi;
        }

        public function setIzinTarihi($izin_tarihi) {
            $this->izin_tarihi = $izin_tarihi;
        }

        public function getProje() {
            return $this->proje;
        }

        public function setProje($proje) {
            $this->proje = $proje;
        }
    }
?>