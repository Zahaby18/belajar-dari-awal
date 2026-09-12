<?php
// ============================================================
// TUGAS 4 - LATIHAN MANDIRI (tanpa contoh)
// Polanya SAMA PERSIS dengan stokRendah. Cuma pertanyaannya yang beda.
// Kerjakan ini SETELAH kamu ngetik ulang solusi 03 dan lulus verifikasi.
// ============================================================

// Function ini tugasnya: saring produk yang harganya LEBIH DARI ATAU SAMA DENGAN hargaMinimal.
// Contoh: produkMahal($produk, 60000) -> produk yang harganya >= 60000
function produkMahal(array $produk, int $hargaMinimal): array
{
    // TODO: isi sendiri. Polanya sama:
    // 1. siapkan rak kosong
    // 2. foreach $produk sebagai $p
    // 3. if harga produk ini >= hargaMinimal  (label harga: $p["harga"])
    // 4. masukkan ke rak hasil
    // 5. return rak hasilnya
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
