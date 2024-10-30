<?php
namespace Models;

class MobilSport extends Mobil {
    private $modeSport;

    public function __construct($merk, $tahun, $warna, $kecepatan, $modeSport) {
        parent::__construct($merk, $tahun, $warna, $kecepatan);
        $this->modeSport = $modeSport;
    }

    public function aktifkanModeSport() {
        if ($this->modeSport) {
            echo "Mode sport diaktifkan pada mobil $this->merk!\n";
        } else {
            echo "Mobil $this->merk tidak memiliki mode sport.\n";
        }
    }
}
?>
