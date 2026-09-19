# SESI 005 - HALAMAN WEB PERTAMA (HTML + PHP)
Sampai sekarang semua hasil kerjamu cuma berupa teks di terminal. Sesi ini kamu bikin **halaman web** yang bisa dibuka di browser.

---

## 1. Yang berubah: terminal vs browser
Di terminal, hasilmu cuma kamu sendiri yang lihat. Di web, hasilmu dilihat orang lewat **browser**.
Bedanya cuma satu: browser minta halaman -> PHP bikin **teks HTML** -> browser mengubah teks itu jadi tampilan rapi.

Jadi HTML itu cuma **teks biasa dengan tanda khusus**. Contoh:
```html
<h1>Daftar Produk</h1>      -> teks besar
<p>Ini penjelasan</p>        -> paragraf biasa
<table> ... </table>         -> tabel
<tr> ... </tr>               -> satu baris tabel
<td>Kopi</td>                -> satu sel tabel
<th>Nama</th>                -> judul kolom (tulisannya tebal)
```
Tanda `<...>` itu namanya **tag**. Hampir semua tag punya pasangan penutup: `<td>` dibuka, `</td>` ditutup (perhatikan garis miringnya).

## 2. Menyambung PHP dan HTML
Di file yang sama, PHP dibuka dengan `<?php` dan ditutup dengan `?>`. Semua yang **di luar** `<?php ?>` dianggap HTML dan langsung dikirim ke browser.
```php
<?php
$nama = "Kopi Arabica";
?>
<h1>Produk: <?php echo $nama; ?></h1>
```
Hasil di browser: tulisan besar "Produk: Kopi Arabica".
Bentuk singkat `<?php echo $nama; ?>` bisa ditulis `<?= $nama ?>` (ini yang dipakai orang biar ringkas).

## 3. Perulangan di dalam HTML (ini kunci halaman dinamis)
Karena jumlah produk bisa berubah, baris tabelnya juga harus dibuat otomatis:
```php
<?php foreach ($produk as $p): ?>
    <tr>
        <td><?= $p["id"] ?></td>
        <td><?= $p["nama"] ?></td>
    </tr>
<?php endforeach; ?>
```
Perhatiin bentuk barunya: `foreach (...):` (pakai titik dua) dan ditutup `endforeach;` — bukan `{ }`. Ini cara nulis loop kalau di dalamnya ada HTML, jadi kodenya lebih enak dibaca.

## 4. WAJIB: `htmlspecialchars()` (keamanan pertama kamu di web)
Ini penting, dan ini yang membedakan programmer dari tukang ketik.
Bayangkan ada orang menambah produk dengan nama begini:
```
<script>alert('kamu kena hack')</script>
```
Kalau nama itu ditempel apa adanya ke HTML, browser akan MENJALANKAN script itu. Bayangkan kalau isinya bukan sekedar alert, tapi script yang mencuri data login. Namanya **XSS (Cross Site Scripting)**.

Solusinya satu function:
```php
<?= htmlspecialchars($p["nama"]) ?>
```
Fungsinya: mengubah karakter berbahaya jadi teks biasa. `<` jadi `&lt;`, `>` jadi `&gt;`. Jadi browser menampilkannya sebagai tulisan, bukan menjalankannya.

Aturan yang gue mau kamu hafal: **setiap teks yang berasal dari database atau dari user, WAJIB dibungkus `htmlspecialchars()` sebelum ditampilkan.**

## 5. Contoh lengkap (contoh sayur, bukan tugas)
```php
<?php
declare(strict_types=1);

$sayur = [
    ["nama" => "Bayam", "harga" => 5000],
    ["nama" => "Brokoli", "harga" => 25000],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Sayur</title>
</head>
<body>
    <h1>Daftar Sayur</h1>

    <table border="1" cellpadding="6">
        <tr>
            <th>Nama</th>
            <th>Harga</th>
        </tr>
        <?php foreach ($sayur as $s): ?>
            <tr>
                <td><?= htmlspecialchars($s["nama"]) ?></td>
                <td><?= $s["harga"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
```
Bagian `<!DOCTYPE html>`, `<head>`, `<meta charset>`, dan `<title>` itu kerangka wajib setiap halaman web. Nggak usah dihafal, nanti kebiasaan sendiri.

## 6. Jebakan yang bikin gue sendiri kena (penting)
Jangan pernah menulis **penutup PHP** (`?` + `>`) di dalam komentar. Begitu PHP ketemu tanda itu, dia menganggap mode PHP-nya sudah selesai, walaupun itu ada di dalam `//` atau `/* */`.
Akibatnya: sisa kodenya dianggap HTML, dan muncul parse error aneh seperti `unexpected token "endforeach"`.
Tadi gue kena waktu nulis kerangka tugas ini, dan itu bikin kerangkanya gagal jalan. Sudah gue benerin.
Aturan praktisnya: kalau mau nulis contoh kode di dalam komentar, **jangan pakai tanda penutup PHP-nya**. Tulis deskripsinya pakai kata-kata.

---

## TUGAS 09
File: `latihan/09-halaman.php` (kerangka + TODO sudah disiapkan)
Tujuan: menampilkan semua produk dari database sebagai **tabel HTML** yang bisa dibuka di browser.

Yang perlu kamu isi:
1. Bagian TODO 1: baris `<tr>` + 4 `<td>` per produk, pakai `foreach (...) :` dan `endforeach;`
2. Bagian TODO 2: cetak jumlah produk pakai `count()`
3. Kalau sudah, **buka di browser** untuk lihat hasilnya (cara di bawah)

### Cara menjalankan (server bawaan PHP)
Di terminal VS Code, di folder repo:
```
php -S localhost:8000
```
Terminal itu akan "diam" menunggu (itu tanda servernya hidup). Buka browser ke:
```
http://localhost:8000/latihan/09-halaman.php
```
Kalau mau matikan servernya: tekan `Ctrl + C` di terminal itu.

Catatan: file PHP yang kamu buka lewat browser itu dijalanin ulang setiap kali halaman di-refresh. Jadi kalau kamu ubah kodenya, cukup refresh browser (nggak perlu restart servernya).

### Cara verifikasi (wajib)
Selain dilihat di browser, ada pengecekan otomatis. Gue sudah siapkan file `latihan/cek-09.php`:
```
php latihan/cek-09.php
```
File itu mengecek: ada tag `<table>`, ada 4 nama produk, ada 16 sel `<td>`, jumlah produk tercetak, dan nggak ada error PHP. Hasilnya keluar PASS/FAIL per poin.

Kalau ada yang FAIL, perbaiki dulu sebelum lapor.

## Setelah 09 lulus
Sesi 006: bikin **form tambah produk** — kamu isi form di browser, datanya masuk ke database, dan muncul di tabel. Dari situ kamu sudah bisa bikin aplikasi CRUD sendiri, dan itu pondasi semua aplikasi bisnis.
