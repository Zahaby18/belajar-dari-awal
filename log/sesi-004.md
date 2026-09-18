# LOG SESI 004 (18 Sep 2026) - Database

## TUGAS 07 - db setup -> HAMPIR LULUS (1 huruf)
Commit: `b33d4d8` ("latihan 7 done, latihan 8 nyerah")

### Yang BENAR
- `CREATE TABLE produk` dengan 4 kolom + tipe data tepat (id AUTOINCREMENT, nama TEXT, harga INTEGER, stok INTEGER)
- `prepare()` sekali + `execute([...])` 4 kali -> persis seperti yang diminta materi
- Jumlah baris 4, urutannya benar

### Yang salah
1. Nama produk ditulis `Coklat Bubuk`, seharusnya `Cokelat Bubuk` -> diff gagal di baris 4
2. Nilai stok semua diisi `2`, padahal materi menyebut 12, 3, 0, 20

### Pelajaran penting dari kesalahan no.2
Test-nya TIDAK menangkap kesalahan stok, karena test cuma mencetak nama. Artinya: **test itu punya batas.** Program bisa lulus test tapi datanya tetap salah.
Di kerjaan nyata, bentuknya begini: laporan stok perusahaan selisih, nggak ada error di log, nggak ada test yang gagal, dan nggak ada yang sadar sampai ada yang komplain. Jadi kebiasaannya bukan cuma "test hijau", tapi "datanya juga benar sesuai spesifikasi".

---

## TUGAS 08 - db baca -> BELUM LULUS (nyerah di tengah, tapi gap-nya cuma 4 baris)

### Output asli saat dijalankan
```
1 - Kopi Arabica - 85000
2 - Teh Hijau - 35000
3 - Coklat Bubuk - 62000
4 - Gula Aren - 25000
PHP Fatal error: Uncaught TypeError: ambilSemuaProduk(): Return value must be of type array, none returned
```

### Masalah 1: function di-ECHO, bukan di-RETURN
```php
function ambilSemuaProduk(PDO $db): array {
    $stmt = $db->query("SELECT * FROM produk ORDER BY id");
    foreach ($stmt->fetchAll() as $s) {
        echo $s["id"] . " - " . $s["nama"] . " - " . $s["harga"] . "\n";   // salah
    }
}
```
Return type-nya `array`, tapi function ini tidak mengembalikan apa pun -> PHP melempar TypeError dan program MATI.
Ini pengulangan pelajaran sesi 003 (Tugas 6): `void` = function yang mencetak, `array`/`string`/`float` = function yang MENYERAHKAN hasil.
Karena test block di bawah sudah punya tugas mencetak, function di atas cukup `return $stmt->fetchAll();`

### Masalah 2: output jadi dobel
Kalau function mencetak DAN test block juga mencetak, hasilnya tiap produk muncul 2 kali. Yang mencetak cukup salah satu: test block.

### Masalah 3: `WHERE id=$id` ditempel langsung (bukan prepared statement)
```php
$stmt = $db->query("SELECT * FROM produk WHERE id=$id");   // pola berbahaya
```
Di kasus ini `$id` bertipe `int` jadi belum bisa dibobol, tapi polanya yang salah. Begitu yang ditempel adalah teks dari user (nama, email, pencarian), itu jadi lubang SQL injection. Kebiasaannya: SELALU pakai `?`.

### Masalah 4: ambil 1 baris pakai `fetch()`, bukan `fetchAll()`
`fetchAll()` mengembalikan rak berisi baris. `fetch()` mengembalikan SATU baris, dan mengembalikan `false` kalau kosong.
Jadi untuk `cariProdukById`: `$row = $stmt->fetch();` lalu `return $row === false ? null : $row;` -> di situlah pola early return + null bertemu database.

### Catatan mentor
Zahab bilang "nyerah" di Tugas 8, padahal gap-nya cuma 4 baris dan semua kesalahannya konsep yang sudah pernah dia lalui (return vs echo). Reaksi yang perlu: kecilkan masalahnya, tunjukkan bahwa errornya sudah menjelaskan dirinya sendiri, dan jangan biarkan kata "nyerah" jadi kebiasaan. Yang bikin dia mentok sebenarnya cuma satu: mengira function wajib mencetak.
