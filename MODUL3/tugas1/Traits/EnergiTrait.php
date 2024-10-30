<?php
namespace Traits;

trait EnergiTrait {
    protected $energi = 100; // Energi awal 100%

    // Method untuk mengecek status energi
    public function cekEnergi() {
        echo "Energi saat ini: $this->energi%\n";
    }

    // Method untuk mengisi ulang energi
    public function isiUlangEnergi() {
        $this->energi = 100;
        echo "Energi berhasil diisi ulang menjadi $this->energi%\n";
    }

    // Method untuk menggunakan energi
    public function gunakanEnergi($jumlah) {
        if ($this->energi > 0) {
            if ($this->energi >= $jumlah) {
                $this->energi -= $jumlah;
                echo "Menggunakan $jumlah% energi. Energi tersisa: $this->energi%\n";
            } else {
                $this->energi = 0;
                echo "Energi habis! Energi tersisa hanya $this->energi%\n";
            }
        } else {
            echo "Energi sudah habis! Isi ulang energi untuk melanjutkan.\n";
        }
    }
}
?>
