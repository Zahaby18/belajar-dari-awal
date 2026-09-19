# LOG SESI 006 (19 Sep 2026) - Form & CRUD (Create + Read)

## TUGAS 10 - form tambah produk
Commit: `e729819` ("10-form.php tapi belom bener")

### Yang BENAR (sebagian besar sudah tepat)
- TODO 1: `trim($_POST["nama"] ?? "")` untuk 3 input -> tepat, sudah termasuk penanganan input kosong
- TODO 2: 3 validasi dengan pola `$error[] = "..."` -> tepat
  - `if ($inputNama === "")` -> pakai `===`, benar
  - `if (!is_numeric($inputHarga) || (int)$inputHarga < 0)` -> logika tepat
- TODO 3: struktur `if ($error === [])` + `prepare` + `execute` + `header(...)` + `exit` -> tepat
- TODO 4: blok error pakai `if ($error !== []):` + `foreach` + `htmlspecialchars($e)` -> tepat
- TODO 5: 3 input + tombol submit, atribut `name` benar

### BUG 1 (yang bikin stuck): `int($inputHarga)` bukan cara cast
```php
$stmt->execute([$inputNama, int($inputHarga), int($inputStok)]);
```
Error yang muncul:
```
PHP Fatal error: Uncaught Error: Call to undefined function int()
in latihan/10-form.php:62
```
PHP tidak punya function bernama `int()`. Yang ada 2 cara, dan dia mencampur keduanya:
| Cara | Bentuk | Jenis |
|---|---|---|
| Cast | `(int)$harga` | perintah ke PHP: baca ini sebagai angka. Tanda kurung MEMBUNGKUS tipe |
| Function | `intval($harga)` | function bawaan PHP |
| Salah | `int($harga)` | tidak ada |
Dibuktikan di terminal:
```
int($h)    -> ERROR: Call to undefined function int()
(int)$h    -> 12345
intval($h) -> 12345
```

### BUG 2: `value="..."` tanpa `echo`
```php
<input type="text" name="nama" value="<?php htmlspecialchars($inputNama);?>">
```
`htmlspecialchars()` dipanggil tapi hasilnya dibuang (tidak di-echo), jadi atribut `value` selalu kosong. Akibatnya kalau ada error validasi, form tidak terisi ulang dan user harus ngetik ulang.
Perbaikan: `value="<?= htmlspecialchars($inputNama) ?>"` (`<?=` itu singkatan dari `<?php echo`).

### Catatan tambahan
- Dia menambahkan `CREATE TABLE IF NOT EXISTS produk (...)` di dalam `10-form.php`. Tidak salah (aman karena IF NOT EXISTS), tapi tidak perlu karena tabel sudah dibuat di `07-db-setup.php`. Risiko: kalau struktur tabel berubah, harus diedit di 2 tempat. Prinsip satu file satu tugas.

### Hasil cek otomatis
`php latihan/cek-10.php` -> 6 PASS / 6 FAIL. Semua FAIL berasal dari satu penyebab: fatal error di baris 62, sehingga proses POST mati sebelum INSERT.

### Pelajaran
Zahab mengira dirinya "stuck", padahal PHP sudah memberi pesan yang jelas: `undefined function int()`. Artinya: tidak ada function bernama `int`. Kalau pesan error dibaca, masalahnya langsung kelihatan. Ini pola yang berulang: masalahnya bukan kode yang sulit, tapi error yang tidak dibaca.
