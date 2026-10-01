<?php
// PENANDA KEPEMILIKAN KODE: blok bertanda INI ZAHAB = bagian yang Zahab implementasi/ubah.
// Kerangka, instruksi, contoh, dan test yang tidak bertanda disiapkan Blessync.
// ============================================================
// SESI TERKAIT : sesi/002-function-olah-data.md
// STATUS       : LULUS
// Buka file sesi itu buat baca materinya, dan cek PETA-MATERI.md
// kalau bingung nyocokin sesi sama latihan.
// ============================================================

// >>> INI BLESSYNC YANG NGERJAIN: contoh akumulator untuk dipelajari
function hitungJumlah(array $angka) {
    $total = 0;
    foreach ($angka as $a) {
        $total = $total + $a;   // atau: $total += $a;
    }
    return $total;
}

echo hitungJumlah([10000, 20000, 30000]);   // 60000
// <<< AKHIR CONTOH BLESSYNC

echo "\n";

// Tugas 1
// >>> INI ZAHAB YANG NGERJAIN: implementasi Tugas 1
function hitungTotal(array $harga, float $pajak): float{
    $hasil = 0;
    foreach($harga as $a){
        $hasil = $hasil + $a;
    }

    return $hasil + ($hasil * $pajak / 100) ;
}

echo hitungTotal([10000,20000],10);
// <<< AKHIR BAGIAN ZAHAB

echo "\n";

// Tugas 2
// >>> INI ZAHAB YANG NGERJAIN: mencoba number_format untuk Tugas 2
echo number_format(1500000, 0, ",", ".") . "\n";
// <<< AKHIR BAGIAN ZAHAB

// >>> INI ZAHAB YANG NGERJAIN: implementasi Tugas 2
function formatRupiah(float $angka): string{
    return "Rp" . number_format($angka, 0, ",", "."). ",-";
}

echo formatRupiah(1500000). "\n";
echo formatRupiah(85000). "\n";
// <<< AKHIR BAGIAN ZAHAB