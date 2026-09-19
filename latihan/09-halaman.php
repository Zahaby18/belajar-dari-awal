<?php
declare(strict_types=1);

// ============================================================
// TUGAS 09 - HALAMAN WEB PERTAMA
// Tujuan: tampilkan semua produk dari database sebagai tabel HTML,
// yang bisa dibuka di browser.
//
// Contoh lengkap pola HTML + PHP ada di sesi/005-halaman-web.md.
// Isi 2 TODO di bawah.
// ============================================================

// 1. SAMBUNG ke database (sudah kamu kuasai di Tugas 07)
$db = new PDO("sqlite:" . __DIR__ . "/toko.sqlite");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// 2. AMBIL semua produk (sudah kamu kuasai di Tugas 08)
$produk = $db->query("SELECT * FROM produk ORDER BY id")->fetchAll();

// 3. TAMPILKAN sebagai HTML
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
</head>
<body>
    <h1>Daftar Produk</h1>

    <table border="1" cellpadding="6">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>
        <?php
        // TODO 1: tampilkan tiap produk sebagai satu baris tabel berisi 4 sel:
        //   urutannya id, nama, harga, stok
        //   untuk nama WAJIB dibungkus htmlspecialchars()
        //
        // Bentuk loop-nya (contoh sayur, ini di dalam HTML jadi pakai titik dua):
        //   foreach ($produk as $p):
        //       tulis baris tabel buka
        //           tulis sel berisi $p["id"]
        //           tulis sel berisi htmlspecialchars($p["nama"])
        //           tulis sel berisi $p["harga"]
        //           tulis sel berisi $p["stok"]
        //       tulis baris tabel tutup
        //   endforeach;
        //
        // Ingat: tutup loop pakai endforeach, bukan kurung kurawal.
        // Dan jangan lupa: pembuka dan penutup PHP dipisah, lihat materi kalau ragu.
        ?>
    </table>

    <p>Total produk: <?= 0 /* TODO 2: ganti 0 ini dengan count($produk) */ ?></p>
</body>
</html>
