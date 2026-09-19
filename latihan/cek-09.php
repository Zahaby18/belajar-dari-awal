<?php
// ============================================================
// SESI TERKAIT : sesi/005-halaman-web.md
// STATUS       : ALAT PENGECEKAN, bukan tugas
// Buka file sesi itu buat baca materinya, dan cek PETA-MATERI.md
// kalau bingung nyocokin sesi sama latihan.
// ============================================================
declare(strict_types=1);

// ============================================================
// PENGECEK OTOMATIS TUGAS 09
// Jalankan: php latihan/cek-09.php
//
// Ini contoh sederhana bagaimana programmer menguji hasil kerjanya
// tanpa mengandalkan mata. Nanti kamu bikin sendiri test seperti ini.
// ============================================================

$file = __DIR__ . "/09-halaman.php";
$hasil = shell_exec("php " . escapeshellarg($file) . " 2>&1");

$cek = [];

$cek["halaman jalan tanpa error PHP"] =
    stripos($hasil, "fatal error") === false
    && stripos($hasil, "parse error") === false
    && stripos($hasil, "warning") === false;

$cek["ada tag <table>"] = stripos($hasil, "<table") !== false;
$cek["ada header <th>Nama</th>"] = stripos($hasil, "<th>Nama</th>") !== false;

$namaProduk = ["Kopi Arabica", "Teh Hijau", "Cokelat Bubuk", "Gula Aren"];
foreach ($namaProduk as $nama) {
    $cek["ada produk: $nama"] = strpos($hasil, $nama) !== false;
}

$jumlahTd = substr_count(strtolower($hasil), "<td>");
$cek["ada minimal 16 sel <td> (4 produk x 4 kolom)"] = $jumlahTd >= 16;

$cek["jumlah produk tercetak"] = strpos($hasil, "Total produk: 4") !== false;

// CEK TAG BERPASANGAN (ditemukan 19 Sep: Zahab lupa tutup </tr> dan pengecekan lama tidak menangkapnya)
$cek["jumlah <tr> sama dengan jumlah </tr>"] = substr_count($hasil, "<tr>") === substr_count($hasil, "</tr>");
$cek["jumlah <td> sama dengan jumlah </td>"] = substr_count($hasil, "<td>") === substr_count($hasil, "</td>");

// tampilkan hasil
$lulus = 0;
$gagal = 0;
foreach ($cek as $nama => $ok) {
    echo ($ok ? "[PASS] " : "[FAIL] ") . $nama . "\n";
    $ok ? $lulus++ : $gagal++;
}

echo "\n----------------------------------------\n";
echo "LULUS: $lulus | GAGAL: $gagal\n";

if ($gagal === 0) {
    echo "SEMUA PASS. Tugas 09 selesai. Coba buka di browser: php -S localhost:8000\n";
} else {
    echo "Masih ada yang belum. Perbaiki dulu, jangan lapor sebelum semua PASS.\n";
}
