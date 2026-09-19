<?php
declare(strict_types=1);

// ============================================================
// SESI TERKAIT : sesi/007-update-delete.md
// STATUS       : SEDANG DIKERJAKAN
// TUGAS 12 - HAPUS PRODUK (Delete)
//
// Contoh lengkap pola hapus ada di sesi/007-update-delete.md bagian 6 dan 7.
// ATURAN PENTING: hapus TIDAK BOLEH pakai link <a href="...?id=..">.
// Harus pakai <form method="post">, karena bot/crawler suka membuka
// semua link di halaman dan bisa menghapus data tanpa ada yang klik.
// ============================================================

$db = new PDO("sqlite:" . __DIR__ . "/toko.sqlite");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pesan = "";

// ---------- 1. PROSES HAPUS ----------
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // TODO 1: ambil id dari $_POST (trim + ?? "")
    //   validasi: id harus berupa angka (is_numeric)
    //   kalau valid:
    //     DELETE FROM produk WHERE id = ?
    //     lalu redirect: header("Location: 12-hapus.php"); exit;
    //
    //   PERHATIAN: WHERE wajib ada. Tanpa WHERE, SELURUH isi tabel terhapus.
}

// ---------- 2. DAFTAR SEMUA PRODUK ----------
$produk = $db->query("SELECT * FROM produk ORDER BY id")->fetchAll();

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hapus Produk</title>
</head>
<body>
    <h1>Daftar Produk</h1>

    <table border="1" cellpadding="6">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($produk as $p): ?>
            <tr>
                <td><?= $p["id"] ?></td>
                <td><?= htmlspecialchars($p["nama"]) ?></td>
                <td><?= $p["harga"] ?></td>
                <td><?= $p["stok"] ?></td>
                <td>
                    <?php
                    // TODO 2: bikin form hapus untuk baris ini
                    //   <form method="post" onsubmit="return confirm('Hapus produk ini?')">
                    //       <input type="hidden" name="id" value="<id produk>">
                    //       <button type="submit">Hapus</button>
                    //   </form>
                    //
                    //   JANGAN pakai <a href="..."> untuk hapus.
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
