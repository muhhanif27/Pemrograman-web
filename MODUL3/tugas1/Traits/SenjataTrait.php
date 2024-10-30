<?php
namespace Traits;

trait SenjataTrait {
    protected $senjataAktif = false;

    public function aktifkanSenjata() {
        if (!$this->senjataAktif) {
            $this->senjataAktif = true;
            echo "Senjata telah diaktifkan!\n";
        } else {
            echo "Senjata sudah aktif.\n";
        }
    }

    public function tembak() {
        if ($this->senjataAktif) {
            echo "Robot menembakkan senjata!\n";
        } else {
            echo "Senjata belum diaktifkan!\n";
        }
    }
}
?>
