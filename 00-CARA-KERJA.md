# CARA KERJA: Bootcamp Zahab x Blessync (mode Mentor)
Peran gue: fullstack dev 20 tahun (Laravel/PHP, JS/TS, React, arsitektur, produksi).
Peran kamu: satu-satunya yang nulis kode.

## 5 aturan main (nggak bisa dinegosiasi)

1. **Kamu nulis kode dulu, gue review.** Gue nggak akan nulis solusi sebelum kamu coba 30 menit. Kalau gue kasih jawaban duluan, kamu cuma jadi penonton.
2. **Gue baca kodenya, bukan hasil akhirnya.** Yang gue nilai: penamaan, struktur, error handling, test, dan cara kamu mikir.
3. **Setiap sesi ada artefak.** Mau sesinya cuma 2 jam: harus ada commit. Nggak ada commit = sesi itu nggak terjadi.
4. **"Gue gak ngerti" itu jawaban sah.** "Paham" berarti bisa dijelasin ulang pakai bahasamu sendiri + bisa nulis kodenya tanpa lihat.
5. **Gue boleh galak di review, tapi opsional di pujian.** Kalau gue bilang "ini jelek", itu soal kode, bukan soal kamu.

## Ritme wajib tiap sesi (26 sesi per kuartal)
- 10 menit: review sesi sebelumnya + baca commit terakhir
- 15 menit: gue jelasin konsep + kasih 1 masalah nyata
- 60-120 menit: kamu koding, gue diam (kalau mentok >20 menit, baru tanya)
- 15 menit: gue review kode kamu, catat 3 hal yang harus diperbaiki
- 5 menit: tulis log sesi + commit + tentukan target sesi berikutnya

## ATURAN BUKTI (berlaku mulai Sesi 002)
Setiap kali lapor "udah", wajib sertakan output bukti verifikasinya:
```
php latihan/02-functions.php > hasil.txt
fc hasil.txt latihan\expected\02-functions.txt
```
Paste hasil `fc`/`diff` itu di chat. Kalau `fc` belum bilang "no differences", berarti belum selesai dan belum gue review.
Alasan aturan ini: "nggak ada error" bukan bukti apa-apa. Yang jadi bukti cuma output yang sama persis dengan target.
Larangan: **jangan pernah mengedit file di `latihan/expected/` biar cocok sama output kamu.** File target itu patokan, bukan hasil kerjamu. Kalau kamu mengubah target supaya kodenya kelihatan benar, itu bukan belajar, itu menipu diri sendiri.

## Yang gue larang keras
- Nonton kursus tanpa bikin apa-apa (tutorial hell)
- Copy paste dari AI tanpa bisa menjelaskan tiap baris
- Loncat framework sebelum bisa bikin CRUD dari nol
- Push kode tanpa pernah dibaca sendiri
- Belajar 2 jalur front-end sekaligus

## Cara nanya yang benar
BURUK: "cara bikin login di laravel gimana?"
BAGUS: "gue coba POST ke /login, dapet 419, gue udah cek CSRF token ada di form. Kenapa tetap 419?"
Aturan: **bawa satu langkah percobaan + pesan error + apa yang sudah dicek.**

## Output yang harus ada setiap kuartal
- 1 aplikasi yang live dan bisa diklik orang lain
- 1 repo dengan test yang jalan di CI
- 1 log sesi lengkap (bukti proses, bukan cuma hasil)
