# SESI 001 - SURVIVAL KIT PHP (paling dasar)
Ganti target: bikin kamu bisa NULIS PHP dari nol, mulai dari 1 baris.
Estimasi: 45 menit total, 6 tugas kecil. Tugas 1 udah dikasih jawabannya biar kamu lihat polanya.

## Aturan: lupa semua yang rumit dulu
Kita nggak sentuh function kompleks, nggak sentuh database, nggak sentuh Laravel. 6 hal aja.

### Analogi (biar gampang nempel)
- **Variable** = kotak berlabel. `$harga = 10000;` artinya taruh angka 10000 ke kotak bernama harga.
- **echo** = kamu ngomong ke layar. `echo $harga;` artinya "sebutkan isi kotak harga".
- **Array** = rak dengan banyak kotak. `$buah = ["apel", "jeruk"];`
- **foreach** = ambil satu-satu dari rak, dari depan ke belakang.
- **if** = percabangan jalan. "kalau hujan, bawa payung".
- **function** = mesin kecil. Kamu masukkan bahan, dia keluarkan hasil.

### 6 aturan syntax yang WAJIB (cuma ini)
```php
<?php                     // wajib di baris pertama
$nama = "Zahab";          // variable selalu mulai dengan $
echo "halo";              // cetak
echo $nama;               // cetak isi variable
$total = 10000 + 20000;   // hitung
if ($total > 25000) { }   // kalau...
foreach ($buah as $b) { } // ulang satu-satu
```
Aturan yang sering ketuker: **setiap perintah diakhiri titik koma** `;`. Kalau lupa, PHP error.

---

## 6 TUGAS KECIL - kerjain di file `latihan/00-mulai.php`

**TUGAS 1 (udah dicontohkan, tinggal ubah)**
Di file itu udah ada baris `echo "TODO";`. Ubah jadi namamu sendiri, lalu jalankan.

**TUGAS 2 - variable**
Bikin kotak bernama `$harga` isinya `25000`. Lalu cetak isinya pakai `echo`.
Yang kamu tulis cuma 2 baris. Kalau bingung, lihat TUGAS 1 punya pola.

**TUGAS 3 - hitung**
Bikin `$harga1 = 10000;` dan `$harga2 = 20000;`
Bikin `$total = $harga1 + $harga2;`
Cetak `$total`. Harus keluar `30000`.

**TUGAS 4 - if**
Kalau `$total` lebih besar dari 25000, cetak `"mahal"`. Kalau nggak, cetak `"murah"`.
(butuh TUGAS 3 kelar dulu, karena pakai $total)

**TUGAS 5 - array + loop**
Bikin `$buah = ["apel", "jeruk", "mangga"];`
Cetak tiap buah pakai `foreach`, satu per baris.
Harus keluar 3 baris: apel, jeruk, mangga.

**TUGAS 6 - mesin pertama kamu**
Bikin function bernama `tambah` yang menerima dua angka dan mengembalikan hasil jumlahnya.
Panggil buat 5 + 7, cetak hasilnya. Harus keluar `12`.
Pola function (perhatikan: `return`, bukan `echo`):
```php
function namaMesin($bahan1, $bahan2) {
    return $bahan1 + $bahan2;
}
```

---

## Cara nanya kalau mentok (formatnya begini)
```
TUGAS 4: gue tulis if ($total > 25000) { echo "mahal" } tapi PHP bilang
"syntax error, unexpected ...". Gue nggak tahu artinya.
```
Tiga hal wajib ada: (1) tugas nomor berapa, (2) kode yang kamu tulis, (3) pesan error lengkapnya.
**Nanya ke gue itu bukan curang.** Itu memang fungsi mentor. Bedanya sama AI: gue kasih SATU langkah, bukan jawaban utuh, biar otot mikirnya tumbuh.

## Definisi selesai
6 tugas kelar, output-nya sesuai yang diminta, kamu bisa jelasin tiap baris.
Setelah ini baru Sesi 002: 5 function yang lebih serius (hitungTotal, formatRupiah, dll).
