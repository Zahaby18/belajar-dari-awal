<?php
declare(strict_types=1);

// ============================================================
// SESI TERKAIT : sesi/007-update-delete.md
// STATUS       : SEDANG DIKERJAKAN
// TUGAS 11 - EDIT PRODUK (Update)
//
// Contoh lengkap pola edit ada di sesi/007-update-delete.md bagian 5.
// Isi 4 TODO di bawah.
// ============================================================

$db = new PDO("sqlite:" . __DIR__ . "/toko.sqlite");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$error = [];
$produkEdit = null;

// ---------- 1. PROSES SIMPAN PERUBAHAN ----------
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // TODO 1: ambil id, nama, harga, stok dari $_POST (pakai trim dan ?? "")
    //
    //   lalu validasi:
    //     - nama tidak boleh kosong
    //     - harga harus angka dan tidak negatif
    //     - stok harus angka dan tidak negatif
    //   (sama seperti Tugas 10)
    //
    //   kalau $error kosong:
    //     UPDATE produk SET nama = ?, harga = ?, stok = ? WHERE id = ?
    //     lalu redirect: header("Location: 11-edit.php"); exit;
    //
    //   PERHATIAN: WHERE wajib ada. Tanpa WHERE, SEMUA baris berubah.
}

// ---------- 2. PRODUK MANA YANG MAU DIEDIT (dari URL) ----------
// TODO 2: ambil id dari $_GET["id"] ?? ""
//   kalau tidak kosong -> SELECT produknya (prepare + execute + fetch)
//   fetch() mengembalikan false kalau tidak ada -> simpan null ke $produkEdit
//   kalau ada -> simpan barisnya ke $produkEdit

// ---------- 3. DAFTAR SEMUA PRODUK ----------
$produk = $db->query("SELECT * FROM produk ORDER BY id")->fetchAll();

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
</head>
<body>
    <h1>Edit Produk</h1>

    <?php
    // TODO 3: tampilkan pesan error kalau $error tidak kosong
    //   dan tampilkan FORM EDIT kalau $produkEdit tidak null
    //   (form-nya sudah disiapkan di bawah, tinggal atur kapan muncul)
    ?>

    <?php if ($produkEdit === null): ?>
        <p>Klik "Edit" di salah satu baris tabel di bawah.</p>
    <?php else: ?>
        <form method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars((string) $produkEdit["id"]) ?>">
            <label>Nama: <input type="text" name="nama" value="<?= htmlspecialchars($produkEdit["nama"]) ?>"></label>
            <label>Harga: <input type="text" name="harga" value="<?= htmlspecialchars((string) $produkEdit["harga"]) ?>"></label>
            <label>Stok: <input type="text" name="stok" value="<?= htmlspecialchars((string) $produkEdit["stok"]) ?>"></label>
            <button type="submit">Simpan Perubahan</button>
        </form>
    <?php endif; ?>

    <h2>Daftar Produk</h2>
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
                    // TODO 4: bikin link Edit ke: 11-edit.php?id=<id produk>
                    //   bentuk: <a href="11-edit.php?id=<?= $p["id"] ?>">Edit</a>
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
