<?php
// PENANDA KEPEMILIKAN KODE: blok bertanda INI ZAHAB = bagian yang Zahab implementasi/ubah.
// Kerangka, instruksi, contoh, dan test yang tidak bertanda disiapkan Blessync.
// ============================================================
// SESI TERKAIT : sesi/003-cari-dan-tampilkan.md
// STATUS       : LULUS
// Buka file sesi itu buat baca materinya, dan cek PETA-MATERI.md
// kalau bingung nyocokin sesi sama latihan.
// ============================================================
// ============================================================
// TUGAS 6 - tampilkanTabel
// Konsep str_pad + void sudah dicontohkan di sesi/003 (cetakDaftarBuah).
// Ini level 2: kamu tulis sendiri.
// Kalau mentok, buka materi sesi/003 bagian "KONSEP BARU 2".
// ============================================================

// Cetak daftar produk jadi tabel rapi:
// baris 1: header  (Nama | Harga | Stok)
// baris 2: garis pemisah dari tanda - sebanyak 34
// baris 3+: satu baris per produk
// >>> INI ZAHAB YANG NGERJAIN: implementasi Tugas 6
function tampilkanTabel(array $produk): void
{
    echo str_pad("Nama", 15). "| " . str_pad("Harga", 10) . "| ". "Stok" . "\n";
    echo "----------------------------------". "\n";

    foreach($produk as $p){
        echo str_pad($p["nama"], 15) . "| " . str_pad((string)$p["harga"], 10) . "| " . $p["stok"] . "\n" ;
    }
}
// <<< AKHIR BAGIAN ZAHAB

// ============================================================
// BAGIAN TES - jangan diubah
// ============================================================

$produk = [
    ["nama" => "Kopi Arabica",  "harga" => 85000, "stok" => 12],
    ["nama" => "Teh Hijau",     "harga" => 35000, "stok" => 3],
    ["nama" => "Cokelat Bubuk", "harga" => 62000, "stok" => 0],
    ["nama" => "Gula Aren",     "harga" => 25000, "stok" => 20],
];

tampilkanTabel($produk);
