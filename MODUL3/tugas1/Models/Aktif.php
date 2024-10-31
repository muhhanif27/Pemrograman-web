<?php
namespace Models;

abstract class Aktif {
    protected $merk;
    protected $tahun;

    public function __construct($merk, $tahun) {
        $this->merk = $merk;
        $this->tahun = $tahun;
    }

    
    abstract public function nyalakanMesin();

    
    public function __toString() {
        return "Merk: $this->merk, Tahun: $this->tahun\n";
    }
}
?>
