<?php
declare(strict_types=1);

// ============================================================
// SESI TERKAIT : sesi/007-update-delete.md
// STATUS       : ALAT PENGECEKAN, bukan tugas
//
// Simulasi satu request dari browser, dipakai oleh cek-11.php dan cek-12.php.
//
// Cara pakai:
//   php cek-driver.php 11-edit.php GET  "id=2"
//   php cek-driver.php 11-edit.php POST "id=2&nama=Teh+Hijau&harga=36000&stok=8"
//
// Argumen ke-3 pakai format query string (sama seperti di URL), biar
// nggak ada masalah tanda kutip di Windows.
// ============================================================

$file   = $argv[1] ?? "";
$method = strtoupper($argv[2] ?? "GET");
$isi    = $argv[3] ?? "";

// ubah query string jadi rak, sama seperti PHP melakukannya
$data = [];
parse_str($isi, $data);

// siapkan kondisi seperti request sungguhan dari browser
$_SERVER["REQUEST_METHOD"] = $method;
$_GET = [];
$_POST = [];

if ($method === "GET") {
    $_GET = $data;
} else {
    $_POST = $data;
}

include __DIR__ . "/" . basename($file);
