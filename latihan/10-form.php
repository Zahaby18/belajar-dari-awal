<?php
declare(strict_types=1);

// ============================================================
// SESI TERKAIT : sesi/006-form-crud.md
// STATUS       : SEDANG DIKERJAKAN
// TUGAS 10 - FORM TAMBAH PRODUK (Create + Read)
//
// Contoh lengkap pola form + validasi + INSERT + redirect ada
// di sesi/006-form-crud.md bagian 5 (contoh buku).
// Isi 5 TODO di bawah.
// ============================================================

// 1. SAMBUNG database
$db = new PDO("sqlite:" . __DIR__ . "/toko.sqlite");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->exec("CREATE TABLE IF NOT EXISTS produk (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nama TEXT NOT NULL,
    harga INTEGER NOT NULL,
    stok INTEGER NOT NULL
)");

// 2. SIAPKAN wadah pesan error + nilai input (biar form bisa diisi ulang kalau ada error)
$error = [];
$inputNama = "";
$inputHarga = "";
$inputStok = "";

// 3. PROSES KIRIMAN FORM
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // TODO 1: ambil isi form dari $_POST ke $inputNama, $inputHarga, $inputStok
    //   pakai trim() dan ?? ""
    //   contoh: $inputNama = trim($_POST["nama"] ?? "");
    $inputNama = trim($_POST["nama"] ?? "");
    $inputHarga = trim($_POST["harga"] ?? "");
    $inputStok = trim($_POST["stok"] ?? "");

    // TODO 2: validasi 3 hal, kumpulkan pesannya ke $error
    //   - nama tidak boleh kosong
    //   - harga harus angka dan tidak negatif   (pakai is_numeric + cast (int))
    //   - stok harus angka dan tidak negatif
    //   contoh bentuknya: $error[] = "pesan";
    if($inputNama === ""){
        $error[]="Nama tidak boleh kosong";
    }

    if(!is_numeric($inputHarga) || (int)$inputHarga < 0 ){
        $error[]="Angka Harus Nomor dan Tidak Boleh Negatif";
    }

    if(!is_numeric($inputStok) || (int)$inputStok < 0 ){
        $error[]="Stok Harus Nomor dan Tidak Boleh Negatif";
    }

    // TODO 3: kalau $error masih kosong, simpan ke database lalu redirect
    //   - INSERT INTO produk (nama, harga, stok) VALUES (?, ?, ?)
    //   - pakai prepared statement, jangan lupa (int) buat harga dan stok
    //   - setelah itu: header("Location: 10-form.php"); exit;
    if($error === []){
        $stmt = $db->prepare("INSERT INTO produk(nama,harga,stok) VALUES (?,?,?)");
        $stmt->execute([$inputNama, int($inputHarga), int($inputStok)]);

        header("Location: 10-form.php");
        exit;
    }
}

// 4. AMBIL data buat ditampilkan (sudah kamu kuasai di Tugas 08 dan 09)
$produk = $db->query("SELECT * FROM produk ORDER BY id")->fetchAll();

// 5. TAMPILKAN sebagai HTML
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
</head>
<body>
    <h1>Tambah Produk</h1>

    <?php
    // TODO 4: tampilkan daftar pesan error kalau $error tidak kosong
    //   bentuknya: kalau $error !== [] tampilkan <ul> berisi tiap pesan
    //   tiap pesan WAJIB dibungkus htmlspecialchars()
    if ($error !== []): ?>
        <ul style="color:red;">
            <?php foreach($error as $e) : ?>
            <li><?= htmlspecialchars($e); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>


    <form method="post">
        <?php
        // TODO 5: bikin 3 input + tombol simpan
        //   <input type="text" name="nama"  value="...">
        //   <input type="text" name="harga" value="...">
        //   <input type="text" name="stok"  value="...">
        //   <button type="submit">Simpan</button>
        //
        //   PENTING: atribut value-nya diisi nilai input sebelumnya ($inputNama, dst),
        //   dan WAJIB dibungkus htmlspecialchars() supaya aman dari XSS.
        ?>
        <label> Nama :
            <input type="text" name="nama" value="<?php htmlspecialchars($inputNama);?>">
        </label>
        <label> Harga :
            <input type="text" name="harga" value="<?php htmlspecialchars($inputHarga);?>">
        </label>
        <label> Stok :
            <input type="text" name="stok" value="<?php htmlspecialchars($inputStok);?>">
        </label>
        <button type="submit">Simpan</button>
    </form>

    <h2>Daftar Produk</h2>
    <table border="1" cellpadding="6">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>
        <?php foreach ($produk as $p): ?>
            <tr>
                <td><?= $p["id"] ?></td>
                <td><?= htmlspecialchars($p["nama"]) ?></td>
                <td><?= $p["harga"] ?></td>
                <td><?= $p["stok"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
