# SESI 006 - FORM & CRUD (CREATE + READ)

> **LATIHAN TERKAIT:**
> - `latihan/10-form.php` (Tugas 10)
> - `latihan/cek-10.php` + `latihan/cek-10-kirim.php` (alat pengecekan)

Sampai sekarang data cuma bisa masuk lewat script yang kamu tulis. Sesi ini kamu bikin **user yang nambah data sendiri lewat form di browser**. Inilah CRUD:
- **C**reate (sesi ini)
- **R**ead (sesi ini)
- **U**pdate (besok)
- **D**elete (besok)

---

## 1. Apa yang terjadi saat user klik tombol "Simpan"
1. Browser mengirim **request POST** ke server, isinya nilai dari tiap input form
2. PHP menerima isi itu di sebuah rak bernama **`$_POST`**
3. Kamu validasi isinya (jangan langsung percaya)
4. Kalau lolos, simpan ke database
5. Arahkan user kembali ke halaman daftar (redirect)

## 2. GET vs POST (ini yang kamu sudah pakai tiap hari tanpa sadar)
| | GET | POST |
|---|---|---|
| Fungsinya | minta halaman | kirim data yang mengubah sesuatu |
| Datanya nempel di URL? | ya (`?id=5`) | nggak, ada di body request |
| Kalau di-refresh | aman, cuma ambil ulang | browser tanya "kirim ulang?" |
| Dipakai untuk | buka halaman, filter, pencarian | simpan, ubah, hapus |

**Masalah klasiknya:** kalau setelah simpan kamu tidak redirect, user yang refresh halaman akan mengirim ulang form yang sama -> produk masuk **dua kali**. Ini bug yang kejadian di aplikasi nyata terus-terusan.
Solusinya cuma 2 baris: redirect setelah simpan.

## 3. `$_POST` dan validasi (JANGAN PERCAYA KIRIMAN LUAR)
`$_POST` itu rak. Ambil isinya pakai label yang sama dengan atribut `name` di HTML:
```php
$nama  = $_POST["nama"];    // <input name="nama">
$harga = $_POST["harga"];   // <input name="harga">
```
Aturan besi: **semua yang datang dari luar itu tidak bisa dipercaya.** Bisa kosong, bisa bukan angka, bisa isinya script. Jadi wajib divalidasi:
```php
$error = [];   // wadah pesan error, siapkan kosong di awal

if ($nama === "") {
    $error[] = "Nama tidak boleh kosong";
}
if (!is_numeric($harga) || (int)$harga < 0) {
    $error[] = "Harga harus berupa angka dan tidak boleh negatif";
}
if (!is_numeric($stok) || (int)$stok < 0) {
    $error[] = "Stok harus berupa angka dan tidak boleh negatif";
}
```
Perhatiin pola barunya:
- `$error = []` -> pola akumulator yang sudah kamu kuasai, tapi wadahnya pesan
- `is_numeric($x)` -> function bawaan PHP: "apakah ini angka?" (perhatikan: kalau hasilnya angka, jangan lupa ubah ke int pakai `(int)`)
- `!is_numeric(...)` -> tanda `!` artinya "TIDAK"

Kalau `$error` masih kosong, berarti semua valid -> baru simpan.

## 4. Redirect (dan kenapa `exit` wajib)
```php
$stmt = $db->prepare("INSERT INTO produk (nama, harga, stok) VALUES (?, ?, ?)");
$stmt->execute([$nama, (int)$harga, (int)$stok]);

header("Location: 10-form.php");
exit;
```
- `header("Location: ...")` = perintah ke browser: "pindah ke halaman ini"
- `exit;` = hentikan script SEKARANG. Kalau nggak pakai `exit`, PHP tetap lanjut jalan dan tetap bikin HTML di bawahnya, padahal browser sudah disuruh pindah. Hasilnya perilaku aneh
- `(int)$harga` = ubah dari teks ke angka, karena isi `$_POST` selalu teks

## 5. Contoh lengkap (contoh buku, bukan tugas)
```php
<?php
declare(strict_types=1);

$db = new PDO("sqlite:" . __DIR__ . "/contoh.sqlite");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->exec("CREATE TABLE IF NOT EXISTS buku (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    judul TEXT NOT NULL,
    tahun INTEGER NOT NULL
)");

$error = [];
$inputJudul = "";
$inputTahun = "";

// --- PROSES KIRIMAN FORM ---
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $inputJudul = trim($_POST["judul"] ?? "");
    $inputTahun = trim($_POST["tahun"] ?? "");

    if ($inputJudul === "") {
        $error[] = "Judul tidak boleh kosong";
    }
    if (!is_numeric($inputTahun) || (int)$inputTahun < 1900) {
        $error[] = "Tahun harus angka dan minimal 1900";
    }

    if ($error === []) {
        $stmt = $db->prepare("INSERT INTO buku (judul, tahun) VALUES (?, ?)");
        $stmt->execute([$inputJudul, (int)$inputTahun]);

        header("Location: contoh.php");
        exit;
    }
}

$buku = $db->query("SELECT * FROM buku ORDER BY id")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>
</head>
<body>
    <h1>Data Buku</h1>

    <?php if ($error !== []): ?>
        <ul style="color: red;">
            <?php foreach ($error as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post">
        <label>Judul:
            <input type="text" name="judul" value="<?= htmlspecialchars($inputJudul) ?>">
        </label>
        <label>Tahun:
            <input type="text" name="tahun" value="<?= htmlspecialchars($inputTahun) ?>">
        </label>
        <button type="submit">Simpan</button>
    </form>

    <table border="1" cellpadding="6">
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Tahun</th>
        </tr>
        <?php foreach ($buku as $b): ?>
            <tr>
                <td><?= $b["id"] ?></td>
                <td><?= htmlspecialchars($b["judul"]) ?></td>
                <td><?= $b["tahun"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
```

### Hal-hal halus yang penting dari contoh di atas
1. `?? ""` -> kalau label itu nggak dikirim, pakai string kosong. Mencegah error "undefined index"
2. `trim()` -> buang spasi di awal/akhir. Jadi user yang cuma ngetik spasi tetap dianggap kosong
3. **Nilai input dikembalikan ke form** (`value="<?= htmlspecialchars($inputJudul) ?>"`). Jadi kalau ada error, user nggak perlu ngetik ulang. Ini pengalaman pakai yang bagus, dan ini juga alasan variabel `$inputJudul` disiapkan sebelum blok POST
4. `if ($error !== []):` -> blok error hanya muncul kalau ada error
5. Semua teks yang ditampilkan dibungkus `htmlspecialchars()` — termasuk pesan error, nilai input, dan data dari database

---

## TUGAS 10 (Create + Read)
File: `latihan/10-form.php` (kerangka + TODO sudah disiapkan)

Yang kamu isi:
1. **TODO 1**: ambil `nama`, `harga`, `stok` dari `$_POST` (pakai `trim()` dan `?? ""`)
2. **TODO 2**: validasi 3 hal (nama tidak kosong, harga angka >= 0, stok angka >= 0), kumpulkan pesan ke `$error`
3. **TODO 3**: kalau `$error` kosong, INSERT pakai prepared statement lalu redirect
4. **TODO 4**: tampilkan pesan error kalau ada
5. **TODO 5**: form dengan 3 input (`nama`, `harga`, `stok`) + tombol Simpan

Tabel produknya sudah gue siapkan (dari Tugas 09), jadi kamu fokus ke bagian form + proses.

## Cara menjalankan
```
php -S localhost:8000
```
Buka: `http://localhost:8000/latihan/10-form.php`
Coba sendiri: isi form -> Simpan -> produk baru muncul. Coba juga isi nama kosong atau harga "abc" -> harus muncul pesan error, dan data TIDAK masuk.

## Cara verifikasi
```
php latihan/cek-10.php
```
Pengecekan itu ngetes 5 hal:
1. Halaman nampilin form POST dengan 3 input yang benar
2. Kirim data valid -> produk masuk ke database
3. Kirim data tidak valid (nama kosong) -> data TIDAK masuk
4. Kirim nama berisi `<script>` -> halaman menampilkannya sebagai teks biasa (anti XSS)
5. Halaman daftar tetap nampilkan semua produk

## Setelah 10 lulus
Sesi 007 (besok): **Update dan Delete** — tombol Edit dan Hapus per baris, plus teknik yang lebih aman untuk kirim aksi (pakai `id` di URL + method POST). Setelah itu kamu punya aplikasi CRUD lengkap, dan itu modal buat masuk Laravel.
