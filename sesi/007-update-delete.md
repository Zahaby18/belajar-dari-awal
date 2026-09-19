# SESI 007 - UPDATE & DELETE (CRUD lengkap)

> **LATIHAN TERKAIT:**
> - `latihan/11-edit.php` (Tugas 11 - UBAH data)
> - `latihan/12-hapus.php` (Tugas 12 - HAPUS data)
> - `latihan/cek-driver.php` (alat simulasi request, dipakai pengecekan)
> - `latihan/cek-11.php` dan `latihan/cek-12.php` (pengecekan otomatis)

Kalau sesi 006 selesai, kamu sudah punya Create + Read. Sekarang Update + Delete. Setelah ini CRUD kamu lengkap, dan itu pondasi semua aplikasi bisnis.

---

# BAGIAN A: UPDATE (ubah data)

## 1. Alur yang benar untuk edit
1. User lihat daftar produk
2. Klik **Edit** di baris produk
3. URL jadi `11-edit.php?id=5` -> halaman menampilkan **form terisi data produk id 5**
4. User ubah isinya, klik Simpan
5. Data di database di-UPDATE
6. Redirect balik ke daftar

## 2. Konsep baru: `$_GET` (data dari URL)
Sampai sekarang kamu cuma pakai `$_POST` (kiriman form). Ada satu lagi: **`$_GET`**, isinya parameter di URL.
```
11-edit.php?id=5
           ^^^^^^ ini yang masuk ke $_GET["id"]
```
```php
$idDariUrl = $_GET["id"] ?? "";    // selalu pakai ?? "" biar aman kalau nggak ada
```

Aturan praktis yang mudah diingat:
- **`$_GET`** -> minta/lihat sesuatu (buka halaman, filter, cari)
- **`$_POST`** -> mengubah sesuatu (simpan, ubah, hapus)

## 3. Ambil 1 baris untuk diisi ke form
Ini pola yang sudah kamu kuasai (Tugas 08):
```php
$stmt = $db->prepare("SELECT * FROM produk WHERE id = ? LIMIT 1");
$stmt->execute([$idDariUrl]);
$produkEdit = $stmt->fetch();
// $produkEdit isinya false kalau produknya nggak ada
```
Lalu di form, isi `value`-nya dari `$produkEdit`:
```php
<input type="text" name="nama" value="<?= htmlspecialchars($produkEdit["nama"]) ?>">
```

## 4. UPDATE ke database
```php
$stmt = $db->prepare("UPDATE produk SET nama = ?, harga = ?, stok = ? WHERE id = ?");
$stmt->execute([$nama, (int)$harga, (int)$stok, (int)$id]);
```
**`WHERE id = ?` itu WAJIB.** Kalau kamu lupa `WHERE`-nya, perintah itu mengubah **semua baris** di tabel. Semua produk namanya jadi sama. Ini kesalahan paling mematikan di dunia database, dan satu-satunya pelindungmu adalah **membaca ulang perintah SQL kamu sebelum menjalankan.**

Kebiasaan untuk perintah UPDATE dan DELETE:
1. Tulis perintah SELECT dulu dengan WHERE yang sama, pastikan yang mau diubah memang benar barisnya
2. Kalau sudah cocok, ganti jadi UPDATE/DELETE

## 5. Contoh lengkap (buku, bukan tugas)
```php
<?php
declare(strict_types=1);

$db = new PDO("sqlite:" . __DIR__ . "/contoh.sqlite");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$error = [];

// --- proses simpan perubahan ---
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id    = trim($_POST["id"] ?? "");
    $judul = trim($_POST["judul"] ?? "");

    if ($judul === "") {
        $error[] = "Judul tidak boleh kosong";
    }

    if ($error === []) {
        $stmt = $db->prepare("UPDATE buku SET judul = ? WHERE id = ?");
        $stmt->execute([$judul, (int)$id]);

        header("Location: contoh.php");
        exit;
    }
}

// --- produk mana yang mau diedit? (dari URL) ---
$idDariUrl  = $_GET["id"] ?? "";
$bukuEdit   = null;

if ($idDariUrl !== "") {
    $stmt = $db->prepare("SELECT * FROM buku WHERE id = ? LIMIT 1");
    $stmt->execute([(int)$idDariUrl]);
    $hasilCari = $stmt->fetch();
    if ($hasilCari !== false) {
        $bukuEdit = $hasilCari;
    }
}

// --- daftar semua ---
$semua = $db->query("SELECT * FROM buku ORDER BY id")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Edit Buku</title></head>
<body>
    <h1>Edit Buku</h1>

    <?php foreach ($error as $e): ?>
        <p style="color:red"><?= htmlspecialchars($e) ?></p>
    <?php endforeach; ?>

    <?php if ($bukuEdit === null): ?>
        <p>Klik "Edit" di salah satu baris tabel di bawah.</p>
    <?php else: ?>
        <form method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars((string)$bukuEdit["id"]) ?>">
            <label>Judul: <input type="text" name="judul" value="<?= htmlspecialchars($bukuEdit["judul"]) ?>"></label>
            <button type="submit">Simpan Perubahan</button>
        </form>
    <?php endif; ?>

    <table border="1" cellpadding="6">
        <tr><th>ID</th><th>Judul</th><th>Aksi</th></tr>
        <?php foreach ($semua as $b): ?>
            <tr>
                <td><?= $b["id"] ?></td>
                <td><?= htmlspecialchars($b["judul"]) ?></td>
                <td><a href="contoh.php?id=<?= $b["id"] ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
```

### 3 hal halus yang penting
1. `<input type="hidden" name="id" ...>` -> id ikut terkirim saat submit, tapi user nggak melihatnya. Semua form edit butuh ini
2. Tombol Edit itu **link** (`<a href="...?id=5">`), bukan form. Karena cuma membuka halaman (nggak mengubah data), jadi pantas pakai GET
3. `$bukuEdit === null` -> kalau belum pilih produk, tampilkan instruksi, jangan tampilkan form kosong

---

# BAGIAN B: DELETE (hapus data)

## 6. HAPUS JANGAN PAKAI LINK (ini aturan keamanan penting)
Godaan pertama biasanya bikin link seperti ini:
```html
<a href="12-hapus.php?id=5">Hapus</a>   <!-- BAHAYA -->
```
Kenapa bahaya: **crawler** (Googlebot, bot preview WhatsApp, antivirus, prefetch browser) suka membuka semua link di halaman. Kalau penghapusan lewat link GET, bot bisa menghapus data user tanpa ada yang klik. Ini bukan teori, pernah kejadian di produk nyata.

Jadi untuk delete: **selalu pakai form POST.**
```html
<form method="post" onsubmit="return confirm('Hapus produk ini?')">
    <input type="hidden" name="id" value="<?= $p["id"] ?>">
    <button type="submit">Hapus</button>
</form>
```
- `onsubmit="return confirm(...)"` -> muncul dialog konfirmasi bawaan browser. Kalau user klik Cancel, `return false` bikin form nggak dikirim
- Tiap baris punya form sendiri, dengan `id` masing-masing

## 7. DELETE ke database
```php
$stmt = $db->prepare("DELETE FROM produk WHERE id = ?");
$stmt->execute([(int)$id]);

header("Location: 12-hapus.php");
exit;
```
Sama seperti UPDATE: **`WHERE` itu wajib.** Tanpa WHERE, seluruh isi tabel terhapus. Form `DELETE FROM produk` = hapus semua.

## 8. Urutan baca perintah SQL yang berbahaya
Sebelum menjalankan UPDATE atau DELETE, baca ulang dan tanyakan:
1. Tabelnya benar?
2. `WHERE`-nya ada?
3. `WHERE id = ?` cocok dengan nilai yang gue kirim?
4. Kalau salah, apa yang paling parah yang bisa terjadi?

Pertanyaan ke-4 itu yang bikin dev senior hati-hati. Di kerjaan nyata, kesalahan UPDATE tanpa WHERE bisa menghapus data produksi dan itu nggak bisa di-undo.

---

## TUGAS 11 dan 12
1. `latihan/11-edit.php` -> isi 4 TODO (form edit + proses UPDATE)
2. `latihan/12-hapus.php` -> isi 4 TODO (tabel + form hapus + proses DELETE)

## Cara menjalankan (seperti biasa)
```
php -S localhost:8000
```
- `http://localhost:8000/latihan/11-edit.php`
- `http://localhost:8000/latihan/12-hapus.php`

## Cara verifikasi
```
php latihan/cek-11.php
php latihan/cek-12.php
```
Pengecekan itu mensimulasikan klik user: buka halaman, klik Edit, kirim perubahan, klik Hapus. Lalu hasilnya dicek langsung ke database.

## Setelah 007 lulus
CRUD kamu lengkap. Langkah berikutnya:
1. **CSS** - bikin tampilannya rapi (kamu sudah familiar dari kerjaan WordPress)
2. **Refactor** - rapikan kode yang mulai berulang (function, pemisahan file)
3. **Laravel** - semua yang kamu tulis manual ini bakal jadi jauh lebih singkat: route, controller, Eloquent, Blade, migration
