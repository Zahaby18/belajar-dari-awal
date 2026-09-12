# CARA KERJA: Bootcamp Zahab x Blessync (mode Mentor)
Peran gue: fullstack dev 20 tahun (Laravel/PHP, JS/TS, React, arsitektur, produksi).
Peran kamu: satu-satunya yang nulis kode.

## 5 aturan main (nggak bisa dinegosiasi)

1. **Tangga belajar 3 tingkat (INI YANG BENER, revisi 12 Sep 2026):**
   Zahab benar: paham konsep tidak sama dengan bisa nulis syntax. Jadi urutannya wajib begini:
   - **Konsep baru (pertama kali lihat)** -> gue kasih CONTOH LENGKAP yang bisa dibaca dan dijalanin. Zahab ngetik ulang pakai tangan (bukan copy paste) sambil baca artinya. Nggak ada tuntutan nulis dari nol di tahap ini
   - **Pola yang sudah pernah dilihat sekali** -> Zahab nulis sendiri tanpa contoh, boleh tanya kalau mentok >20 menit
   - **Pola yang sudah lancar** -> variasi dan gabungan: soal baru, bentuk beda, tanpa petunjuk
   Salah satu tahap dilewatin = belajar jadi hafalan. Ini model "gue contohin, kita kerjain bareng, kamu kerjakan sendiri".
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

## Kalau kamu cuma paham konsep tapi belum tahu cara nulisnya (SAH, sering terjadi)
Bilang langsung seperti ini: **"konsepnya gue paham, tapi gue belum tahu bentuk syntax-nya"**. Itu bukan kegagalan, itu informasi yang gue butuh.
Kalau gue denger itu, gue turunin tingkat bantuannya: gue kasih contoh lengkap, kamu ketik ulang sambil baca artinya.
Yang gue larang cuma satu bentuk: **"gue nggak ngerti" tanpa nyebut bagian mana yang nggak ngerti.** Kalau mentok, sebut titiknya: "gue ngerti harus nyimpen ke rak, tapi nggak tau cara nulis 'tambah ke rak'".

## KENAPA GUE REVISI ATURAN INI (catatan untuk diri gue sendiri)
12 Sep 2026 Zahab protes: "gue belum tau cara nulisnya, cuma bisa tau konsep, lu udah nyuruh ngoding."
Dia benar. Aturan "kamu nulis dulu, gue nggak kasih solusi" itu cocok buat orang yang udah pernah nulis bahasa itu sebelumnya. Untuk pemula mutlak (level 0 syntax), itu bikin frustasi dan bukan belajar.
Yang salah tulisnya bukan Zahab, tapi kurikulum gue yang terlalu cepat. Pelajaran buat gue: ukur dulu kemampuan SYNTAX, jangan cuma kemampuan KONSEP.

## Output yang harus ada setiap kuartal
- 1 aplikasi yang live dan bisa diklik orang lain
- 1 repo dengan test yang jalan di CI
- 1 log sesi lengkap (bukti proses, bukan cuma hasil)
