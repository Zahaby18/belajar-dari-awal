<?php
// ============================================================
// SESI TERKAIT : sesi/002-function-olah-data.md
// STATUS       : LULUS
// Buka file sesi itu buat baca materinya, dan cek PETA-MATERI.md
// kalau bingung nyocokin sesi sama latihan.
// ============================================================
// ============================================================
// TUGAS 4 - LATIHAN MANDIRI (tanpa contoh)
// Polanya SAMA PERSIS dengan stokRendah. Cuma pertanyaannya yang beda.
// Kerjakan ini SETELAH kamu ngetik ulang solusi 03 dan lulus verifikasi.
// ============================================================

// Function ini tugasnya: saring produk yang harganya LEBIH DARI ATAU SAMA DENGAN hargaMinimal.
// Contoh: produkMahal($produk, 60000) -> produk yang harganya >= 60000
function produkMahal(array $produk, int $hargaMinimal): array
{
    $hasil = [];
    foreach ($produk as $p) {
        if ($p["harga"] >= $hargaMinimal) {
            $hasil[] = $p;
        }
    }

    return $hasil;
}

// ============================================================
// BAGIAN TES - jangan diubah
// ============================================================

$produk = [
    ["nama" => "Kopi Arabica",  "harga" => 85000, "stok" => 12],
    ["nama" => "Teh Hijau",     "harga" => 35000, "stok" => 3],
    ["nama" => "Cokelat Bubuk", "harga" => 62000, "stok" => 0],
    ["nama" => "Gula Aren",     "harga" => 25000, "stok" => 20],
];

$hasil = produkMahal($produk, 60000);
echo count($hasil) . "\n";
foreach ($hasil as $p) {
    echo $p["nama"] . " - " . $p["harga"] . "\n";
}
