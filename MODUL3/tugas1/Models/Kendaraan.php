<?php
namespace Models;

abstract class Kendaraan {
    protected $merk;
    protected $tahun;

    public function __construct($merk, $tahun) {
        $this->merk = $merk;
        $this->tahun = $tahun;
    }

    // Method abstrak
    abstract public function nyalakanMesin();

    // Magic method __toString
    public function __toString() {
        return "Merk: $this->merk, Tahun: $this->tahun\n";
    }
}
?>
