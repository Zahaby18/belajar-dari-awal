<?php
declare(strict_types=1);

// ============================================================
// SESI TERKAIT : sesi/007-update-delete.md
// STATUS       : ALAT PENGECEKAN, bukan tugas
//
// PENGECEKAN OTOMATIS TUGAS 12 (hapus/delete)
// Jalankan: php latihan/cek-12.php
// ============================================================

$dir    = __DIR__;
$driver = $dir . "/cek-driver.php";
$target = "12-hapus.php";

function jalankan(string $cmd): string
{
    return (string) shell_exec($cmd . " 2>&1");
}

function request(string $driver, string $target, string $method, string $data = ""): string
{
    return jalankan("php " . escapeshellarg($driver)
        . " " . escapeshellarg($target)
        . " " . escapeshellarg($method)
        . " " . escapeshellarg($data));
}

function nama(PDO $db, int $id): ?string
{
    $stmt = $db->prepare("SELECT nama FROM produk WHERE id = ?");
    $stmt->execute([$id]);
    $hasil = $stmt->fetchColumn();
    return $hasil === false ? null : (string) $hasil;
}

function jumlah(PDO $db): int
{
    return (int) $db->query("SELECT COUNT(*) FROM produk")->fetchColumn();
}

// mulai dari kondisi bersih
jalankan("php " . escapeshellarg($dir . "/07-db-setup.php"));
$db = new PDO("sqlite:" . $dir . "/toko.sqlite");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$cek = [];

// ---------- 1. halaman daftar ----------
$html = request($driver, $target, "GET");

$cek["halaman jalan tanpa error PHP"] =
    stripos($html, "fatal error") === false
    && stripos($html, "parse error") === false
    && stripos($html, "warning") === false;

$cek["daftar produk tampil (4 produk)"] = strpos($html, "Gula Aren") !== false;

$cek["tombol Hapus berupa FORM POST (bukan link)"] =
    stripos($html, "<form") !== false
    && stripos($html, 'method="post"') !== false
    && stripos($html, 'name="id"') !== false;

$cek["TIDAK ada link <a> untuk hapus (aturan keamanan)"] =
    strpos($html, 'href="12-hapus.php?id=') === false
    && strpos($html, "href='12-hapus.php?id=") === false;

// ---------- 2. hapus satu produk ----------
request($driver, $target, "POST", "id=3");
$cek["DELETE: produk id 3 terhapus (jumlah jadi 3)"] = jumlah($db) === 3;
$cek["DELETE: produk id 3 memang yang terhapus"] = nama($db, 3) === null;

$cek["DELETE: produk lain TIDAK ikut terhapus (WHERE bekerja)"] =
    nama($db, 1) === "Kopi Arabica" && nama($db, 2) === "Teh Hijau" && nama($db, 4) === "Gula Aren";

// ---------- 3. hapus id yang tidak ada / bukan angka ----------
request($driver, $target, "POST", "id=99");
$cek["DELETE id yang tidak ada -> tidak error, jumlah tetap 3"] =
    jumlah($db) === 3 && stripos(request($driver, $target, "POST", "id=99"), "fatal error") === false;

request($driver, $target, "POST", "id=abc");
$cek["DELETE id bukan angka -> ditolak dengan aman, jumlah tetap 3"] = jumlah($db) === 3;

// ---------- tampilkan hasil ----------
$lulus = 0;
$gagal = 0;
foreach ($cek as $namaCek => $ok) {
    echo ($ok ? "[PASS] " : "[FAIL] ") . $namaCek . "\n";
    $ok ? $lulus++ : $gagal++;
}

echo "\n----------------------------------------\n";
echo "LULUS: $lulus | GAGAL: $gagal\n";

if ($gagal === 0) {
    echo "SEMUA PASS. Tugas 12 selesai.\n";
} else {
    echo "Masih ada yang belum. Perbaiki dulu, jangan lapor sebelum semua PASS.\n";
}

jalankan("php " . escapeshellarg($dir . "/07-db-setup.php"));
echo "\n(database uji sudah di-reset ke 4 produk awal)\n";
