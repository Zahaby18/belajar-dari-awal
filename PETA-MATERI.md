# PETA MATERI: SESI vs LATIHAN
Kalau bingung nyocokin sesi sama latihan, buka file ini. Satu tabel, semua kelihatan.

## Aturan penamaan
- **`sesi/`** = materi bacaan. Isinya penjelasan + contoh lengkap.
- **`latihan/`** = tempat kamu nulis kode. Isinya kerangka + tugas.
- **`latihan/expected/`** = output yang seharusnya keluar (patokan verifikasi).
- **`latihan/solusi/`** = contoh jawaban (buat dipelajari, jangan di-copy paste).
- **`log/`** = catatan mentor: hasil penilaian, review, dan `PROGRESS.md`.

Angka di nama file **bukan** pasangan otomatis. Satu sesi bisa punya beberapa latihan, dan satu latihan bisa lanjut ke sesi berikutnya. Makanya tabel di bawah ini yang jadi patokan.

---

## Tabel peta

| Sesi (materi) | Latihan yang dikerjakan | Status |
|---|---|---|
| `sesi/001-php-survival.md` | `latihan/00-mulai.php` (Tugas 1-6 kecil) | ✅ LULUS |
| `sesi/001-php-dasar.md` (versi berat) | `latihan/01-basics.php` (5 function) | ⏸️ DITUNDA (jadi tugas pengulangan) |
| `sesi/002-function-olah-data.md` | `latihan/02-functions.php` (hitungTotal, formatRupiah) | ✅ LULUS |
| `sesi/002-function-olah-data.md` | `latihan/03-stokRendah.php` (filter data) | ✅ LULUS |
| `sesi/002-function-olah-data.md` | `latihan/04-produkMahal.php` (variasi mandiri) | ✅ LULUS |
| `sesi/003-cari-dan-tampilkan.md` | `latihan/05-cariProduk.php` (early return + null) | ✅ LULUS |
| `sesi/003-cari-dan-tampilkan.md` | `latihan/06-tampilkanTabel.php` (str_pad + void) | ✅ LULUS |
| `sesi/004-database.md` | `latihan/07-db-setup.php` (bikin tabel + isi data) | ✅ LULUS |
| `sesi/004-database.md` | `latihan/08-db-baca.php` (baca DB dari function) | ✅ LULUS |
| `sesi/005-halaman-web.md` | `latihan/09-halaman.php` (tabel HTML di browser) | ✅ LULUS (11 PASS) |
| `sesi/006-form-crud.md` | `latihan/10-form.php` (form tambah produk) | 🔄 SEDANG DIKERJAKAN |

## Alat bantu (bukan tugas)
| File | Gunanya |
|---|---|
| `latihan/cek-09.php` | pengecekan otomatis Tugas 09 (11 poin PASS/FAIL) |
| `latihan/cek-10.php` | pengecekan otomatis Tugas 10 |
| `latihan/cek-10-kirim.php` | simulasi kiriman form POST (dipakai oleh cek-10) |
| `latihan/cek-10-buka.php` | simulasi buka halaman dari browser / request GET |
| `latihan/expected/*.txt` | output patokan buat dibandingin |
| `PANDUAN-GIT.md` | cara pull, commit, push |
| `PANDUAN-RUN-PHP.md` | cara run, cara bandingin output dengan target |
| `log/PROGRESS.md` | rekap progres semua hari |

---

## Urutan belajar (yang sudah dilalui)
1. **sesi 001** - PHP paling dasar: variable, echo, if, array, foreach, function
2. **sesi 002** - function yang mengolah data: akumulator angka, filter, format teks
3. **sesi 003** - mencari & menampilkan: early return, null, str_pad, void
4. **sesi 004** - database: PDO, prepared statement, fetch, keamanan SQL injection
5. **sesi 005** - halaman web: HTML, PHP di dalam HTML, htmlspecialchars (anti XSS)
6. **sesi 006** - form & CRUD: `$_POST`, validasi input, INSERT dari form, redirect
7. **sesi 007 (rencana)** - update & delete data
8. **sesi 008 (rencana)** - CSS biar tampilannya rapi
9. **setelah itu** - Laravel: route, controller, Eloquent, Blade, migration
