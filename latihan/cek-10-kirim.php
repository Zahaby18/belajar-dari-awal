<?php
declare(strict_types=1);

// ============================================================
// SESI TERKAIT : sesi/006-form-crud.md
// STATUS       : ALAT PENGECEKAN, bukan tugas
//
// Simulasi kiriman form. Dipakai oleh cek-10.php:
//     php cek-10-kirim.php "Nama Produk" "harga" "stok"
// ============================================================

$_SERVER["REQUEST_METHOD"] = "POST";
$_POST = [
    "nama"  => $argv[1] ?? "",
    "harga" => $argv[2] ?? "",
    "stok"  => $argv[3] ?? "",
];

include __DIR__ . "/10-form.php";
