<?php

class Tiket {
    // atribut privat
    private $id_tiket;
    private $nama_tiket;
    private $jumlah_tiket;
    private $harga_tiket;
    private $gambar_tiket;

    // konstruktor
    public function __construct($id_tiket = "", $nama_tiket = "", $jumlah_tiket = 0, $harga_tiket = 0, $gambar_tiket = "") {
        $this->id_tiket = $id_tiket;
        $this->nama_tiket = $nama_tiket;
        $this->jumlah_tiket = $jumlah_tiket;
        $this->harga_tiket = $harga_tiket;
        $this->gambar_tiket = $gambar_tiket;
    }

    // getter
    public function getId() {
        return $this->id_tiket;
    }

    public function getNama() {
        return $this->nama_tiket;
    }

    public function getJumlah() {
        return $this->jumlah_tiket;
    }

    public function getHarga() {
        return $this->harga_tiket;
    }

    public function getGambar() {
        return $this->gambar_tiket;
    }

    // setter
    public function setId($id_tiket) {
        $this->id_tiket = $id_tiket;
    }

    public function setNama($nama_tiket) {
        $this->nama_tiket = $nama_tiket;
    }

    public function setJumlah($jumlah_tiket) {
        $this->jumlah_tiket = $jumlah_tiket;
    }

    public function setHarga($harga_tiket) {
        $this->harga_tiket = $harga_tiket;
    }

    public function setGambar($gambar_tiket) {
        $this->gambar_tiket = $gambar_tiket;
    }

    // buat nampilin data
    public function ShowData() {
        echo "------------------------<br>";
        echo "ID Tiket   : " . $this->getId() . "<br>";
        echo "Nama Tiket : " . $this->getNama() . "<br>";
        echo "Jumlah     : " . $this->getJumlah() . "<br>";
        echo "Harga      : Rp " . number_format($this->getHarga(), 0, ',', '.') . "<br>";
    }
}
