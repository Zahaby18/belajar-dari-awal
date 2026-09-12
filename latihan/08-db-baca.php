<?php
declare(strict_types=1);

// ============================================================
// TUGAS 08 - baca database dari function
// Pola function yang kamu bikin di sini SAMA dengan Tugas 5 (cariProduk),
// bedanya sumber datanya sekarang database, bukan array di dalam file.
//
// PENTING: run latihan/07-db-setup.php dulu supaya toko.sqlite ada isinya.
// ============================================================

// Ambil SEMUA produk dari tabel, urut berdasarkan id.
// Balikin rak berisi rak (sama bentuknya dengan $produk yang biasa kamu pakai).
function ambilSemuaProduk(PDO $db): array
{
    // TODO 1: SELECT * FROM produk ORDER BY id, lalu fetchAll()
}

// Cari 1 produk berdasarkan id.
// Ketemu -> balikin barisnya. Nggak ketemu -> balikin null.
// Petunjuk: di SQL, kalau pakai LIMIT 1, hasilnya paling banyak 1 baris -> pakai fetch(), bukan fetchAll()
function cariProdukById(PDO $db, int $id): ?array
{
    // TODO 2: bikin SELECT ... WHERE id = ? pakai prepared statement
    // TODO 3: ambil 1 barisnya; kalau kosong balikin null
}

// ============================================================
// BAGIAN TES - jangan diubah
// ============================================================

$db = new PDO("sqlite:" . __DIR__ . "/toko.sqlite");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$semua = ambilSemuaProduk($db);
echo count($semua) . "\n";
foreach ($semua as $p) {
    echo $p["id"] . " - " . $p["nama"] . " - " . $p["harga"] . "\n";
}

$p = cariProdukById($db, 2);
echo $p === null ? "TIDAK KETEMU\n" : $p["nama"] . "\n";

$p = cariProdukById($db, 99);
echo $p === null ? "TIDAK KETEMU\n" : $p["nama"] . "\n";
