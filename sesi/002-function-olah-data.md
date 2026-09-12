# SESI 002 - FUNCTION YANG MENGOLAH DATA
Target sesi ini: 2 function selesai, dan kamu PAHAM tiap barisnya.
Jangan kerjakan file `01-basics.php` secara keseluruhan. Kita potong kecil, satu function satu waktu.

## CARA KERJA SESI INI (beda dari sesi 001)
Bikin file BARU: `latihan/02-function.php`. Isi file `01-basics.php` jangan disentuh dulu.
Di file baru ini, kamu kerjakan function satu per satu, **run setiap selesai satu function**. Jadi kalau error, kamu tahu persis penyebabnya.

## Konsep baru: function yang menerima RAK
Dari sesi 001 kamu sudah bikin `tambah($a, $b)` yang menerima 2 angka. Sekarang functionnya menerima **rak berisi banyak angka**:
```php
function hitungJumlah(array $angka) {
    $total = 0;
    foreach ($angka as $a) {
        $total = $total + $a;   // atau: $total += $a;
    }
    return $total;
}

echo hitungJumlah([10000, 20000, 30000]);   // 60000
```
Alur pikirnya (ini pola yang bakal kamu pakai terus sampai kerja):
1. Siapkan wadah kosong: `$total = 0;`
2. Ambil isi rak satu-satu: `foreach`
3. Tiap item, tambahkan ke wadah: `$total += $a;`
4. Setelah rak habis, `return $total;`

Pola "siapkan wadah kosong -> isi pelan-pelan -> return" ini disebut **akumulator**. Kelihatan sederhana, tapi ini dasar dari 80% logika aplikasi: hitung total belanja, hitung stok, hitung jumlah komentar.

---

## TUGAS 1 - `hitungTotal(array $harga, float $pajakPersen): float`
Bikin function yang: jumlahkan semua angka di rak, lalu tambah pajak persen.
Target: `hitungTotal([10000, 20000], 10)` = `33000`

Langkah mikir (kerjakan satu-satu, run di tiap langkah):
1. Bikin file `latihan/02-function.php`, buka dengan `<?php`
2. Copy function di atas apa adanya
3. Isi badannya pakai pola akumulator: jumlahkan dulu `$harga`
4. Run dulu: `echo hitungTotal([10000, 20000], 10);` -> hasilnya harus `30000` (belum pakai pajak)
5. Baru tambahkan pajaknya. Rumus: `$total + ($total * $pajakPersen / 100)`
6. Run lagi -> harus `33000`

Petunjuk kalau langkah 5 bikin bingung: pajak 10% dari 30000 itu 3000. `30000 * 10 / 100` = 3000.

## TUGAS 2 - `formatRupiah(float $angka): string`
Ubah angka jadi tulisan rupiah. Target: `formatRupiah(1500000)` = `"Rp1.500.000,-"`

Ada function bawaan PHP yang sudah melakukan bagian sulitnya:
```php
number_format(1500000, 0, ",", ".")
```
Run itu dulu di file kamu, lihat hasilnya (`1.500.000`). Baru setelah itu bungkus jadi `formatRupiah`, tambahkan `"Rp"` di depan dan `",-"` di belakang pakai tanda titik (menggabungkan teks).

Yang dipelajari di sini: **cari function bawaan PHP dulu sebelum nulis logika sendiri.** Dev pemula nulis manual, dev berpengalaman tahu `number_format` sudah ada.

## TUGAS 3 - `stokRendah(array $produk, int $batas): array`
Ini pakai **rak di dalam rak** (array of array). Bentuk datanya:
```php
$produk = [
    ["nama" => "Kopi",  "stok" => 12],
    ["nama" => "Teh",   "stok" => 3],
];
```
Cara ambil isinya:
```php
foreach ($produk as $p) {
    echo $p["nama"];    // "Kopi" lalu "Teh"
    echo $p["stok"];    // 12 lalu 3
}
```
Karena tiap item raknya sendiri adalah rak dengan label (`nama`, `stok`), maka `$p["nama"]` = ambil isi slot berlabel "nama" dari item `$p`.

Tugasnya: balikin HANYA produk yang stoknya di bawah batas. Polanya tetap akumulator, tapi wadahnya rak:
```php
$hasil = [];
foreach (...) {
    if (...) {
        $hasil[] = $p;    // <- tanda [] artinya "tambahkan ke rak"
    }
}
return $hasil;
```
Fungsi `$hasil[] = $p;` itu cara menambah item baru ke rak dari belakang.

Run: `var_dump(stokRendah($produk, 10));` harus keluar 2 produk (Teh dan satu lagi).

### VERSI RESMI TUGAS 3 (pakai file dan target baru)
Bikin file baru: `latihan/03-stokRendah.php`. Jangan ditumpuk di `02-functions.php`, biar outputnya bisa dibandingkan dengan target sendiri.

Isi file itu:
```php
<?php

$produk = [
    ["nama" => "Kopi Arabica",  "harga" => 85000, "stok" => 12],
    ["nama" => "Teh Hijau",     "harga" => 35000, "stok" => 3],
    ["nama" => "Cokelat Bubuk", "harga" => 62000, "stok" => 0],
    ["nama" => "Gula Aren",     "harga" => 25000, "stok" => 20],
];

function stokRendah(array $produk, int $batas): array
{
    // TODO: isi di sini. Pakai pola akumulator dengan wadah berupa rak
}

$hasil = stokRendah($produk, 10);
echo count($hasil) . "\n";
foreach ($hasil as $p) {
    echo $p["nama"] . " - " . $p["stok"] . "\n";
}
```

Target output ada di `latihan/expected/03-stokRendah.txt`. Cara cek:
```
php latihan/03-stokRendah.php > hasil3.txt
fc hasil3.txt latihan\expected\03-stokRendah.txt
```


---

## ATURAN SESI INI
- Satu function selesai + run + benar, baru lanjut function berikutnya
- Kalau satu function mentok > 20 menit: tanya, bawa kode + pesan errornya
- Jangan lompat ke TUGAS 3 sebelum TUGAS 1 benar-benar jalan
- Commit tiap 1 function selesai, biar riwayatnya kelihatan

## TARGET SESI 002
Minimal TUGAS 1 dan 2 selesai dan jalan. Kalau TUGAS 3 juga selesai, bagus banget.
TUGAS untuk function `cariProduk` dan `tampilkanTabel` kita taruh di Sesi 003.
