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

## BERIKUTNYA
1. **Sesi 005 - Halaman web pertama (HTML + form + browser)**: hasil kerja Zahab akhirnya kelihatan di browser, bukan cuma teks terminal
2. Setelah itu: validasi input + XSS, baru masuk Laravel
