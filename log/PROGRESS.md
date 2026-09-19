# PROGRESS BOOTCAMP ZAHAB

## HARI 1 - 10 Sep 2026 (malam, ~45 menit)
- Diagnostik: **3,5 / 26 -> LEVEL 0 MURNI** (baca kode bisa, nulis belum)
- Temuan: bukan lagi programmer, tapi operator WordPress
- Hasil: Sesi 001 materi disiapkan, tugas pertama gue salah dosis (kegedean), langsung diturunkan ke level syntax 0

## HARI 2 - 12 Sep 2026 (SESI 001 + 002 + mulai 003)
**16 commit. 8 file PHP ditulis sendiri.**

### Lulus
| Tugas | Konsep yang dikuasai |
|---|---|
| 00-mulai.php (6 tugas kecil) | variable, echo, hitung, if/else, array, foreach, function dasar |
| hitungTotal | pola akumulator ANGKA (`$total = $total + $x`) |
| formatRupiah | format teks, `number_format`, satu function satu tugas |
| stokRendah | pola FILTER (akumulator RAK), array of array, `$hasil[] = $p` |
| produkMahal | variasi MANDIRI tanpa contoh -> bukti transfer, bukan hafalan |
| cariProduk | early return, `null`, `?array`, `===` |
| tampilkanTabel | `str_pad` (kolom lurus), `str_repeat` (garis pemisah), `void` |

### Belum lulus
(tidak ada. TUGAS 6 selesai di commit `8b79cbe` sebelum hari ditutup)

### Yang dibenerin dari nol sampai bisa
1. Titik koma hilang -> parse error (1 karakter mematikan seluruh file)
2. `/n` vs `\n` -> escape character
3. Hasil hitungan dibuang -> silent bug (`$hasil + (...)` tanpa `=`)
4. 2 tugas digabung 1 function -> single responsibility
5. `"Rp."` vs `"Rp "` vs `"Rp"` -> spesifikasi vs selera
6. Rak dibandingkan dengan angka -> tipe data
7. `echo` array -> "Array to string conversion"
8. Kolom tabel pakai spasi manual -> `str_pad`

### Kebiasaan baru yang sudah tertanam
- Selalu run sebelum commit
- Bandingkan output dengan target pakai `fc`/`diff`, bukan feeling
- Berani tanya sambil bawa kode + pesan error
- Commit kecil dan sering (16 dalam sehari)

### Catatan mentor
- Progres hari ini: dari "nggak bisa nulis PHP sama sekali" jadi 5 pola inti dikuasai dalam ~6 jam kerja
- Kelemahan yang masih ada: **verifikasi hasil sendiri** (4x berturut-turut lapor "udah" padahal output belum dicocokkan dengan target). Sudah dipasang ATURAN BUKTI
- Koreksi dari Zahab (12 Sep): aturan "mentee nulis dulu tanpa contoh" kekerasan untuk pemula syntax 0 -> direvisi jadi tangga 3 tingkat
- Kecepatan belajar termasuk cepat. Yang perlu dijaga: konsistensi, bukan kecepatan

## HARI 3 - 18 Sep 2026 (SESI 004 - DATABASE)
### Lulus
| Tugas | Konsep yang dikuasai |
|---|---|
| 07-db-setup | PDO connect, `exec(CREATE TABLE)`, `prepare` + `execute` berulang, tipe data kolom |
| 08-db-baca | function `: array` wajib `return` (bukan echo), prepared statement `?`, `fetch()` untuk 1 baris, konversi `false` -> `null`, ternary |

Data di database juga diverifikasi manual: 4 produk, stok 12/3/0/20 (termasuk nilai yang tidak dicek oleh test).

### Yang dibenerin hari ini
1. Function di-`echo` padahal return type `: array` -> TypeError fatal
2. `WHERE id=$id` tempel langsung -> diganti prepared statement `?`
3. Typo "Coklat" vs "Cokelat" di sumber data 07 -> bikin 2 test gagal (pelajaran: benerin di sumbernya, karena data mengalir)
4. Stok semua diisi 2 -> test tidak menangkap, tapi data tetap salah (pelajaran: test punya batas)

### Masalah alat
`fc` nggak jalan di komputernya Zahab karena di PowerShell `fc` = alias `Format-Custom`. Diganti `git diff --no-index` (pasti jalan, dia punya git). Panduan sudah diperbarui.

### Reaksi yang dicatat
Zahab bilang "nyerah" di tengah Tugas 08, padahal gap-nya cuma 4 baris. Setelah dibantu dipecah, selesai dalam satu iterasi. Monitor: jangan biarkan "nyerah" jadi kebiasaan; selalu kecilkan masalahnya jadi langkah konkret.

## HARI 4 - 19 Sep 2026 (SESI 005 - HALAMAN WEB PERTAMA)
### Lulus
| Tugas | Konsep yang dikuasai |
|---|---|
| 09-halaman | HTML dasar, nyampur PHP+HTML, loop di dalam HTML (`foreach:`/`endforeach;`), `htmlspecialchars()` (anti XSS), tag berpasangan, server bawaan `php -S` |

Cek otomatis `cekj-09.php`: 11 PASS. Validasi HTML pakai parser: struktur valid, tidak ada tag menggantung.

### Pelajaran penting hari ini
1. **Browser itu pemaaf.** HTML rusak (`<tr>` ditulis `<tr>` bukan `</tr>`) tetap tampil normal di browser. Kelihatan bagus di layar bukan bukti kode benar
2. **Test hijau bukan jaminan.** Pengecekan awal (9 poin) tidak menangkap bug `</tr>` karena tidak menguji keseimbangan tag. Setelah ditambah 2 pengecekan (total 11), bug-nya ketangkep. Ini contoh nyata keterbatasan test
3. `htmlspecialchars()` dipakai benar di percobaan pertama -> kesadaran keamanan XSS sudah ada

## HARI 5 - 19 Sep 2026 (SESI 006 - FORM & CRUD: CREATE + READ)
### Lulus
| Tugas | Konsep yang dikuasai |
|---|---|
| 10-form.php | form HTML + `method="post"`, `$_POST`, `trim()` + `?? ""`, validasi 3 kolom, INSERT dari form, `header("Location")` + `exit`, tampilkan error, isi ulang form, `htmlspecialchars` di semua output |

Cek otomatis `cek-10.php`: 12 PASS (termasuk tes validasi ditolak + tes anti-XSS).
Progres: 6 PASS/6 FAIL -> 12 PASS setelah 2 perbaikan.

### Yang dibenerin hari ini
1. `int($x)` -> `(int)$x` (PHP tidak punya function `int`; cast itu `(int)` atau `intval()`)
2. `<?php htmlspecialchars($x);?>` -> `<?= htmlspecialchars($x) ?>` (kurang `echo`, jadi atribut value selalu kosong)
3. `CREATE TABLE` yang tidak perlu di file form (duplikasi skema)

### Pertanyaan Zahab yang dijawab (ada di TANYA-JAWAB.md)
1. Kenapa `value` harus diisi `$inputNama` dan gimana cara bacanya
2. `CREATE TABLE IF NOT EXISTS` di file form perlu atau tidak
3. Arti `VALUES (?,?,?)`
4. Arti `: void`, `: array`, dan return type kosong

## MATERI SIAP UNTUK SESI BERIKUTNYA (disiapkan 19 Sep malam)
Sesi 007 sudah lengkap dan sudah diuji:
- Materi `sesi/007-update-delete.md` (worked example lengkap versi buku)
- Kerangka `latihan/11-edit.php` (Tugas 11) dan `latihan/12-hapus.php` (Tugas 12)
- Pengecekan `cek-11.php` (10 poin) dan `cek-12.php` (9 poin), pakai driver `cek-driver.php`
- Hasil uji: jawaban benar -> 11: 10 PASS, 12: 9 PASS. Kerangka kosong -> 11: 6 PASS/4 FAIL, 12: 4 PASS/5 FAIL.

## BERIKUTNYA
1. **Sesi 007 - Update & Delete**: form HTML + `$_POST` + validasi input + INSERT ke database + redirect setelah simpan (biar refresh tidak double-submit). Di akhir sesi ini Zahab sudah punya aplikasi CRUD yang bisa dipakai
2. Setelah itu: update + hapus data, lalu validasi lebih ketat, baru masuk Laravel
