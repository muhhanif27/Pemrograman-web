<?php
namespace Models;

use Traits\PerawatanTrait;

class Mobil extends Kendaraan {
    use PerawatanTrait;

    protected $warna;
    protected $kecepatan;

    public function __construct($merk, $tahun, $warna, $kecepatan) {
        parent::__construct($merk, $tahun);
        $this->warna = $warna;
        $this->kecepatan = $kecepatan;
    }

    public function nyalakanMesin() {
        echo "Mesin mobil $this->merk dinyalakan.\n";
    }

    public function jalan() {
        echo "Mobil $this->merk berwarna $this->warna berjalan dengan kecepatan $this->kecepatan km/jam.\n";
    }
}
?>
