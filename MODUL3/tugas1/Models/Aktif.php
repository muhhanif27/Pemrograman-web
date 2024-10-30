<?php
namespace Models;

abstract class Aktif {
    protected $merk;
    protected $tahun;

    public function __construct($merk, $tahun) {
        $this->merk = $merk;
        $this->tahun = $tahun;
    }

    // Method abstract, harus diimplementasikan di kelas turunannya
    abstract public function nyalakanMesin();

    // Magic method untuk menampilkan info robot
    public function __toString() {
        return "Merk: $this->merk, Tahun: $this->tahun\n";
    }
}
?>
