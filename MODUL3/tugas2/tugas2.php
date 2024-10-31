<?php
function cetakAngka($n) {
    for ($i = 1; $i <= $n; $i++) {
        if ($i % 4 == 0 && $i % 6 == 0) {
            echo "Pemrograman Website 2024\n";
        } elseif ($i % 5 == 0) {
            echo "2024\n";
        } elseif ($i % 4 == 0) {
            echo "Pemrograman\n";
        } elseif ($i % 3 == 0) {
            echo "Hanif\n";
        } else {
            echo $i . "\n";
        }
    }
}

echo "Input angka terserah: ";
$n = (int)readline(); 
cetakAngka($n);
?>
