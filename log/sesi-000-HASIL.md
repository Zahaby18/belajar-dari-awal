# HASIL DIAGNOSTIK SESI 000
Tanggal: 10 Sep 2026

## Skor per bagian

| Bagian | Skor | Catatan mentor |
|---|---|---|
| A. Konsep (1-12) | **2.5 / 12** | Vocabulary web dasar belum ada. Ini wajar, bukan masalah karakter. |
| B. Baca kode (13-14) | **1 / 4** | No.13 arahnya BENAR (dia tahu itu ambil semua lalu loop). No.14 cuma nebak. |
| C. Praktik (15) | **0 / 10** | Belum bisa nulis PHP tanpa AI. Ini temuan terpenting. |

**Total: 3.5 / 26 -> LEVEL 0 MURNI**

## Klasifikasi jujur
Kamu **bukan lagi programmer, kamu operator WordPress.** Kemampuan yang tersisa:
- Bisa BACA struktur kode (no.13 bukti kuat: kamu tahu `all()` ambil semua, `foreach` loop)
- Bisa pasang, konfigurasi, deploy, dan jalankan produk
- Belum bisa MENULIS logika dari nol

Bedanya krusial: orang yang bisa baca + konfigurasi bisa jalanin bisnis. Orang yang bisa nulis bisa dibayar sebagai developer. Kamu di titik pindah dari yang pertama ke yang kedua.

## Yang bikin gue optimis
Kamu jawab jujur 8 kali "gatau" tanpa satu pun nge-bluff. Itu **kualitas mentee paling penting**. Orang yang nge-bluff di diagnosa akan dapat kurikulum yang salah dan buang 6 bulan. Kamu nggak.

## Koreksi jawaban (baca, jangan dihafal)
1. GET = ambil data. POST = kirim data BARU. PUT/PATCH = ubah data yang SUDAH ADA. (kamu benar di GET dan PUT)
2. 401 = belum login / identitas nggak dikenali. 403 = sudah login tapi NGGAK PUNYA HAK. 404 = halaman nggak ada. Jawaban kamu nyampur sama 404.
3. Cookie = data kecil disimpan di BROWSER kamu, dikirim ke server tiap request. Session = data disimpan di SERVER, browser cuma pegang ID-nya. Cookie bukan cache.
4. INNER JOIN = cuma baris yang ada di KEDUA tabel. LEFT JOIN = semua baris tabel kiri, yang nggak punya pasangan jadi NULL.
5. Index = "daftar isi" tabel. Bikin SELECT cepat, bikin INSERT/UPDATE lebih lambat karena index harus ikut diupdate. Tabel yang sering ditulis dan jarang dibaca = jangan banyak index.
6. `==` bandingin nilai saja (longgar, "1" == 1 itu TRUE). `===` bandingin nilai + TIPE. Pakai `===` selalu, kecuali ada alasan kuat.
7. Class = cetakan yang menggabungkan DATA + CARA NGOLAH datanya. Function biasa = resep lepas, nggak bawa data. Di WP kamu ketemu `WP_Query` (class) tapi nggak nulis sendiri.
8. Interface = kontrak. "Siapa pun yang mau jadi X, wajib punya method ini." Dipakai supaya kode nggak terikat ke satu implementasi (bisa tukar database, payment, dll tanpa nulis ulang).
9. Merge = gabung dua branch, bikin commit gabungan, riwayat bercabang. Rebase = pindahin commit kamu ke atas branch lain, riwayat jadi RAPI satu garis. Rebase lebih bersih, merge lebih aman.
10. Jawaban kamu "commit ulang" sebenarnya arahnya benar. Praktiknya: rename file -> `git add -A` -> commit lagi (atau `git commit --amend` kalau belum dipush). Tapi kamu harus tahu `git status` dulu buat lihat apa yang berubah.
11. `var` = kuno, fungsi-scope, bocor dari loop. `let` = bisa diubah, blok-scope. `const` = nggak bisa di-reassign. Masalah `let` di loop: kalau bikin function/menu callback di dalam loop, semua callback bisa menangkap nilai terakhir (classic JS gotcha).
12. REST API = cara aplikasi ngobrol lewat HTTP pakai URL + method. Contoh: `GET /api/products` untuk daftar produk, `GET /api/products/12` untuk satu produk.
13. **APA YANG KURANG:** `all()` = 1 query. Lalu tiap loop, `$user->orders` = 1 query BARU ke database. 100 user = **101 query**. Ini namanya N+1 problem, penyebab nomor 1 aplikasi Laravel lambat. Fix: `User::with('orders')->get()` = 2 query. Kemampuan MENDETEKSI ini yang bikin kamu beda dari kandidat lain.
14. Masalahnya: (a) `==` longgar — `$a == "0"` benar untuk `0`, `0.0`, `false`, `null`, string kosong (tergantung versi PHP); (b) nggak ada type declaration; (c) `?? false` di `$b` nyembunyiin error kalau `$b` nggak dikirim; (d) nama function `cek` nggak jelas; (e) nggak ada `declare(strict_types=1)`.

## KEPUTUSAN
Level 0 gate GAGAL (CRUD PHP murni belum bisa). Maka:
**Mulai dari Fundamental PHP. Laravel ditunda sampai 4 sesi fondasi kelar.**
Kalau tetap maksa Laravel sekarang, 2 bulan lagi kamu akan bisa paste kode tapi nggak bisa benerin kalau error. Itu bukan jago, itu nge-bluff.
