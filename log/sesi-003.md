# LOG SESI 003 (mulai 12 Sep 2026)

## TUGAS 5 - cariProduk -> LULUS di percobaan pertama
Commit: `5c426b9`
Kode yang ditulis:
```php
function cariProduk(array $produk, string $nama): ?array
{
    foreach($produk as $p){
        if ($p["nama"] === $nama){
            return $p;
        }
    }

    return null;
}
```
Verifikasi: output `Teh Hijau - 35000` lalu `TIDAK KETEMU`, cocok dengan target.
Catatan mentor: pola early return langsung kena, `===` dipakai dengan benar, dan `return $p;` ditaruh DI DALAM if (bukan pakai variabel bantuan). Ini pertama kali dia pakai `return` di tengah loop dan hasilnya tepat.

### Pertanyaan Zahab: "kenapa yang bawah jadi TIDAK KETEMU?"
Jawaban: memang dirancang begitu. Tes kedua mencari "Kopi Luwak" yang TIDAK ADA di data, tujuannya menguji jalur `null`.
Alur: `foreach` memeriksa 4 produk, nggak ada yang namanya cocok, loop habis, lalu baris `return null;` yang jalan. Di luar function, `if ($p === null)` jadi benar -> cetak "TIDAK KETEMU".
Pelajaran: **selalu tes dua sisi, ketemu dan tidak ketemu.** Kalau cuma tes yang ada, kita nggak pernah tahu kode kita benar atau nggak saat datanya kosong. Di aplikasi nyata, inilah bedanya halaman 404 vs error 500.

## TUGAS 6 - tampilkanTabel -> BELUM LULUS
Kode yang ditulis:
```php
function tampilkanTabel(array $produk): void
{
    echo "Nama           | Harga     | Stok" . "\n";

    foreach($produk as $p){
        echo $p["nama"] . "|" . $p["harga"] . "    |" . $p["stok"] . "\n" ;
    }
}
```
Output:
```
Nama           | Harga     | Stok
Kopi Arabica|85000    |12
Teh Hijau|35000    |3
Cokelat Bubuk|62000    |0
Gula Aren|25000    |20
```

### 3 masalah
1. **Baris pemisah hilang.** Target punya `----------------------------------` (34 tanda `-`) setelah header. Bikinnya pakai `str_repeat("-", 34)`
2. **Kolom nggak lurus, karena spasi ditulis manual.** `"Kopi Arabica|85000"` vs `"Teh Hijau|35000"` -> tanda `|` nya di posisi beda-beda. Ini yang dia sebut "tabelnya berantakan". Solusinya `str_pad`
3. **Header ditulis manual dengan spasi** yang kebetulan sama dengan target. Berbahaya: cara ini nggak tahan perubahan. Begitu ada nama produk 20 karakter, header dan baris data langsung nggak nyambung. Header dan baris data harus pakai LEBAR YANG SAMA, dan itu otomatis kalau dua-duanya pakai `str_pad` dengan angka yang sama

### Bukti perbandingan (dites di terminal)
DENGAN str_pad:
```
Sayur       | Berat   | Harga
================================
Bayam       | 250     | 5000
Kangkung    | 1000    | 8000
Brokoli     | 75      | 25000
```
TANPA str_pad (cara Zahab):
```
Bayam|250    |5000
Kangkung|1000    |8000
Brokoli|75    |25000
```

### Yang harus dikerjakan
1. Header pakai `str_pad("Nama", 15)` dan `str_pad("Harga", 10)`
2. Tambah baris pemisah `str_repeat("-", 34)`
3. Baris data pakai lebar yang sama: nama 15, harga 10 (harga dikonversi `(string)` dulu)
4. Verifikasi dengan `fc`/`diff` dan paste hasilnya

---

## Iterasi 2 - commit `975d5d6` -> HAMPIR LULUS (90%)
Kemajuan besar: `str_pad` sudah dipakai dengan benar, dan LEBAR header sudah sama dengan lebar baris data (15 dan 10). Kolomnya sudah lurus.

Sisa 2 hal:
1. **Kurang spasi setelah tanda `|`.** Dia tulis `"|"`, targetnya `"| "`. Semua baris perlu spasi setelah pipa
2. **Baris pemisah masih belum ada** (`str_repeat("-", 34)`)

Output dia:
```
Nama           |Harga     |Stok
Kopi Arabica   |85000     |12
```
Target:
```
Nama           | Harga     | Stok
----------------------------------
Kopi Arabica   | 85000     | 12
```

Catatan mentor: 2 hal ini bisa ketemu sendiri dalam 5 detik dengan membaca output `diff` (tanda `<` = punyamu, `>` = target). Sudah dijadikan PR pertama untuk sesi berikutnya.

### Status akhir hari ini
Dua-duanya ditutup untuk hari ini (keputusan Zahab). 06 diselesaikan di awal sesi berikutnya, lalu langsung masuk Sesi 004 (Database).
