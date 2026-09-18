# PANDUAN RUN PHP (Windows)
Cara cek kode kamu jalan atau nggak. Ini kebiasaan yang wajib: **run dulu, baru commit.**

## Cara paling gampang: terminal di dalam VS Code
1. Buka VS Code di folder `belajar-dari-awal`
2. Tekan **Ctrl + `** (tombol backtick, di bawah Esc, sebelah kiri angka 1) -> terminal muncul di bawah
3. Ketik:
```
php latihan/00-mulai.php
```
4. Enter. Outputnya muncul di bawah

Kalau cuma mau run command yang barusan: tekan **panah atas** lalu Enter. Nggak perlu ketik ulang.

## Perintah yang wajib kamu hafal

**1. Jalanin file**
```
php latihan/00-mulai.php
```

**2. Cek syntax saja (nggak menjalankan kodenya)**
```
php -l latihan/00-mulai.php
```
Muncul `No syntax errors detected` = titik koma, kurung, dan tanda kutip kamu lengkap.
Muncul `Parse error ... on line 55` = ada yang salah di syntax, lihat baris SEBELUM nomor itu.
Kegunaan: cara cepat tahu error-nya syntax (typo) atau logika (cara mikir).

**3. Lihat versi PHP**
```
php -v
```

## Cara baca output yang benar
Setelah run, jawab 3 pertanyaan ini:
1. Ada pesan `error` atau `Warning` nggak? -> kalau ada, baca dulu, jangan diabaikan
2. Outputnya **persis** seperti yang gue mau nggak? (bukan cuma "ada output")
3. Kalau aku jelasin output ini ke orang, aku bisa nggak?

**Program yang nggak error bukan berarti benar.** Contoh nyata: kode kamu kemarin exit code 0 (tanpa error) tapi outputnya `apel/njeruk/nmangga/n` - salah, dan cuma ketahuan kalau dibaca.

## Kalau ada masalah

**`php : The term 'php' is not recognized`**
Terminalnya belum tahu PHP ada di mana. Solusi:
- Tutup terminal, buka VS Code baru (kadang perlu restart setelah install)
- Pastikan folder PHP sudah masuk PATH Windows (System Properties -> Environment Variables -> Path -> tambah folder PHP kamu)

**`Could not open input file: latihan/00-mulai.php`**
Artinya file-nya nggak ketemu. Penyebab biasanya:
- Terminal kamu lagi nggak di folder repo (cek: ketik `dir`, harus kelihatan folder `latihan`)
- Salah ketik nama file (pakai Tab buat autocomplete: ketik `php latihan/0` lalu tekan **Tab**)

**Parse error / syntax error**
Biasanya titik koma hilang. Lihat baris SEBELUM baris yang disebut PHP.

**Warning: Undefined variable $total**
Artinya kamu pakai `$total` padahal belum pernah diisi. Bikin dulu: `$total = 0;`

**Nggak ada output sama sekali (tapi nggak error)**
Cek: file-nya udah ada `echo`/`var_dump` nggak? Kalau isinya cuma function definitions tanpa dipanggil, memang nggak ada yang jalan. Function itu mesin, dia baru hidup kalau kamu panggil.

## Definisi "kode selesai" (mulai sekarang)
Kode selesai bukan kalau udah ditulis. Kode selesai kalau:
1. Udah di-run
2. Output-nya dibaca dan sesuai harapan
3. Baru di-commit

---

## CARA BANDINGIN OUTPUT DENGAN TARGET (wajib, biar nggak "kira-kira benar")
Setiap latihan punya file target output di folder `latihan/expected/`. Contoh: `latihan/expected/02-functions.txt`.
Isinya output yang SEHARUSNYA keluar, baris per baris.

**Cara PALING GAMPANG (kamu sudah punya git, jadi ini pasti jalan):**
```
php latihan/07-db-setup.php > hasil7.txt
git diff --no-index hasil7.txt latihan/expected/07-db-setup.txt
```
- `> hasil7.txt` = simpan output ke file, bukan cuma tampil di layar
- `git diff --no-index` = bandingkan 2 file
- **Kalau nggak muncul apa-apa, artinya COCOK SEMPURNA** (git cuma ngomong kalau ada beda)

**Kalau kamu di Command Prompt (cmd):**
```
fc.exe hasil7.txt latihan\expected\07-db-setup.txt
```
Perhatiin: `fc.exe`, pakai `.exe`.

**JANGAN pakai `fc` doang kalau kamu di PowerShell.** Di PowerShell, `fc` itu singkatan dari `Format-Custom`, bukan file compare. Itu sebabnya error. Kalau di PowerShell, pakai salah satu dari ini:
```
Compare-Object (Get-Content hasil7.txt) (Get-Content latihan\expected\07-db-setup.txt)
```
atau lebih enak, pakai git yang di atas.

**Kalau beda, outputnya nunjukin baris mana yang beda:**
```
< Rp.15.000,-          <- tanda < artinya isi file KAMU
> Rp1.500.000,-        <- tanda > artinya isi file TARGET
```
Tanda `<` = punyamu, `>` = target. Baca per karakter. Contoh di atas: ada titik setelah `Rp` yang seharusnya nggak ada.

**Kalau semua cara di atas tetap bikin ribet**, cara terakhir yang tetap sah: paste output hasil run kamu ke chat, gue yang bandingin. Tapi saran gue tetap pakai `git diff --no-index`, karena itu yang bikin kamu bisa nemu kesalahan sendiri dalam 5 detik.

`hasil*.txt` udah masuk `.gitignore`, jadi nggak akan ke-commit.

**Kenapa ini penting:** mata manusia itu payah membandingkan teks panjang. Alat pembanding nggak pernah salah dan nggak pernah lupa. Programmer profesional pakai alat ini setiap hari, bukan ngandelin feeling.
