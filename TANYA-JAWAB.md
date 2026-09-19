# TANYA JAWAB
Catatan pertanyaan Zahab + jawabannya. Biar nggak perlu tanya dua kali.

---

## 19 Sep 2026 - 4 pertanyaan setelah Tugas 10

### T1. `value="<?= htmlspecialchars($inputNama) ?>"` — kenapa harus ada `$inputNama`? Gimana cara bacanya?

**Fungsi atribut `value`:** menentukan isi awal yang muncul di dalam kotak input.

**Kenapa pakai `$inputNama`, bukan kosong?** Supaya kotak itu mengingat apa yang barusan diketik user. Ini alurnya:

| Tahap | Yang terjadi | Isi kotak input |
|---|---|---|
| 1. Halaman pertama dibuka (GET) | `$inputNama = ""` | kosong |
| 2. User ketik "Kopi" lalu klik Simpan | browser kirim POST, `$_POST["nama"] = "Kopi"` | (halaman berproses) |
| 3. Kode kamu jalan: `$inputNama = trim($_POST["nama"] ?? "")` | `$inputNama` jadi "Kopi" | - |
| 4a. Validasi GAGAL | halaman digambar ulang, `value` mencetak `$inputNama` | **"Kopi" masih ada** -> user nggak perlu ngetik ulang |
| 4b. Validasi LOLOS | `header("Location: ...")` -> halaman dibuka lagi sebagai GET | kosong lagi (memang yang kita mau) |

**Cara baca potongannya:**
```
value="                <?=              htmlspecialchars($inputNama)
   ^ atribut HTML      ^ singkatan dari  ^ teks yang dicetak, dibungkus
     penentu isi kotak   <?php echo        htmlspecialchars() biar aman
```
- `<?= $x ?>` sama artinya dengan `<?php echo $x; ?>` (versi ringkas, sering dipakai di HTML)
- Titik koma di akhir **nggak perlu** kalau pakai `<?=`. Jadi `<?= htmlspecialchars($x) ?>` itu sudah benar

**Kenapa tidak langsung `$_POST["nama"]`?** Karena saat halaman pertama kali dibuka (GET), `$_POST` itu kosong. Kalau kamu akses `$_POST["nama"]` di kondisi itu, PHP ngeluarin `Warning: Undefined array key`. `$inputNama` selalu punya nilai (di-set `""` di atas), jadi aman di dua kondisi.

**Kenapa wajib `htmlspecialchars`?** Kalau user mengetik `"><script>alert(1)</script>` di kolom nama, tanpa escape teks itu bakal "keluar" dari atribut `value` dan jadi tag HTML yang dieksekusi browser. `htmlspecialchars()` mengubah `<` jadi `&lt;` sehingga tetap dianggap teks. Ini XSS, dan kolom input itu salah satu pintu masuknya.

---

### T2. `CREATE TABLE IF NOT EXISTS produk (...)` di `10-form.php` — perlu apa nggak?

**Nggak perlu. Sebaiknya dihapus.** Tiga alasan:

1. **Tabel sudah dibuat di `07-db-setup.php`.** Satu hal dikerjakan satu tempat.
2. **Bahaya nyata: dua sumber kebenaran.** Misal besok kamu tambah kolom `deskripsi`. Kamu ubah di `07`. Tapi di `10` masih versi lama. Kalau database belum ada dan yang jalan `10` dulu, tabelnya dibikin versi lama (tanpa `deskripsi`), dan aplikasimu error dengan sebab yang bikin bingung. Ini namanya **duplikasi skema**.
3. **Satu file, satu tugas.** File `10-form.php` tugasnya mengurus form. Bikin tabel itu tugasnya file setup.

Analogi: menyimpan satu resep di dua buku. Suatu hari kamu ubah resep di buku A; yang masak dari buku B hasilnya beda, dan nggak ada yang tahu kenapa.

Sekarang efeknya memang belum kelihatan karena belum ada perubahan skema. Tapi ini tipe "utang teknis": diam-diam aman, lalu meledak saat proyek makin besar.

---

### T3. `VALUES (?,?,?)` itu apa?

Itu bagian perintah SQL INSERT yang artinya: **"di sini akan diisi 3 nilai, tapi nilainya gue kasih belakangan."**

- Tanda `?` namanya **placeholder** (tempat kosong)
- Kenapa tidak ditulis langsung nilainya? Karena (a) keamanan, dan (b) bisa dipakai berulang

Baca pelan-pelan dua baris ini:
```php
// 1. SIAPKAN perintah, dengan 3 tempat kosong
$stmt = $db->prepare("INSERT INTO produk (nama, harga, stok) VALUES (?, ?, ?)");
//  "masukkan ke tabel produk, ke kolom nama/harga/stok, nilainya 3 biji, belum gue kasih"

// 2. JALANKAN, isi tempat kosongnya sesuai urutan
$stmt->execute([$inputNama, (int)$inputHarga, (int)$inputStok]);
//  "tempat kosong ke-1 = $inputNama, ke-2 = harga, ke-3 = stok"
```

**Urutan itu wajib sama.** Kalau kebalik, data masuk ke kolom yang salah, dan ini jahat karena sering nggak ketahuan (terutama kalau dua kolomnya sama-sama angka, misal harga dan stok). Datanya "berhasil masuk", nggak ada error, tapi salah. Tipe bug yang baru ketemu setelah ada laporan dari user.

**Kenapa pakai `?` dan bukan tempel langsung?** Kalau nilainya ditempel langsung ke string SQL, user bisa mengetik sesuatu seperti `' OR '1'='1` dan mengubah arti perintahmu. Itu SQL injection yang kita bahas di sesi 004. Dengan `?`, isi dari user selalu diperlakukan sebagai **data**, bukan sebagai perintah.

Nama lain teknik ini: *prepared statement* / *parameter binding*.

---

### T4. `: void`, `: array`, ada yang kosong — itu apa?

Itu namanya **return type declaration**: janji sebuah function tentang bentuk hasil yang dikembalikannya. PHP memakai janji itu untuk mengawasi.

| Ditulis | Artinya | Kalau dilanggar |
|---|---|---|
| `: void` | function **tidak mengembalikan apa pun**. Kerjanya cuma mencetak/menyimpan | `return 5;` di dalamnya -> error |
| `: array` | wajib mengembalikan rak | tidak ada `return` -> TypeError: *"Return value must be of type array, none returned"* |
| `: string` | wajib mengembalikan teks | mengembalikan angka -> error |
| `: float` / `: int` | wajib mengembalikan angka | mengembalikan teks -> error |
| `: ?array` | boleh rak, boleh `null`. Tanda `?` = "boleh kosong" | - |
| **(kosong)** | PHP tidak mengawasi apa-apa. Boleh mengembalikan apa saja, boleh tidak sama sekali | tidak pernah error, dan justru itu bahayanya |

**Gunanya apa?** Menangkap kesalahan lebih awal, sebelum jadi bug produksi. Contoh nyatanya dari pengalaman kamu sendiri di Tugas 08: `ambilSemuaProduk(): array` yang cuma `echo` -> PHP langsung berhenti dan bilang persis masalahnya. Kalau kamu tidak menulis `: array`, kesalahan itu lewat begitu saja dan kamu baru sadar saat aplikasinya sudah dipakai orang.

**Aturan praktis untuk kamu:**
1. Function yang mengembalikan data -> tulis tipe yang benar (`: array`, `: string`, `: float`, `: ?array`)
2. Function yang cuma mencetak/menyimpan -> tulis `: void`
3. Di latihan, usahakan **selalu menulis tipe**. Biasanya di file kerja tim, tipe itu wajib
4. Ingat pelajarannya: yang tidak ditulis itu yang tidak diawasi. Yang tidak diawasi itu yang meledak.

**Cara baca nama tipe di depan vs belakang:**
```php
function hitungTotal(array $harga, float $pajak): float
//            ^^^^^^^^^^^^ ^^^^^^^^^^^^^^^^^^   ^^^^^^^
//            (di depan) bahan yang diterima    (di belakang) hasil yang dikembalikan
```
Di depan = **bahan masuk**. Di belakang = **hasil keluar**.
