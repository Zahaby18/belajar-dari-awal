<?php
// ============================================================
// TUGAS 5 - cariProduk
// Ini konsep yang SUDAH kamu lihat contohnya di sesi/003 (cariBuah).
// Jadi ini level 2: kamu tulis sendiri, contohnya nggak ditaruh di file ini.
// Kalau mentok, buka materi sesi/003 bagian "KONSEP BARU 1".
// ============================================================

// Cari 1 produk berdasarkan namanya.
// Ketemu -> serahkan produknya (berhenti begitu ketemu)
// Nggak ketemu -> serahkan null
function cariProduk(array $produk, string $nama): ?array
{
    foreach($produk as $p){
        if ($p["nama"] === $nama){
            return $p;
        }
    }

    return null;
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

$p = cariProduk($produk, "Teh Hijau");
if ($p === null) {
    echo "TIDAK KETEMU\n";
} else {
    echo $p["nama"] . " - " . $p["harga"] . "\n";
}

$p = cariProduk($produk, "Kopi Luwak");
if ($p === null) {
    echo "TIDAK KETEMU\n";
} else {
    echo $p["nama"] . " - " . $p["harga"] . "\n";
}
