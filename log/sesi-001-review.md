# REVIEW SESI 001
Commit dinilai: `22677aa` - "Pelajaran Pertama. Basic masih 0 CUPU"
Tanggal: 10 Sep 2026

## SKOR: 4,5 dari 6 tugas / 75%
Naik dari 0/10 di C sesi diagnostik. Ini lompatan besar, dan gue nggak nyangka secepat ini.

| Tugas | Status | Catatan |
|---|---|---|
| 1. echo teks | LOLOS | `echo "Zahaby";` benar |
| 2. variable | LOLOS | `$harga = 25000;` benar |
| 3. hitung | LOLOS | `$total = $harga1 + $harga2;` benar |
| 4. if | LOLOS | struktur if/else rapi. Bagus. |
| 5. array + foreach | **SETENGAH** | array benar, tapi cuma cetak `$buah[0]` (satu item). Loop-nya belum |
| 6. function | **GAGAL** | logikanya BENAR, tapi tidak ada `;` di akhir. Akibatnya seluruh file mati |

## TEMUAN UTAMA: 1 karakter bikin SEMUA mati
Kamu tulis:
```php
echo tambah(5,7)
```
Harusnya:
```php
echo tambah(5,7);
```
PHP jawab:
```
PHP Parse error: syntax error, unexpected token "echo", expecting "," or ";" in latihan/00-mulai.php on line 55
```

**Kenapa TUGAS 1-4 kamu nggak jalan sama sekali padahal udah bener?**
Karena PHP membaca seluruh file DULU sebelum menjalankan satu perintah pun. Namanya **parse error**. Kalau ada satu syntax salah di baris 55, baris 1 juga nggak dijalankan. Ini beda dengan error runtime (yang cuma matiin bagian yang error).

### Cara baca pesan parse error (hafalin 3 langkah ini)
1. Baca **nama filenya** dan **nomor barisnya** (di sini: line 55)
2. Kata kunci `unexpected token "echo"` artinya: PHP ketemu `echo`, padahal dia masih nunggu `;`
3. Lihat **baris SEBELUMnya** (baris 54), karena biasanya yang salah itu baris sebelumnya, bukan baris yang disebut. PHP baru sadar error-nya ketika ketemu perintah berikutnya.

Istilahnya: parse error selalu ngasih tahu di mana PHP nyerah, bukan di mana kamu salah. 90% parse error itu penyebabnya titik koma hilang.

Gue tes dengan nambah 1 karakter (`;`) doang: **TUGAS 1, 2, 3, 4, dan 6 semua keluar hasil yang benar.** Logika kamu nggak ada yang salah.

## TUGAS 5: konsep foreach belum kena
Yang kamu tulis: `echo $buah[0];` -> cuma "apel" yang keluar.
Itu ngambil kotak PERTAMA dari rak. Yang diminta: sebut SEMUA isi rak, satu-satu. Itu kerjaan `foreach`.

Pola yang ada di `sesi/001-php-survival.md` (bagian 4 & 5):
```php
foreach ($buah as $b) {
    echo $b;
}
```
Cara baca: "untuk tiap isi `$buah`, panggil dia `$b`, lakukan ini:"
Bedanya sama `$buah[0]`: `foreach` memindahkan isi SATU PER SATU, dari depan ke belakang, sampai selesai.

## ATURAN YANG KAMU LANGGAR (ini penting, bukan soal kode)
**Kamu push kode yang belum pernah dijalankan.** Parse error itu error paling dasar, dan akan kelihatan dalam 1 detik kalau kamu run. Sebelum commit, selalu:
```
php latihan/00-mulai.php
```
Bukan ngandelin feeling. Kode yang belum dijalankan bukan kode, itu tulisan.

## FILE 01-BASICS.PHP: JANGAN DULU (tapi 5 kesalahanmu gue jelasin)
Kamu iseng ngerjain file yang gue bilang ditunda. Nggak apa-apa, tapi pelajari 5 kesalahannya:

1. `hitungTotal[1000,2000]` -> **kurung siku `[]` itu untuk array, bukan memanggil function.** Memanggil function pakai kurung biasa: `hitungTotal(1000, 2000)`
2. `array_sum(hitungTotal(...))` -> `array_sum` fungsinya jumlahkan ARRAY. `hitungTotal` mengembalikan ANGKA.
3. `echo number_format(formatRupiah(1000000))` -> kebalik. `number_format` dipakai DI DALAM `formatRupiah`, bukan dipanggil dari luar. Dan `formatRupiah` sekarang masih `return "";` (belum diisi)
4. `echo ... ` tanpa `;` di 2 tempat -> parse error lagi
5. `$produk` kamu definisikan 3x di 3 tempat berbeda -> tidak error, tapi boros dan bikin bingung. Satu definisi, taruh di atas, pakai berkali-kali.
6. Function-nya masih `return 0.0;` dan `return [];` -> badan function belum diisi, jadi hasilnya pasti kosong walau cara panggilnya benar

## YANG HARUS KAMU KERJAKAN SEKARANG
1. Tambah `;` di baris 54 file `latihan/00-mulai.php`
2. Ganti `echo $buah[0];` jadi `foreach` biar ketiga buah keluar
3. Jalankan `php latihan/00-mulai.php` sampai outputnya benar SEMUA
4. Commit + push, tulis di chat "udah"
5. Jangan sentuh `01-basics.php` dulu. Kita bereskan itu di Sesi 002, dan gue mau lihat kamu ngerjain dengan otak, bukan buru-buru

## SATU HADIAH BUAT KAMU
Pesan commit kamu "Basic masih 0 CUPU" itu SALAH. Dalam 45 menit kamu nulis PHP pertama kamu, 4 dari 6 tugas langsung benar tanpa dibenerin. Angka 0 CUPU itu nggak cocok sama bukti yang gue baca di diff kamu.
Orang yang gagalnya karena nggak tahu, itu normal. Yang bahaya itu yang nggak jalanin kodenya. Jadi mulai sekarang, kebiasaan wajibnya satu: **run dulu, baru commit.**
