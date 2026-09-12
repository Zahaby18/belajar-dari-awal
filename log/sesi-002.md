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

---

## Iterasi 3 - commit `875f006`, file baru `latihan/02-functions.php`
**Yang dikerjakan:** TUGAS 1 `hitungTotal`
**Hasil run:** `30000` -> BELUM sesuai target (harusnya `33000`)

### Yang BENAR
- Pola akumulator (`$hasil = 0;` lalu `foreach` lalu `$hasil = $hasil + $a;`) -> PERSIS BENAR. Ini pola inti yang gue mau kamu kuasai, dan kamu langsung kena di percobaan pertama
- File baru, nama function, parameter `array $harga` dan `: float` -> semua benar
- Sudah RUN sendiri sebelum push -> kebiasaan mulai terbentuk

### BUG 1: hasil hitungan dibuang (baris 22)
```php
$hasil + ($hasil * $pajak / 100);   // <- hasilnya dihitung, lalu DIBUANG
```
Baris ini PHP hitung, terus dilempar ke tempat sampah. Nggak ada yang menyimpan.
Analogi: kamu masak, masakannya matang, lalu kamu buang ke tempat sampah dan cuma ngeliatin pancinya.
Yang bener: simpan ke wadah, atau langsung diserahkan:
```php
$hasil = $hasil + ($hasil * $pajak / 100);   // cara 1: simpan

return $hasil + ($hasil * $pajak / 100);      // cara 2: langsung serahkan
```
Ini bug yang tidak munculin error sama sekali. PHP nggak ngeluh, program tetap jalan, hasilnya cuma salah. Termasuk kategori paling berbahaya: **silent bug**.

### BUG 2: yang di-return masih nilai sebelum pajak
```php
return $hasil;    // <- ini nilai hasil penjumlahan saja, belum kena pajak
```
Itulah kenapa outputnya `30000`, bukan `33000`.

### CATATAN 3: tes pakai angka yang salah
```php
echo hitungTotal([10000,20000],100);   // 100 itu 100%, bukan 10%
```
Target di materi: `hitungTotal([10000, 20000], 10)` = `33000`.
Kalau pakai 100% dan kodenya benar, hasilnya jadi 60000. Pas tes, pakai angka yang ada targetnya di materi, biar kamu bisa bandingin hasil vs harapan.

### PELAJARAN INTI ITERASI INI
"Ada output" bukan berarti "output sudah benar". Setelah run, WAJIB bandingkan angkanya dengan target di materi:
- target `33000`, hasil `30000` -> berarti ada yang kurang, dan itu jawabannya ada di kode sendiri

### Yang harus dikerjakan
1. Baris 22: simpan hasilnya (`$hasil = ...`) ATAU gabung langsung ke `return`
2. Ganti tes jadi `hitungTotal([10000, 20000], 10)`
3. Run, pastikan keluar `33000`
4. Commit + push
