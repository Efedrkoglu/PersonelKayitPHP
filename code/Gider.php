<?php
    class Gider {
        public $id;
        public $ad;
        public $miktar;
        public $aciklama;
        public $tarih;

        public function __construct($id, $ad, $miktar, $aciklama, $tarih) {
            $this->id = $id;
            $this->ad = $ad;
            $this->miktar = $miktar;
            $this->aciklama = $aciklama;
            $this->tarih = $tarih;
        }

        public function setAd($ad) {
            $this->ad = $ad;
        }

        public function setMiktar($miktar) {
            $this->miktar = $miktar;
        }

        public function setAciklama($aciklama) {
            $this->aciklama = $aciklama;
        }

        public function setTarih($tarih) {
            $this->tarih = $tarih;
        }
    }
?>