# SESI 004 - DATABASE (PDO + SQLite)
Ini sesi paling penting sejauh ini. Sampai sekarang data kamu cuma hidup selama program jalan. Setelah ini, data bisa disimpan permanen. Dan inilah dasar dari semua aplikasi web, termasuk Laravel.

---

## 1. Database itu apa (analogi rak)
Database = **lemari arsip**. Di dalamnya ada **tabel** (satu lemari), di dalam tabel ada **baris** (satu produk), dan tiap baris punya **kolom** (label: nama, harga, stok).

Bandingkan dengan yang sudah kamu kuasai:
| Di PHP | Di database |
|---|---|
| `$produk` (rak) | tabel `produk` |
| 1 item `$p` (rak berlabel) | 1 baris |
| label `"nama"`, `"stok"` | nama kolom |

Jadi database itu **rak yang hidup di disk**, bukan di memory. Makanya datanya nggak hilang walau programnya ditutup.

## 2. SQLite: database yang paling gampang buat belajar
SQLite = database berupa **satu file** (`toko.sqlite`). Nggak perlu install server. PHP kamu sudah bisa langsung pakai (ekstensi `pdo_sqlite`).
Nanti di Laravel kamu pakai MySQL/PostgreSQL, tapi perintah SQL-nya sama. Belajar di SQLite dulu biar fokus ke konsepnya.

## 3. PDO: pintunya
PDO = cara PHP ngobrol dengan database. Polanya selalu 4 langkah:
```php
// 1. SAMBUNG
$db = new PDO("sqlite:" . __DIR__ . "/toko.sqlite");

// 2. SIAPKAN perintah (dengan tanda ? sebagai tempat kosong)
$stmt = $db->prepare("INSERT INTO produk (nama, harga, stok) VALUES (?, ?, ?)");

// 3. JALANKAN, isi tempat kosongnya
$stmt->execute(["Bayam", 5000, 10]);

// 4. AMBIL hasilnya
$stmt = $db->query("SELECT * FROM produk");
$semua = $stmt->fetchAll();
```

### Contoh lengkap (contoh sayur, bukan tugas)
```php
<?php
declare(strict_types=1);

$db = new PDO("sqlite:" . __DIR__ . "/contoh.sqlite");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// bikin tabel
$db->exec("CREATE TABLE IF NOT EXISTS sayur (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nama TEXT NOT NULL,
    harga INTEGER NOT NULL
)");

// isi data pakai prepared statement
$stmt = $db->prepare("INSERT INTO sayur (nama, harga) VALUES (?, ?)");
$stmt->execute(["Bayam", 5000]);
$stmt->execute(["Brokoli", 25000]);

// baca data
$stmt = $db->query("SELECT * FROM sayur ORDER BY id");
foreach ($stmt->fetchAll() as $s) {
    echo $s["id"] . " - " . $s["nama"] . " - " . $s["harga"] . "\n";
}
```
Hasilnya:
```
1 - Bayam - 5000
2 - Brokoli - 25000
```

Komentar per bagian:
- `__DIR__` = folder tempat file PHP ini berada. Jadi path database nggak bergantung dari mana kamu run
- `$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION)` = perintah wajib: kalau SQL-nya salah, PHP kasih error yang jelas, bukan diam-diam gagal. **Selalu tulis baris ini**
- `$db->exec()` = jalankan perintah SQL yang nggak mengembalikan data (CREATE, DROP)
- `$db->prepare()` + `execute()` = jalankan perintah dengan nilai yang dimasukkan belakangan
- `fetchAll()` = ambil SEMUA baris hasil jadi rak berisi rak (persis seperti `$produk` kamu)
- `fetchColumn()` = ambil 1 nilai saja (misal hasil `COUNT(*)`)

## 4. KENAPA PAKAI `?` (prepare), BUKAN TEMPEL LANGSUNG
Ini konsep keamanan pertama kamu, dan ini yang memisahkan programmer dari tukang ketik:
```php
// BAHAYA - jangan pernah begini
$nama = $_POST["nama"];   // isi ini datang dari user
$db->query("SELECT * FROM produk WHERE nama = '$nama'");
```
Kalau ada orang jahat mengetik ini di form:
```
' OR '1'='1
```
Maka SQL yang jalan jadi `SELECT * FROM produk WHERE nama = '' OR '1'='1'` -> SEMUA data kebuka. Namanya **SQL injection**.
Dengan prepared statement (`?`), isi dari user diperlakukan sebagai **data**, bukan sebagai perintah. Jadi usaha bobolnya gagal.
Ini bukan teori, ini penyebab kebocoran data perusahaan yang kejadian tiap tahun.

---

## TUGAS 07 - setup database
File: `latihan/07-db-setup.php` (kerangka + TODO sudah disiapkan)
Tujuan: bikin database `toko.sqlite`, bikin tabel `produk`, isi 4 produk.
Target output ada di `latihan/expected/07-db-setup.txt`.

## TUGAS 08 - baca database dari function
File: `latihan/08-db-baca.php`
Tujuan: bikin 2 function (`ambilSemuaProduk`, `cariProdukById`) yang baca dari database pakai PDO.
Perhatiin: `cariProdukById` itu pola **early return + null** yang sudah kamu kuasai di Tugas 5, cuma sumber datanya sekarang database.
Target output ada di `latihan/expected/08-db-baca.txt`. **PENTING: run 07 dulu, baru 08.** Kalau `toko.sqlite` belum ada, 08 nggak punya data.

## Cara verifikasi (wajib)
```
php latihan/07-db-setup.php > hasil7.txt
fc hasil7.txt latihan\expected\07-db-setup.txt

php latihan/08-db-baca.php > hasil8.txt
fc hasil8.txt latihan\expected\08-db-baca.txt
```
File `latihan/toko.sqlite` sudah masuk `.gitignore`, jadi database kamu nggak ikut ke-commit (data tidak masuk repo, strukturnya ada di kode).

## Setelah 004 lulus
Kamu sudah bisa: PHP, function, array, pola filter/cari, dan database.
Berikutnya Sesi 005: **HTML + form + CSS** -> baru setelah itu **Laravel**, karena di Laravel semua ini bakal dipakai sekaligus: route, controller, Eloquent (yang sebenarnya adalah PDO+SQL yang lebih nyaman).
