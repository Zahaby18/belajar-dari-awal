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
