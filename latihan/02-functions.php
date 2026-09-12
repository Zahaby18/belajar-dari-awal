<?php

function hitungJumlah(array $angka) {
    $total = 0;
    foreach ($angka as $a) {
        $total = $total + $a;   // atau: $total += $a;
    }
    return $total;
}

echo hitungJumlah([10000, 20000, 30000]);   // 60000

echo "\n";

// Tugas 1
function hitungTotal(array $harga, float $pajak): float{
    $hasil = 0;
    foreach($harga as $a){
        $hasil = $hasil + $a;
    }

    return $hasil + ($hasil * $pajak / 100) ;
}

echo hitungTotal([10000,20000],10);

echo "\n";

// Tugas 2
echo number_format(1500000, 0, ",", ".") . "\n";

function formatRupiah(float $angka): string{
    return "Rp" . number_format($angka, 0, ",", "."). ",-";
}

echo formatRupiah(1500000). "\n";
echo formatRupiah(85000). "\n";