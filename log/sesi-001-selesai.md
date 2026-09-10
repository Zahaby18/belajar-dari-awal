# SESI 001 - SELESAI
Commit: `efce434` - "Ubah File 1 00-mulai.php"

## HASIL: 6 dari 6 tugas JALAN, exit code 0 (tanpa error)
```
=== TUGAS 1: cetak teks ===    Zahaby
=== TUGAS 2: variable ===      25000
=== TUGAS 3: hitung ===        30000
=== TUGAS 4: if ===            mahal
=== TUGAS 5: array + foreach === apeljerukmangga
=== TUGAS 6: function pertama === 12
```
`No syntax errors detected in latihan/00-mulai.php` (dicek pakai `php -l`)

## Yang kamu benerin sendiri (2 hal)
1. Titik koma di `echo tambah(5,7);` -> benar, parse error hilang, seluruh file jalan
2. `echo $buah[0]` -> `foreach ($buah as $i) { echo $i; }` -> benar, ketiga buah keluar

Kamu ngerjain dua-duanya sendiri tanpa contoh dari gue. Itu poin terpenting sesi ini, bukan soal titik koma-nya.

## 1 hal yang belum rapi (kecil)
Output TUGAS 5: `apeljerukmangga` (nempel semua). Tugasnya minta satu per baris.
Penyebab: `echo $i;` nggak ada pindah baris. Benerin jadi:
```php
echo $i . "\n";
```
Tanda titik `.` itu artinya MENGGABUNGKAN teks. Jadi `$i` digabung dengan karakter pindah baris.

## Catatan gaya (bukan error, biar kebiasaan)
- Nama variable `$i` biasanya dipakai untuk nomor urut (0,1,2). Untuk item rak, lebih umum `$b` atau `$buahItem`. Kamu nanti lihat ini di kode orang
- Pesan commit lebih bagus kalau menyebut APA yang diubah: "sesi 001: fix titik koma TUGAS 6 + foreach TUGAS 5". Aturan praktisnya: orang lain harus tahu isinya tanpa buka file

## File lain
`latihan/01-basics.php` masih parse error di baris 18 (`hitungTotal[1000,2000]`). Itu memang ditunda. Jangan diutak-atik sampai Sesi 002.

## STATUS
Sesi 001: LULUS. Progres: dari 0/10 (diagnostik) jadi 6/6 tugas kecil jalan.
Sesi berikutnya: **Sesi 002 - function yang mengolah data** (target: menyelesaikan `formatRupiah` + `stokRendah`)
