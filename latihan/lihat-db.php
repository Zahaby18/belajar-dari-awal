<?php
declare(strict_types=1);

// ============================================================
// ALAT BANTU (bukan tugas) - LIHAT ISI DATABASE
// Status  : siap pakai
// Cara pakai: php latihan/lihat-db.php
//
// Gunanya: ngecek isi database toko.sqlite langsung dari terminal,
// tanpa perlu buka aplikasi lain.
// ============================================================

$fileDb = __DIR__ . "/toko.sqlite";

if (!file_exists($fileDb)) {
    echo "File database belum ada: latihan/toko.sqlite\n";
    echo "Jalankan dulu: php latihan/07-db-setup.php\n";
    exit(1);
}

$db = new PDO("sqlite:" . $fileDb);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// 1. daftar tabel yang ada di database ini
$tabel = $db->query("SELECT name FROM sqlite_master WHERE type = 'table' ORDER BY name")->fetchAll(PDO::FETCH_COLUMN);
echo "Tabel di dalam database : " . implode(", ", $tabel) . "\n\n";

// 2. tampilkan isi tabel produk sebagai tabel rapi
$produk = $db->query("SELECT * FROM produk ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);

echo "Isi tabel produk (jumlah: " . count($produk) . ")\n";
echo str_repeat("-", 46) . "\n";
echo str_pad("ID", 5) . str_pad("Nama", 20) . str_pad("Harga", 12) . "Stok\n";
echo str_repeat("-", 46) . "\n";

foreach ($produk as $p) {
    echo str_pad((string) $p["id"], 5)
        . str_pad((string) $p["nama"], 20)
        . str_pad((string) $p["harga"], 12)
        . $p["stok"] . "\n";
}
echo str_repeat("-", 46) . "\n";

// 3. tampilkan struktur tabelnya (perintah SQL yang dipakai buat bikin tabel)
foreach ($tabel as $t) {
    $skema = $db->query("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = " . $db->quote($t))->fetchColumn();
    echo "\nStruktur tabel `$t`:\n" . $skema . "\n";
}
