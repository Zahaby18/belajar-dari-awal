<?php
declare(strict_types=1);

// ============================================================
// SESI TERKAIT : sesi/007-update-delete.md
// STATUS       : ALAT PENGECEKAN, bukan tugas
//
// PENGECEKAN OTOMATIS TUGAS 11 (update/edit)
// Jalankan: php latihan/cek-11.php
// ============================================================

$dir    = __DIR__;
$driver = $dir . "/cek-driver.php";
$target = "11-edit.php";

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

function ambil(PDO $db, int $id): ?array
{
    $stmt = $db->prepare("SELECT * FROM produk WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row === false ? null : $row;
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

$cek["daftar produk tampil (4 produk)"] =
    strpos($html, "Kopi Arabica") !== false && strpos($html, "Gula Aren") !== false;

$cek["ada link Edit dengan parameter id"] = strpos($html, "11-edit.php?id=") !== false;

// ---------- 2. buka halaman edit satu produk ----------
$htmlEdit = request($driver, $target, "GET", "id=2");

$cek["buka ?id=2 -> form terisi data produk itu"] =
    strpos($htmlEdit, 'value="Teh Hijau"') !== false
    && strpos($htmlEdit, 'name="id"') !== false;

$cek["buka ?id=99 (produk tidak ada) -> tidak error"] =
    stripos(request($driver, $target, "GET", "id=99"), "fatal error") === false;

// ---------- 3. kirim perubahan yang valid ----------
request($driver, $target, "POST", "id=2&nama=Teh+Hijau+Premium&harga=36000&stok=8");

$row = ambil($db, 2);
$cek["UPDATE: data produk id 2 berubah sesuai kiriman"] =
    $row !== null && $row["nama"] === "Teh Hijau Premium"
    && (int) $row["harga"] === 36000 && (int) $row["stok"] === 8;

$cek["UPDATE: hanya baris yang dituju yang berubah (WHERE bekerja)"] =
    ambil($db, 1) !== null && ambil($db, 1)["nama"] === "Kopi Arabica"
    && ambil($db, 3) !== null && ambil($db, 3)["nama"] === "Cokelat Bubuk"
    && ambil($db, 4) !== null && ambil($db, 4)["nama"] === "Gula Aren";

$cek["UPDATE: jumlah produk tetap 4 (tidak ada yang terhapus/tergandakan)"] =
    (int) $db->query("SELECT COUNT(*) FROM produk")->fetchColumn() === 4;

// ---------- 4. validasi: kalau data tidak valid, jangan diubah ----------
request($driver, $target, "POST", "id=2&nama=&harga=36000&stok=8");
$row = ambil($db, 2);
$cek["VALIDASI: nama kosong -> data tidak berubah"] =
    $row !== null && $row["nama"] === "Teh Hijau Premium";

// ---------- 5. kirim perubahan ke id yang tidak ada ----------
request($driver, $target, "POST", "id=99&nama=Produk Hantu&harga=1&stok=1");
$cek["UPDATE ke id yang tidak ada -> tidak error, tidak mengubah data apa pun"] =
    (int) $db->query("SELECT COUNT(*) FROM produk")->fetchColumn() === 4
    && ambil($db, 99) === null;

// ---------- tampilkan hasil ----------
$lulus = 0;
$gagal = 0;
foreach ($cek as $nama => $ok) {
    echo ($ok ? "[PASS] " : "[FAIL] ") . $nama . "\n";
    $ok ? $lulus++ : $gagal++;
}

echo "\n----------------------------------------\n";
echo "LULUS: $lulus | GAGAL: $gagal\n";

if ($gagal === 0) {
    echo "SEMUA PASS. Tugas 11 selesai.\n";
} else {
    echo "Masih ada yang belum. Perbaiki dulu, jangan lapor sebelum semua PASS.\n";
}

jalankan("php " . escapeshellarg($dir . "/07-db-setup.php"));
echo "\n(database uji sudah di-reset ke 4 produk awal)\n";
