<?php
// Menggunakan autoload untuk memuat semua file
spl_autoload_register(function ($class_name) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class_name) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

use Controllers\RobotController;

$robotController = new RobotController();

while (true) {
    echo "Pilih jenis robot:\n";
    echo "1. Robot Biasa\n";
    echo "2. Robot Tempur\n";
    echo "3. Keluar\n";
    echo "Masukkan pilihan jenis robot (1, 2, atau 3): ";
    $pilihanRobot = (int)readline();

    if ($pilihanRobot === 3) {
        echo "Terima kasih telah menggunakan program ini.\n";
        break;
    } elseif ($pilihanRobot !== 1 && $pilihanRobot !== 2) {
        echo "Pilihan tidak valid. Silakan masukkan 1, 2, atau 3.\n";
        continue;
    }

    while (true) {
        echo "\nPilih aksi yang ingin dilakukan:\n";
        echo "1. Aktifkan Robot\n";
        echo "2. Gerakkan Robot\n";
        echo "3. Cek Energi\n";
        echo "4. Isi Ulang Energi\n";
        if ($pilihanRobot === 2) {
            echo "5. Aktifkan Mode Tempur (Hanya untuk Robot Tempur)\n";
            echo "6. Tembakkan Senjata (Hanya untuk Robot Tempur)\n";
        }
        echo "7. Kembali ke Pilihan Robot\n";
        echo "Masukkan pilihan aksi (1-7): ";
        $choice = (int)readline();

        if ($choice === 1) {
            if ($pilihanRobot === 1) {
                $robotController->tampilkanRobotBiasa()->nyalakanMesin();
            } else {
                $robotController->tampilkanRobotTempur()->nyalakanMesin();
            }
        } elseif ($choice === 2) {
            if ($pilihanRobot === 1) {
                $robotController->tampilkanRobotBiasa()->jalan();
            } else {
                $robotController->tampilkanRobotTempur()->jalan();
            }
        } elseif ($choice === 3) {
            if ($pilihanRobot === 1) {
                $robotController->tampilkanRobotBiasa()->cekEnergi();
            } else {
                $robotController->tampilkanRobotTempur()->cekEnergi();
            }
        } elseif ($choice === 4) {
            if ($pilihanRobot === 1) {
                $robotController->tampilkanRobotBiasa()->isiUlangEnergi();
            } else {
                $robotController->tampilkanRobotTempur()->isiUlangEnergi();
            }
        } elseif ($choice === 5 && $pilihanRobot === 2) {
            $robotController->tampilkanRobotTempur()->aktifkanModeTempur();
        } elseif ($choice === 6 && $pilihanRobot === 2) {
            $robotController->tampilkanRobotTempur()->tembak();
        } elseif ($choice === 7) {
            break;
        } else {
            echo "Pilihan tidak valid. Silakan masukkan angka sesuai menu.\n";
        }
    }
}
?>