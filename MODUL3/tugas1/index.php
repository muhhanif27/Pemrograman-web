<?php
// Menggunakan autoload untuk memuat semua file
spl_autoload_register(function ($class_name) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class_name) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

use Controllers\MobilController;

$mobilController = new MobilController();

while (true) {
    // Menampilkan menu pilihan jenis mobil
    echo "Pilih jenis mobil:\n";
    echo "1. Mobil Biasa\n";
    echo "2. Mobil Sport\n";
    echo "3. Keluar\n";
    echo "Masukkan pilihan jenis mobil (1, 2, atau 3): ";
    $pilihanMobil = (int)readline();

    if ($pilihanMobil === 3) {
        echo "Terima kasih telah menggunakan program ini.\n";
        break;
    } elseif ($pilihanMobil !== 1 && $pilihanMobil !== 2) {
        echo "Pilihan tidak valid. Silakan masukkan 1, 2, atau 3.\n";
        continue;
    }

    // Loop untuk memilih aksi pada mobil yang dipilih
    while (true) {
        echo "\nPilih aksi yang ingin dilakukan:\n";
        echo "1. Nyalakan Mesin\n";
        echo "2. Jalankan Mobil\n";
        echo "3. Cek Oli\n";
        echo "4. Servis Berkala\n";
        if ($pilihanMobil === 2) {
            echo "5. Aktifkan Mode Sport (Hanya untuk Mobil Sport)\n";
        }
        echo "6. Kembali ke Pilihan Mobil\n";
        echo "Masukkan pilihan aksi (1-6): ";
        $pilihanAksi = (int)readline();

        // Memeriksa pilihan aksi dan memanggil metode yang sesuai
        if ($pilihanAksi === 1) {
            if ($pilihanMobil === 1) {
                $mobilController->tampilkanMobilBiasa()->nyalakanMesin();
            } else {
                $mobilController->tampilkanMobilSport()->nyalakanMesin();
            }
        } elseif ($pilihanAksi === 2) {
            if ($pilihanMobil === 1) {
                $mobilController->tampilkanMobilBiasa()->jalan();
            } else {
                $mobilController->tampilkanMobilSport()->jalan();
            }
        } elseif ($pilihanAksi === 3) {
            if ($pilihanMobil === 1) {
                $mobilController->tampilkanMobilBiasa()->cekOli();
            } else {
                $mobilController->tampilkanMobilSport()->cekOli();
            }
        } elseif ($pilihanAksi === 4) {
            if ($pilihanMobil === 1) {
                $mobilController->tampilkanMobilBiasa()->servisBerkala();
            } else {
                $mobilController->tampilkanMobilSport()->servisBerkala();
            }
        } elseif ($pilihanAksi === 5 && $pilihanMobil === 2) {
            // Aktifkan Mode Sport hanya untuk Mobil Sport
            $mobilController->tampilkanMobilSport()->aktifkanModeSport();
        } elseif ($pilihanAksi === 6) {
            // Kembali ke menu jenis mobil
            break;
        } else {
            echo "Pilihan tidak valid. Silakan masukkan angka sesuai menu.\n";
        }
    }
}
?>
