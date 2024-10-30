<?php
namespace Models;

use Traits\EnergiTrait;

class Robot extends Aktif {
    use EnergiTrait;

    protected $warna;
    protected $kecepatan;

    public function __construct($merk, $tahun, $warna, $kecepatan) {
        parent::__construct($merk, $tahun);
        $this->warna = $warna;
        $this->kecepatan = $kecepatan;
    }

    public function nyalakanMesin() {
        echo "Robot $this->merk siap untuk beroperasi.\n";
    }

    public function jalan() {
        // Menggunakan 10% energi untuk aksi jalan
        $this->gunakanEnergi(10);
        if ($this->energi > 0) {
            echo "Robot $this->merk berwarna $this->warna bergerak dengan kecepatan $this->kecepatan km/jam.\n";
        }
    }

    public function __toString() {
        return parent::__toString() . "Warna: $this->warna, Kecepatan: $this->kecepatan km/jam\n";
    }
}
?>
