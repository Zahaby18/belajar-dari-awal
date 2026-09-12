# SESI 003 - MENCARI DATA & MENAMPILKAN TABEL
Kamu sudah lulus: saring data (filter). Sesi ini 2 pola baru, dua-duanya kamu pakai terus sampai kerja.

---

# KONSEP BARU 1: `return` yang menghentikan loop (early return)

Sampai sekarang, `return` selalu di baris paling akhir. Kenyataannya, `return` bisa dipanggil kapan saja, dan **begitu dipanggil, function langsung selesai**.

Contoh lengkap: cari 1 buah berdasarkan namanya.
```php
function cariBuah(array $rakBuah, string $namaDicari): ?array
{
    foreach ($rakBuah as $b) {
        if ($b["nama"] === $namaDicari) {
            return $b;          // ketemu -> langsung serahkan, loop BERHENTI di sini
        }
    }

    return null;                // loop sudah habis, nggak ada yang cocok
}
```

Baca pelan-pelan:
1. `foreach` mulai memeriksa dari item pertama
2. Kalau ada yang cocok, `return $b;` jalan -> function SELESAI saat itu juga, item sisanya nggak diperiksa lagi. Ini bagus: hemat kerja
3. Kalau loop habis tanpa ketemu, baris `return null;` yang jalan
4. `null` artinya "tidak ada / kosong". Ini nilai khusus di PHP
5. `?array` di return type artinya: hasilnya boleh array, boleh juga `null`. Tanda tanya = "boleh kosong"

### Kenapa `===` bukan `==`
`===` mengecek nilai **dan tipe**, `==` cuma nilai. Untuk membandingkan nama, pakai `===` supaya nggak ada kejutan (ingat jawaban diagnostik kamu soal `$a == "0"`).

### Kesalahan umum di pola ini
```php
// SALAH: pakai variabel bantuan, padahal bisa langsung return
$ketemu = null;
foreach ($rakBuah as $b) {
    if ($b["nama"] === $namaDicari) {
        $ketemu = $b;      // loop tetap lanjut sampai habis, buang tenaga
    }
}
return $ketemu;
```
Dua-duanya "jalan", tapi yang pertama lebih tepat: berhenti begitu urusan selesai.

### Kenapa ini penting banget
Di Laravel nanti, ini bentuknya:
- `Produk::find(5)` -> balikin 1 produk, atau `null` kalau nggak ada
- `Produk::where('nama', $nama)->first()` -> sama, balikin 1 atau `null`
- Lalu di controller: kalau `null`, kita balikin halaman 404
Jadi pola "cari 1, kalau nggak ada balikin null" itu kebutuhan harian web developer.

**TUGAS 5:** `latihan/05-cariProduk.php` - udah gue siapkan kerangka + tesnya. Isi bodi function-nya sendiri (pola di atas, tinggal kamu sesuaikan ke data produk).

---

# KONSEP BARU 2: `str_pad` (bikin kolom rapi) & `void`

Contoh lengkap: cetak daftar buah jadi kolom rapi.
```php
function cetakDaftarBuah(array $rakBuah): void
{
    echo str_pad("Nama", 15) . "| " . "Harga" . "\n";

    foreach ($rakBuah as $b) {
        echo str_pad($b["nama"], 15) . "| " . $b["harga"] . "\n";
    }
}
```

Baca pelan-pelan:
1. `str_pad($teks, 15)` = "tambahkan spasi di kanan sampai panjangnya 15 karakter". Gunanya biar kolom lurus walau panjang nama beda-beda. Tanpa ini, outputnya berantakan
2. `str_repeat("-", 34)` = cetak tanda `-` sebanyak 34 kali. Dipakai buat garis pemisah
3. `: void` = function ini **nggak mengembalikan apa-apa**. Dia cuma mencetak ke layar. Kalau di dalamnya kamu tulis `return` dengan nilai, PHP marah
4. Karena `void`, cara pakainya tidak disimpan: `cetakDaftarBuah($rakBuah);` (bukan `$x = cetakDaftarBuah(...)`)

### Kapan pakai `return`, kapan pakai `void`?
- Butuh datanya buat diolah lagi? -> `return`
- Cuma mau mencetak/menampilkan? -> `void` (atau return tanpa nilai)
Kebanyakan function di aplikasi nyata pakai `return`, karena datanya biasanya diolah dulu. `void` lebih sering di kode tampilan.

**TUGAS 6:** `latihan/06-tampilkanTabel.php` - kerangka udah ada. Isi bodi function-nya: cetak header, garis pemisah, lalu tiap produk satu baris.

---

# TARGET OUTPUT (wajib dicocokkan)
```
php latihan/05-cariProduk.php > hasil5.txt
fc hasil5.txt latihan\expected\05-cariProduk.txt

php latihan/06-tampilkanTabel.php > hasil6.txt
fc hasil6.txt latihan\expected\06-tampilkanTabel.txt
```
Dua-duanya harus "no differences". `hasil5.txt` dan `hasil6.txt` udah masuk `.gitignore`.

# SETELAH LULUS DUA-DUANYA
Kamu sudah bisa 4 pola inti: menghitung (akumulator angka), menyaring (akumulator rak), mencari satu (early return), dan menampilkan (void + str_pad).
Sesi berikutnya baru masuk **database**. Karena tanpa database, aplikasi cuma bisa pegang data di dalam file. Sampai sini kamu belum butuh database, tapi semua polanya sudah kamu pakai di kerjaan nyata.
