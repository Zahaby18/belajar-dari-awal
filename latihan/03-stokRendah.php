<?php
// PENANDA KEPEMILIKAN KODE: blok bertanda INI ZAHAB = bagian yang Zahab implementasi/ubah.
// Kerangka, instruksi, contoh, dan test yang tidak bertanda disiapkan Blessync.
// ============================================================
// SESI TERKAIT : sesi/002-function-olah-data.md
// STATUS       : LULUS
// Buka file sesi itu buat baca materinya, dan cek PETA-MATERI.md
// kalau bingung nyocokin sesi sama latihan.
// ============================================================
// >>> INI ZAHAB YANG NGERJAIN: implementasi Tugas 3 (filter produk stok rendah)
function stokRendah(array $produk, int $batas): array
{
    $hasil = [];
    foreach ($produk as $p) {
        if ($p["stok"] < $batas) {
            $hasil[] = $p;
        }
    }

    return $hasil;
}
// <<< AKHIR BAGIAN ZAHAB

$produk = [
    ["nama" => "Kopi Arabica",  "harga" => 85000, "stok" => 12],
    ["nama" => "Teh Hijau",     "harga" => 35000, "stok" => 3],
    ["nama" => "Cokelat Bubuk", "harga" => 62000, "stok" => 0],
    ["nama" => "Gula Aren",     "harga" => 25000, "stok" => 20],
];

$hasil = stokRendah($produk, 10);
echo count($hasil) . "\n";
foreach ($hasil as $p) {
    echo $p["nama"] . " - " . $p["stok"] . "\n";
}
