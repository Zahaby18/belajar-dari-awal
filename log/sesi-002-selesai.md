# SESI 002 - SELESAI (12 Sep 2026)
Commit terakhir: `f414210` - "fixing 03-stokRendah.php dan kerjain 04-produkMahal.php"

## HASIL AKHIR
| Tugas | Status | Verifikasi |
|---|---|---|
| 1. hitungTotal (akumulator angka) | LULUS | output `33000`, cocok target |
| 2. formatRupiah (format teks) | LULUS | output `Rp1.500.000,-`, cocok target |
| 3. stokRendah (filter, array of array) | LULUS | output `2 / Teh Hijau - 3 / Cokelat Bubuk - 0`, cocok target |
| 4. produkMahal (variasi mandiri, TANPA contoh) | LULUS | output `2 / Kopi Arabica - 85000 / Cokelat Bubuk - 62000`, cocok target |

**Tugas 4 adalah bukti terpenting:** dikerjakan sendiri, pola sama tapi pertanyaan beda, tanpa contoh, dan langsung benar di percobaan pertama. Itu namanya transfer, bukan hafalan.

## PERJALANAN SESI INI (9 iterasi)
Dari "nggak bisa apa-apa tanpa AI" jadi bisa:
1. titik koma hilang -> parse error
2. `/n` vs `\n` -> escape character
3. hasil hitungan dibuang -> silent bug
4. hasil di-return sebelum diproses
5. 2 tugas digabung dalam 1 function -> single responsibility
6. `Rp.` vs `Rp ` vs `Rp` -> spesifikasi vs selera
7. membandingkan rak dengan angka -> tipe data
8. echo array -> "Array to string conversion"
9. LULUS berturut-turut untuk 03 dan 04

Catatan mentor: errornya makin halus dari waktu ke waktu. Ini indikator paling jujur bahwa levelnya naik.

## PERUBAHAN ATURAN (koreksi dari Zahab)
Zahab protes: "gue belum tau cara nulisnya, cuma bisa tau konsep, lu udah nyuruh ngoding."
Dia benar. Aturan lama (mentee nulis dulu tanpa contoh) kekerasan untuk pemula syntax 0.
Aturan baru: tangga 3 tingkat (contoh lengkap -> nulis sendiri -> variasi). Sudah ditulis di `00-CARA-KERJA.md`.

## PROGRES KURIKULUM
- Level 0 fundamental: PHP dasar (variable, array, function, loop) -> **SELESAI**
- Yang belum di Level 0: terminal/Linux CLI, Git lanjutan, HTTP/REST, SQL, JavaScript, HTML/CSS
- Berikutnya: Sesi 003 - `cariProduk` (early return + null) & `tampilkanTabel` (str_pad + void). Materi + kerangka + target sudah disiapkan: `sesi/003-cari-dan-tampilkan.md`, `latihan/05-cariProduk.php`, `latihan/06-tampilkanTabel.php`
- Setelah 003: masuk database (PDO/SQL) -> ini pintu menuju Laravel
