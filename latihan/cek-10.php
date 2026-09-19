<?php
declare(strict_types=1);

// ============================================================
// SESI TERKAIT : sesi/006-form-crud.md
// STATUS       : ALAT PENGECEKAN, bukan tugas
//
// PENGECEKAN OTOMATIS TUGAS 10
// Jalankan: php latihan/cek-10.php
//
// Cara kerjanya: file ini MENJALANKAN 10-form.php beberapa kali
// seperti kalau ada user yang buka halaman dan klik Simpan.
// Lalu hasilnya dicek langsung ke database dan ke HTML-nya.
// ============================================================

$dir   = __DIR__;
$file  = $dir . "/10-form.php";
$kirim = $dir . "/cek-10-kirim.php";
$buka  = $dir . "/cek-10-buka.php";
$dbFile = $dir . "/toko.sqlite";

function jalankan(string $cmd): string
{
    return (string) shell_exec($cmd . " 2>&1");
}

function ambilSemua(PDO $db): array
{
    return $db->query("SELECT * FROM produk ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
}

// ---------- mulai dari kondisi bersih ----------
jalankan("php " . escapeshellarg($dir . "/07-db-setup.php"));

$db = new PDO("sqlite:" . $dbFile);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$cek = [];

// ---------- 1. halaman punya form POST yang benar ----------
$html = jalankan("php " . escapeshellarg($buka));

$cek["halaman jalan tanpa error PHP"] =
    stripos($html, "fatal error") === false
    && stripos($html, "parse error") === false
    && stripos($html, "warning") === false;

$cek["ada <form> dengan method post"] =
    stripos($html, "<form") !== false && stripos($html, 'method="post"') !== false;

$cek['ada input name="nama"']  = stripos($html, 'name="nama"') !== false;
$cek['ada input name="harga"'] = stripos($html, 'name="harga"') !== false;
$cek['ada input name="stok"']  = stripos($html, 'name="stok"') !== false;

$cek["halaman READ: tabel menampilkan 4 produk awal"] =
    count(ambilSemua($db)) === 4
    && strpos($html, "Kopi Arabica") !== false
    && strpos($html, "Gula Aren") !== false;

// ---------- 2. kirim data VALID -> harus masuk database ----------
jalankan("php " . escapeshellarg($kirim) . " " . escapeshellarg("Produk Uji") . " 12345 7");
$semua = ambilSemua($db);

$cek["CREATE: data valid masuk database (jumlah jadi 5)"] = count($semua) === 5;

$baru = null;
foreach ($semua as $p) {
    if ($p["nama"] === "Produk Uji") {
        $baru = $p;
    }
}
$cek["CREATE: nama, harga, stok tersimpan dengan benar"] =
    $baru !== null && (int) $baru["harga"] === 12345 && (int) $baru["stok"] === 7;

// ---------- 3. kirim data TIDAK VALID -> tidak boleh masuk ----------
jalankan("php " . escapeshellarg($kirim) . " " . escapeshellarg("") . " 9999 9");
$cek["VALIDASI: nama kosong ditolak (jumlah tetap 5)"] = count(ambilSemua($db)) === 5;

jalankan("php " . escapeshellarg($kirim) . " " . escapeshellarg("Produk Harga Salah") . " abc 9");
$cek["VALIDASI: harga bukan angka ditolak"] =
    count(ambilSemua($db)) === 5;

// ---------- 4. keamanan XSS ----------
jalankan("php " . escapeshellarg($kirim) . " " . escapeshellarg("<script>alert(1)</script>") . " 100 1");
$htmlSetelah = jalankan("php " . escapeshellarg($buka));

$cek["XSS: nama berisi <script> tidak dieksekusi, tapi ditampilkan sebagai teks"] =
    strpos($htmlSetelah, "&lt;script&gt;") !== false
    && strpos($htmlSetelah, "<script>alert(1)</script>") === false;

// ---------- 5. READ: produk baru kelihatan di halaman ----------
$cek["READ: produk hasil form muncul di tabel"] = strpos($htmlSetelah, "Produk Uji") !== false;

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
    echo "SEMUA PASS. Tugas 10 selesai. Coba juga manual di browser: php -S localhost:8000\n";
} else {
    echo "Masih ada yang belum. Perbaiki dulu, jangan lapor sebelum semua PASS.\n";
}

// ---------- kembalikan database uji ke kondisi bersih (4 produk awal) ----------
jalankan("php " . escapeshellarg($dir . "/07-db-setup.php"));
echo "\n(database uji sudah di-reset ke 4 produk awal)\n";
