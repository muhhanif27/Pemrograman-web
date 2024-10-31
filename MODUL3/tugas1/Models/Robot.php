<?php
namespace Models;

use Traits\EnergiTrait;

class Robot extends Aktif {
    use EnergiTrait;

    protected $warna;
    protected $kecepatan;
    protected $isActive = false; // Robot dimulai dalam keadaan non-aktif

    public function __construct($merk, $tahun, $warna, $kecepatan) {
        parent::__construct($merk, $tahun);
        $this->warna = $warna;
        $this->kecepatan = $kecepatan;
    }

    public function nyalakanMesin() {
        $this->isActive = true; // Robot diaktifkan
        echo "Robot $this->merk siap untuk beroperasi.\n";
    }

    public function jalan() {
        if (!$this->isActive) {
            echo "Robot belum diaktifkan, tidak bisa bergerak.\n";
            return;
        }

        $this->gunakanEnergi(10);
        if ($this->energi > 0) {
            echo "Robot $this->merk berwarna $this->warna bergerak dengan kecepatan $this->kecepatan km/jam.\n";
        }
    }

    public function isiUlangEnergi() {
        if (!$this->isActive) {
            echo "Robot belum diaktifkan, tidak bisa isi ulang energi.\n";
            return;
        }

        $this->energi = 100;
        echo "Energi berhasil diisi ulang menjadi $this->energi%\n";
    }

    public function __toString() {
        return parent::__toString() . "Warna: $this->warna, Kecepatan: $this->kecepatan km/jam\n";
    }
}
?>
