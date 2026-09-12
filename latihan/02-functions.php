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
function hitungTotal(array $harga, float $pajak) : float{
    $hasil = 0;
    foreach($harga as $a){
        $hasil = $hasil + $a;
    }

    $hasil + ($hasil * $pajak / 100);

    return $hasil;
}

echo hitungTotal([10000,20000],100);