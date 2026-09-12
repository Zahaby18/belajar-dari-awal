<?php
declare(strict_types=1);

// ============================================================
// TUGAS 07 - setup database
// Konsep PDO + prepared statement ADA CONTOH LENGKAPNYA di sesi/004-database.md.
// Kerjakan 3 TODO di bawah ini.
// ============================================================

// Mulai bersih: hapus file database lama kalau ada
$fileDb = __DIR__ . "/toko.sqlite";
if (file_exists($fileDb)) {
    unlink($fileDb);
}

// SAMBUNG ke database
$db = new PDO("sqlite:" . $fileDb);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// TODO 1: bikin tabel `produk` pakai $db->exec()
// kolom:
//   id     INTEGER PRIMARY KEY AUTOINCREMENT   (nomor urut otomatis)
//   nama   TEXT
//   harga  INTEGER
//   stok   INTEGER

// TODO 2: isi 4 produk pakai prepared statement
//   Kopi Arabica    85000   12
//   Teh Hijau       35000    3
//   Cokelat Bubuk   62000    0
//   Gula Aren       25000   20
// Petunjuk: bikin $stmt = $db->prepare(...) SEKALI, lalu panggil ->execute([...]) berkali-kali
// (boleh juga pakai array produk + foreach)

// ============================================================
// BAGIAN TES - jangan diubah
// ============================================================

$jumlah = $db->query("SELECT COUNT(*) FROM produk")->fetchColumn();
echo "jumlah produk: " . $jumlah . "\n";

$stmt = $db->query("SELECT nama FROM produk ORDER BY id");
foreach ($stmt->fetchAll() as $row) {
    echo $row["nama"] . "\n";
}
