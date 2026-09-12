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

---

## Iterasi 4 - commit `3203aef` / `f7b71b7` -> TUGAS 1 LULUS
**Hasil run:** `60000` lalu `33000` -> BENAR, target tercapai.

```php
return $hasil + ($hasil * $pajak / 100);
```
Pilihan yang bagus: langsung dihitung saat diserahkan, jadi nggak butuh baris assign terpisah. Dua-duanya sah, kamu pilih versi yang lebih ringkas.

### Catatan gaya (bukan error, biar jadi kebiasaan)
1. Format PSR-12: `function hitungTotal(array $harga, float $pajak) : float{` -> seharusnya `float $pajak): float {`
2. Nama `$pajak` masih ambigu: itu nominal rupiah atau persen? Di materi ditulis `$pajakPersen`. Nama yang ambigu adalah sumber bug di tim, jadi biasakan yang spesifik
3. `$hasil = $hasil + $a;` bisa disingkat `$hasil += $a;` (shortcut ini dipakai di hampir semua kode PHP profesional). Fungsinya identik
4. `echo hitungTotal(...)` tambahkan `"\n"` di akhir biar output nggak nempel dengan baris terminal
5. Komentar `// Tugas 1` sebaiknya diganti penjelasan nyata, misal `// jumlahkan harga, lalu tambah pajak persen`. Komentar menjelaskan KENAPA/Apa, bukan nomor tugas

### Progres
- TUGAS 1 `hitungTotal`: LULUS
- Berikutnya: TUGAS 2 `formatRupiah`

---

## Iterasi 5 - commit `5384610` -> TUGAS 2 BELUM LULUS
**Hasil run:**
```
60000          <- hitungJumlah, benar
33000          <- hitungTotal, benar
1.500.000      <- tes number_format, BENAR (langkah 1-2 materi berhasil)
Rp.8.000       <- function baru kamu, BELUM sesuai target
```

### Yang BENAR
1. `number_format(1500000, 0, ",", ".")` -> kamu jalankan dan hasilnya `1.500.000`. Konsepnya sudah kamu dapat, ini bagian tersulitnya
2. Format PSR-12 di `hitungTotal` sudah dibenerin (`): float{`)
3. Sudah run, sudah lihat output

### Kenapa belum lulus: spesifikasi tugas tidak dipenuhi
Yang diminta di materi:
```php
formatRupiah(float $angka): string
// formatRupiah(1500000) -> "Rp1.500.000,-"
```
Tugasnya: **terima SATU angka, ubah jadi teks rupiah.** Itu saja.

Yang kamu bikin:
```php
function tambahTambahan(array $angka){
    ...menjumlahkan array...
    return "Rp." . number_format($jumlah, 0, ",", ".");
}
```
Function ini melakukan **DUA tugas sekaligus**: menjumlahkan rak angka DAN memformat. Masalahnya bukan "salah", tapi design-nya bikin repot nanti:
- Besok kamu butuh menampilkan harga satu produk (`Rp85.000`). Function kamu nggak bisa dipakai, karena dia butuh rak angka dan selalu menjumlahkan
- Akibatnya kamu bakal bikin function kedua, ketiga, keempat yang isinya number_format lagi -> duplikasi
- Aturan yang dipakai di industri: **satu function, satu tugas.** Kalau deskripsinya butuh kata "dan", itu tandanya harus dipecah
- Bonus: menjumlahkan itu tugas `hitungJumlah` yang sudah kamu punya. Jangan ditulis ulang

### Kesalahan format output
```
target : R p 1 . 5 0 0 . 0 0 0 , -
kamu   : R p . 8 . 0 0 0
```
3 bedanya:
1. Ada titik setelah `Rp`. Harus menempel: `"Rp"`
2. Kurang `",-"` di belakang
3. Angkanya beda, karena kamu tes pakai `[3000,5000]` bukan `1500000`

### Catatan tambahan
4. Return type `: string` belum ada. Kalau function mengembalikan teks, tulis `: string`. Gunanya: PHP jadi bisa nangkap kalau kamu tidak sengaja mengembalikan angka
5. Nama `tambahTambahan` tidak menjelaskan apa-apa (dan artinya berulang: "tambah tambahan"). Nama function yang benar bisa dibaca seperti kalimat perintah: `formatRupiah`, `hitungTotal`, `stokRendah`
6. Git bilang "No newline at end of file". Biasakan file diakhiri baris kosong. Sepele, tapi bikin diff git lebih bersih

### Yang harus dikerjakan
1. Ganti `tambahTambahan` jadi `formatRupiah(float $angka): string`, parameter tunggal, tanpa loop, tanpa penjumlahan
2. Isinya: `return "Rp" . number_format(...) . ",-";` (perhatikan: `Rp` menempel, ada `,-` di belakang)
3. Test: `echo formatRupiah(1500000) . "\n";` -> harus `Rp1.500.000,-`
4. Test kedua: `echo formatRupiah(85000) . "\n";` -> harus `Rp85.000,-`
5. Bandingkan karakter per karakter dengan target, baru commit + push

---

## Iterasi 6 - commit `074b094` -> TUGAS 2 HAMPIR LULUS (95%)
**Hasil run:**
```
60000
33000
1.500.000
Rp.15.000,-Rp.85.000,-
```

### Yang BENAR (ini poin penting)
1. Function sudah jadi `formatRupiah(float $angka): string` -> parameter tunggal, tanpa loop, tanpa penjumlahan. Spesifikasi dipenuhi. **Konsep "satu function satu tugas" sudah kamu terapkan**
2. `number_format($angka, 0, ",", ".")` -> 3 argumennya tepat semua
3. Output sudah punya `,-` di belakang (kemarin nggak ada)

### TINGGAL 1 KARAKTER: titik setelah Rp
```php
return "Rp." . number_format($angka, 0, ",", ".") . ",-";
//         ^ titik ini harus dihapus
```
Perbandingan karakter per karakter:
```
target : R p 1 . 5 0 0 . 0 0 0 , -
kamu   : R p . 1 5 . 0 0 0 , -
```
Jawaban: hapus titik di `"Rp."` menjadi `"Rp"`.

### Dua hal lain
1. Tes pakai `15000`, target di materi `1500000`. Tidak masalah besar (logika sama), tapi pakai angka target biar bisa dibandingkan langsung
2. Dua `echo` nggak ada `"\n"`, jadi outputnya nempel jadi satu baris. Tambah `"\n"` di akhir tiap echo

### ALAT BARU: file target output
Dibuat `latihan/expected/02-functions.txt` yang isinya output yang seharusnya keluar, dan cara bandinginnya didokumentasikan di `PANDUAN-RUN-PHP.md`.

Ini menjawab masalah yang muncul 3 kali berturut-turut: kamu run, tapi nggak membandingkan hasil dengan target. Jadi sekarang perbandingannya mekanis:
```
php latihan/02-functions.php > hasil.txt
fc hasil.txt latihan\expected\02-functions.txt
```
`fc` bilang "no differences" = lulus. Beda 1 spasi pun kelihatan.

### Temuan mentor: pola yang harus diubah
3 iterasi terakhir menunjukkan pola sama: syntax kamu makin cepat benar, tapi kamu berhenti setelah "tidak ada error". Standar yang gue mau kamu pegang: **selesai itu ketika output sama persis dengan target**, bukan ketika programnya jalan.

### Yang harus dikerjakan
1. Hapus titik di `"Rp."`
2. Ganti tes jadi `formatRupiah(1500000)` dan `formatRupiah(85000)`, kasih `"\n"`
3. Jalankan `fc`/`diff` vs `latihan/expected/02-functions.txt` sampai "no differences"
4. Baru commit + push
