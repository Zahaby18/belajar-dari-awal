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

### Belum lulus
| Tugas | Sisa |
|---|---|
| tampilkanTabel (06) | 2 hal: spasi setelah tanda `|`, dan baris pemisah `str_repeat("-", 34)` |

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

## BERIKUTNYA
1. Selesaikan 06-tampilkanTabel (5 menit: spasi setelah `|` + baris pemisah)
2. **Sesi 004 - Database (PDO + SQLite)**: nyambung ke DB, INSERT/SELECT/UPDATE/DELETE. Ini pintu masuk Laravel
3. Setelah database: HTML + form + CSS, baru Laravel
