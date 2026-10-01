# SIAPA YANG MENULIS KODE INI?

Gue tambahin label langsung di file latihan supaya kelihatan mana kontribusi Zahab, mana materi/kerangka Blessync.

## Arti label
- `INI ZAHAB YANG NGERJAIN` = bagian kode yang kamu tulis atau implementasikan. Bisa saja kamu mengacu contoh yang sudah dijelaskan; label ini menandai bahwa implementasi di file latihan itu hasil kerjamu.
- `INI BLESSYNC YANG NGERJAIN` = contoh, kerangka, fixture/test, atau alat yang gue buat.
- Di file campuran, **ikuti batas awal/akhir label**, jangan anggap seluruh file ditulis satu orang.
- File `sesi/*.md` berisi materi dan contoh dari Blessync. Kode tugasmu ada di file `latihan/*.php` yang ditautkan.

## Peta per file

| File | Bagian Zahab | Bagian Blessync |
|---|---|---|
| `latihan/00-mulai.php` | Jawaban Tugas 1-6: `echo`, variable, hitung, `if`, `foreach`, function `tambah` | Judul tugas, instruksi dan kerangka |
| `latihan/01-basics.php` | Percobaan awal Tugas 1-4 yang belum selesai, ditandai sebagai percobaan | Signature/stub 5 function dan test harness. File ini masih ditunda |
| `latihan/02-functions.php` | Implementasi `hitungTotal`, percobaan `number_format`, `formatRupiah` | Contoh `hitungJumlah` dan instruksi |
| `latihan/03-stokRendah.php` | Implementasi function `stokRendah` | Instruksi/soal dan fixture produk |
| `latihan/04-produkMahal.php` | Implementasi mandiri function `produkMahal` | Instruksi, fixture dan test |
| `latihan/05-cariProduk.php` | Implementasi function `cariProduk` | Instruksi, fixture dan test dua kondisi |
| `latihan/06-tampilkanTabel.php` | Implementasi function `tampilkanTabel` | Instruksi, fixture dan pemanggilan test |
| `latihan/07-db-setup.php` | `CREATE TABLE` dan `INSERT` 4 produk | Koneksi PDO, instruksi, dan query output test |
| `latihan/08-db-baca.php` | Isi function `ambilSemuaProduk` dan `cariProdukById` | Signature, petunjuk, koneksi dan test harness |
| `latihan/09-halaman.php` | Loop produk, isi sel tabel, dan total produk | Koneksi DB, kerangka HTML/header, tabel dan instruksi |
| `latihan/10-form.php` | Ada label per blok: tambahan `CREATE TABLE` (duplikat), proses POST/validasi/INSERT, tampilkan error, form input | Kerangka koneksi, tabel baca, instruksi dan kerangka halaman |
| `latihan/11-edit.php`, `12-hapus.php` | Belum ada | Kerangka Blessync; belum kamu kerjakan |
| `latihan/cek-*.php`, `cek-driver.php`, `lihat-db.php` | Tidak ada: ini alat bantu, bukan tugas | Blessync |
| `latihan/solusi/03-stokRendah-solusi.php` | Tidak ada: ini contoh referensi | Blessync |
| `tools/label-authorship.py` | Tidak ada: script pemasang penanda | Blessync |
| `sesi/*.md` | Bukan tempat mengerjakan kode | Materi dan contoh ditulis Blessync |

## Biar nggak bingung setelah lama jeda
Mulai dari `PETA-MATERI.md` untuk cari sesi ↔ latihan. Di file PHP, cari teks `INI ZAHAB` untuk menemukan jawabanmu. Cari `INI BLESSYNC` untuk contoh/kerangka gue.

**Penting:** penanda bukan penilaian kualitas atau klaim bahwa semua kode ditulis tanpa bantuan. Penanda hanya menunjukkan siapa yang menyiapkan/menulis bagian tersebut, supaya riwayat belajarnya jelas.
