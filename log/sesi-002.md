# LOG SESI 002 (mulai 12 Sep 2026)

## Iterasi 1 - commit `fad5eec`
**Yang dikerjakan:** benerin output TUGAS 5 biar satu per baris
**Hasil run:** `apel/njeruk/nmangga/n` -> BELUM BENAR

### Temuan: `/n` vs `\n`
Kamu tulis:
```php
echo $i . "/n";
```
Harusnya:
```php
echo $i . "\n";
```
Beda 1 karakter: `/` (slash) vs `\` (backslash). Yang pertama cuma teks biasa, yang kedua karakter pindah baris.

### Kenapa ini penting (konsep baru: escape character)
`\` (backslash) di dalam tanda kutip punya arti khusus: "karakter setelah gue ini bukan teks biasa, tapi perintah khusus". Contoh:
- `\n` = pindah baris
- `\t` = tab
- `\"` = tanda kutip yang dicetak apa adanya (bukan penutup teks)
- `\\` = satu backslash
Kalau kamu pakai `/`, PHP anggap itu tulisan biasa, jadi ikut tercetak.

### Pelajaran lebih besar: "jalan tanpa error" bukan berarti "benar"
Programnya exit code 0, tidak ada error apa pun. Tapi outputnya salah.
Kebiasaan yang harus dibangun: bukan cuma run, tapi **BACA output dan bandingkan dengan yang diharapkan**.
Sebelum commit, tanya diri sendiri: "output ini persis seperti yang gue mau nggak?" Program yang jalan tapi hasilnya salah itu lebih berbahaya daripada program yang error, karena nggak ada yang nyuruh kamu curiga.

### Yang harus dilakukan
1. Ganti `/n` jadi `\n` di TUGAS 5
2. Run dan BACA output: apel, jeruk, mangga harus bertumpuk ke bawah (bukan satu baris nempel)
3. Commit + push
4. Baru lanjut Sesi 002

### Catatan mentor
Ini kesalahan tipe yang bikin orang tertawa di kantor, dan semua dev pernah mengalaminya. Yang bikin beda: dev yang jalanin kodenya lalu baca output akan ketemu sendiri dalam 5 detik. Dev yang asal push akan ketemu di depan klien.

---

## Iterasi 2 - commit `da73e8e` + merge `71d0f04`
**Yang dikerjakan:** ganti `/n` jadi `\n` di baris 42
**Hasil run:** BENAR
```
=== TUGAS 5: array + foreach ===
apel
jeruk
mangga
```
exit code 0. Sesi 001 resmi 100% selesai.

### Bonus: kamu mengalami merge pertama
Commit `71d0f04` judulnya "betulin line 42 dan abis pull", dan itu **merge commit** (2 parent: da73e8e + 508b39c).
Artinya yang terjadi: kamu `git push`, ditolak karena gue udah push duluan, kamu `git pull`, git gabungkan otomatis, terus push lagi. Sukses.
Ini kejadian normal dalam kerja tim, bukan error. Di kantor, ini terjadi puluhan kali seminggu. Sekarang kamu udah pernah ngalamin, jadi tahun depan kalau ada orang baru panik karena "rejected", kamu bisa bantu.

### Status
- TUGAS 5: LULUS
- Sesi 001: LULUS semua
- Berikutnya: Sesi 002 TUGAS 1 (`hitungTotal`)
