# SESI 001 - PHP Dasar (kamu nulis, gue review)
Estimasi: 2 jam. Target: setelah sesi ini kamu BISA NULIS PHP tanpa AI.

## Sebelum mulai: file apa ini
PHP = teks biasa yang dijalankan mesin. Semua kelakuan PHP ada di dalam `<?php ... ?>`.
Untuk file yang isinya cuma PHP: **jangan pakai `?>`** di akhir file (bikin masalah spasi tak terlihat).

## 7 hal yang harus kamu tahu sekarang (tanpa ini, nggak bisa lanjut)

### 1. Variable & tipe
```php
$nama = "zahab";     // string
$umur = 27;          // int
$tinggi = 175.5;     // float
$aktif = true;       // bool
```
PHP itu *loosely typed*: `"5" + 2` jadi 7. Itu sebabnya kita selalu tulis `declare(strict_types=1);` di baris pertama.

### 2. String & campur variable
```php
echo "Halo $nama";                        // interpolasi
echo "Halo " . $nama . "!";               // concat
echo 'Halo $nama';                        // SINGLE QUOTE = nggak interpolasi
```

### 3. Kondisi
```php
if ($umur >= 18) {
    echo "dewasa";
} elseif ($umur >= 13) {
    echo "remaja";
} else {
    echo "anak";
}
```

### 4. Array (ini alat kerja utama kamu)
```php
$buah = ["apel", "jeruk"];                      // indexed
$produk = [
    "nama"  => "Kopi",
    "harga" => 25000,
    "stok"  => 10,
];                                              // associative
echo $produk["nama"];                           // akses pakai key
```

### 5. Loop
```php
foreach ($buah as $b) { echo $b; }              // nilainya saja
foreach ($produk as $key => $value) { }         // key + nilai
for ($i = 0; $i < 3; $i++) { }                  // hitungan
```

### 6. Function (dan ini yang bikin kode kamu rapi)
```php
declare(strict_types=1);

function hitungTotal(float $harga, int $jumlah): float
{
    return $harga * $jumlah;
}

echo hitungTotal(25000, 3);   // 75000
```
Aturan yang gue wajibin mulai sekarang:
- Nama function pakai kata kerja: `hitungTotal`, bukan `cek` atau `proses`
- Selalu ada type di parameter dan return (`: float`)
- Satu function = satu tugas. Kalau butuh kata "dan" di deskripsinya, pecah jadi dua.

### 7. Array function yang wajib hafal
```php
count($arr)                 // jumlah item
array_filter($arr, fn($x) => $x > 5)
array_map(fn($x) => $x * 2, $arr)
array_sum([1,2,3])          // 6
implode(", ", $buah)        // "apel, jeruk"
in_array("apel", $buah)     // true
usort($arr, fn($a,$b) => $a <=> $b)
```

---

## TUGAS SESI 001 (harus jadi, bukan harus sempurna)
Bikin file `latihan/01-basics.php`. Isinya 5 function + output CLI:

1. `hitungTotal(array $harga, float $pajakPersen): float`
   -> jumlahkan semua harga, lalu tambah pajak dalam persen.
   Contoh: `hitungTotal([10000, 20000], 10)` = 33000.0

2. `formatRupiah(float $angka): string`
   -> `1500000` jadi `"Rp1.500.000,-"` (pakai `number_format`)

3. `stokRendah(array $produk, int $batas): array`
   -> terima array of array, balikin produk yang stoknya DI BAWAH batas. Pakai loop manual dulu (jangan `array_filter`), biar logikanya kebaca.

4. `cariProduk(array $produk, string $nama): ?array`
   -> balikin produk yang cocok, atau `null` kalau nggak ada. Ini latihan tipe `?array`.

5. `tampilkanTabel(array $produk): void`
   -> cetak ke terminal pakai `str_pad` biar rapi berkolom (Nama | Harga | Stok).

Lalu di bawahnya: bikin array 4 produk, panggil kelima function itu, dan cetak hasilnya.

**Cara jalankan:** `php latihan/01-basics.php`
**Definisi selesai:** output terminalnya rapi, dan kamu bisa jelasin tiap baris tanpa lihat catatan. Kalau ada yang kamu nggak ngerti kenapa jalan, tanya, jangan dibiarkan.
**Commit:** `git add -A && git commit -m "sesi 001: fungsi dasar PHP (hitungTotal, formatRupiah, stokRendah, cariProduk, tabel)"`

## ATURAN AI (mulai sekarang, berlaku selamanya)
- BOLEH: tanya konsep ("kenapa `??` dipakai"), minta review, minta jelasin error
- NGGAK BOLEH: minta AI tulis kodenya, lalu paste
- Tesnya gampang: **kalau kamu nggak bisa jelasin tiap baris ke gue, itu bukan kode kamu.** Gue akan nanya random satu baris di sesi berikutnya.

## Skema 4 sesi fondasi (biar kamu tahu arah)
- **Sesi 001 (sekarang):** PHP dasar - variable, array, function, loop
- **Sesi 002:** PDO + SQLite - nyambung DB, INSERT/SELECT/UPDATE/DELETE (mulai bikin todo.php)
- **Sesi 003:** Class & OOP - ubah todo.php jadi ber-class, kenalan sama interface
- **Sesi 004:** Error handling + test + Git workflow - todo.php kelar, ada test, di-commit
Setelah 4 sesi ini: baru Laravel.
