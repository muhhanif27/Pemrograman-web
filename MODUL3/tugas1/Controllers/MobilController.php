<?php
namespace Controllers;

use Models\Mobil;
use Models\MobilSport;

class MobilController {
    public function tampilkanMobilBiasa() {
        $mobil = new Mobil("Toyota", 2020, "Putih", 120);
        echo $mobil;
        return $mobil;
    }

    public function tampilkanMobilSport() {
        $mobilSport = new MobilSport("Ferrari", 2022, "Merah", 250, true);
        echo $mobilSport;
        return $mobilSport;
    }
}
?>
