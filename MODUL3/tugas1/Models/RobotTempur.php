<?php
namespace Models;

use Traits\SenjataTrait;

class RobotTempur extends Robot {
    use SenjataTrait;

    private $modeTempur;

    public function __construct($merk, $tahun, $warna, $kecepatan, $modeTempur) {
        parent::__construct($merk, $tahun, $warna, $kecepatan);
        $this->modeTempur = $modeTempur;
    }

    public function aktifkanModeTempur() {
        if ($this->modeTempur) {
            $this->aktifkanSenjata();
            echo "Mode tempur diaktifkan pada robot $this->merk!\n";
        } else {
            echo "Robot $this->merk tidak memiliki mode tempur.\n";
        }
    }

    public function __toString() {
        return parent::__toString() . "Mode Tempur: " . ($this->modeTempur ? "Aktif" : "Tidak Aktif") . "\n";
    }
}
?>
