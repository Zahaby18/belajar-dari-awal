# PENJELASAN KODE: BACA INI PELAN-PELAN
Gue jelasin tiap blok, bukan gaya buku. Baca satu blok, tutup mata, ulangi pakai bahasa kamu sendiri. Kalau satu blok belum nempel, jangan lanjut.

Ada 2 file di folder `latihan/`:
- `00-mulai.php` = file latihan kamu sekarang (6 tugas kecil)
- `01-basics.php` = file yang DITUNDA (5 function), gue jelasin di bagian akhir

---

# FILE 1: `00-mulai.php`

## Bagian pembuka
```php
<?php
```
Ini gerbangnya. Semua file PHP harus dibuka `<?php`. Tanpa ini, PHP anggap isi file cuma tulisan biasa.

```php
echo "=== TUGAS 1: cetak teks ===\n";
```
- `echo` = perintah "cetak ke layar"
- tanda kutip `"..."` = teks yang dicetak apa adanya
- `\n` = pindah baris (fungsi `Enter`)
- `;` di akhir = tanda perintah selesai. Lupa ini = PHP bingung
- Baris kayak gini cuma jadi judul biar outputmu rapi. Nggak ada logika di sini

## TUGAS 1 (kamu: BENAR)
```php
echo "Zahaby";
```
Cetak tulisan `Zahaby`. Selesai. Ini batu pertama: kalau ini udah jalan, kamu udah bisa "ngomong" lewat PHP.

## TUGAS 2 (kamu: BENAR)
```php
$harga = 25000;
echo $harga;
```
- `$harga` = nama sebuah KOTAK. Semua variable di PHP mulai dengan `$`
- `=` = "isi kotak ini dengan" (bukan "sama dengan" seperti matematika)
- `25000` = isi kotaknya
- `echo $harga;` = cetak **isi** kotaknya, jadi yang keluar `25000`, bukan kata "harga"
- Bedanya sama TUGAS 1: yang tadi cetak tulisan, yang ini cetak isi kotak

## TUGAS 3 (kamu: BENAR)
```php
$harga1 = 10000;
$harga2 = 20000;
$total = $harga1 + $harga2;
echo $total;
```
Baris 3 adalah intinya: PHP ambil isi kotak `$harga1`, ambil isi kotak `$harga2`, jumlahkan, lalu **simpan hasilnya ke kotak baru** bernama `$total`.
Baris 4 cetak isinya. Makanya keluar `30000`.
Poin penting: `=` di sini berarti MENYIMPAN, bukan membandingkan. Membandingkan nanti pakai `==` atau `>`.

## TUGAS 4 (kamu: BENAR)
```php
if ($total > 25000) {
    echo "mahal";
} else {
    echo "murah";
}
```
Cara baca:
- `if` = kalau
- `($total > 25000)` = pertanyaannya: isi `$total` lebih besar dari 25000?
- `{ ... }` = blok perintah yang dikerjakan KALAU pertanyaannya benar
- `else` = kalau pertanyaannya salah, kerjakan blok ini
- `>` = lebih besar. Ada juga `<`, `>=`, `<=`, `==` (sama dengan), `!=` (tidak sama dengan)

Karena `$total` = 30000, pertanyaannya benar, jadi yang keluar "mahal".
Format penulisan yang lebih rapi (standar tim, namanya PSR-12): kasih spasi `if ($total > 25000) {` dan `} else {`. Fungsinya sama, cuma lebih enak dibaca orang lain.

## TUGAS 5 (kamu: SETENGAH, ini yang perlu dibenerin)
```php
$buah = ["apel", "jeruk", "mangga"];
```
Kurung siku `[]` = bikin RAK. Rak ini punya 3 slot dan **penomoran slot dimulai dari 0**:
- slot 0 = apel
- slot 1 = jeruk
- slot 2 = mangga

Yang kamu tulis:
```php
echo $buah[0];
```
Artinya: cetak isi slot nomor 0 = `apel`. Cuma satu yang keluar, dan itu memang benar, tapi bukan yang diminta.

Cara nyebut semua isi rak tanpa ngetik tiga kali:
```php
foreach ($buah as $b) {
    echo $b;
}
```
Cara baca: "untuk setiap isi `$buah`, sebut dia `$b`, lakukan ini: cetak `$b`".
Mesin `foreach` jalan sendiri: ambil slot 0, taruh di `$b`, jalankan bloknya, ambil slot 1, taruh di `$b`, jalankan lagi, sampai slot habis.
Kalau mau satu baris satu buah, tulis `echo $b . "\n";` (tanda titik itu artinya menggabungkan teks).

Kesalahan umum: nulis `foreach ($buah as $b)` tapi di dalam bloknya masih pakai `$buah[0]`. Harus `$b`, karena `$b` yang lagi dipegang.

## TUGAS 6 (kamu: logika BENAR, kurang 1 karakter)
```php
function tambah($a, $b) {
    return $a + $b;
}
echo tambah(5,7);
```
Cara baca:
- `function tambah($a, $b)` = bikin MESIN bernama `tambah`, punya 2 lubang masuk bernama `$a` dan `$b`. Isi lubang baru terisi saat mesinnya dipakai
- `return $a + $b;` = mesin mengeluarkan hasil jumlahnya. `return` artinya "serahkan hasilnya"
- `echo tambah(5,7);` = pakai mesinnya dengan bahan 5 dan 7, lalu cetak hasilnya

**Beda `return` dan `echo` (ini penting banget):**
- `echo` = langsung mencetak ke layar, selesai, nggak bisa dipakai lagi
- `return` = menyerahkan hasil ke yang memakai, jadi bisa disimpan: `$x = tambah(5,7);` lalu `$x` isinya 12

Aturan mainnya: di dalam function, pakai `return`. Kalau pakai `echo` di dalam function, hasilnya langsung kabur ke layar dan nggak bisa diolah lagi.

Yang bikin seluruh file mati: `echo tambah(5,7)` **tanpa `;`** di akhir.
PHP membaca seluruh file dulu sebelum jalan. Ketemu satu syntax salah, semua baris dibatalkan, walaupun baris 1-54 benar. Itu namanya parse error.

---

# FILE 2: `01-basics.php` (DITUNDA, pelajari besok)
File ini 5 function yang lebih serius. Jangan dikerjakan sekarang. Gue jelasin isinya dulu biar nggak serem.

## Bagian atas yang bikin bingung
```php
declare(strict_types=1);
```
Artinya: "PHP, tolong ketat sama tipe data." Kalau kamu masukkan angka ke function yang minta teks, PHP langsung marah. Ini bagus untuk proyek besar.

```php
function hitungTotal(array $harga, float $pajakPersen): float
```
Bacanya: mesin `hitungTotal` menerima **rak** (`array $harga`) dan **angka desimal** (`float $pajakPersen`), dan mengeluarkan **angka desimal** (`: float`).
Jadi tiga info di satu baris: bentuk bahan 1, bentuk bahan 2, bentuk hasil.

```php
function cariProduk(array $produk, string $nama): ?array
```
Tanda tanya di `?array` artinya: hasilnya boleh rak, boleh juga `null` (kosong/nggak ketemu).

```php
function tampilkanTabel(array $produk): void
```
`void` artinya mesin ini **nggak mengeluarkan hasil**, kerjanya cuma mencetak ke layar.

## Isi 5 function itu maunya apa
1. `hitungTotal` = jumlahkan semua harga di rak, lalu tambah pajak dalam persen. `[10000, 20000]` + 10% = 33000
2. `formatRupiah` = ubah `1500000` jadi tulisan `"Rp1.500.000,-"` (pakai `number_format`)
3. `stokRendah` = dari daftar produk, ambil yang stoknya di bawah batas tertentu
4. `cariProduk` = cari 1 produk berdasarkan namanya, kalau nggak ada balikin `null`
5. `tampilkanTabel` = cetak daftar produk jadi tabel rapi di terminal (pakai `str_pad`)

## Kenapa yang kamu tulis kemarin error
```php
echo array_sum(hitungTotal[1000,2000],10);
```
Ada 3 masalah di satu baris:
1. `hitungTotal[1000,2000]` salah. **Kurung siku `[]` itu untuk ambil isi rak. Memanggil mesin/function pakai kurung biasa `()`** -> `hitungTotal(1000, 2000)`
2. `array_sum` fungsinya menjumlahkan isi RAK. Tapi `hitungTotal` mengeluarkan ANGKA, bukan rak
3. `echo` nggak ada `;`

```php
echo number_format(formatRupiah(1000000))
```
Ini kebalik. `number_format` harusnya dipakai DI DALAM `formatRupiah`, bukan dari luar. Dan sekarang `formatRupiah` masih `return "";` (badannya belum kamu isi), jadi yang keluar cuma teks kosong.
Lagi-lagi `;` nggak ada.
Plus: kamu definisikan `$produk` 3 kali di 3 tempat. Boleh, tapi buang tenaga. Bikin sekali, taruh di atas, pakai berkali-kali.

Kesimpulan file ini: **belum waktunya.** Bukan karena kamu bodoh, tapi karena isinya butuh materi yang belum kita pelajari (array of array, return type, `null`, `number_format`). Kita bahas di Sesi 002.

---

# POLA AKUMULATOR: arti tiap baris
Pola ini muncul di semua function yang "mengumpulkan data". Di TUGAS 3 (`stokRendah`) bentuknya begini:
```php
$hasil = [];
foreach ($produk as $p) {
    if (...) {
        $hasil[] = $p;
    }
}
return $hasil;
```

## Baris per baris
**`$hasil = [];`**
Siapkan RAK KOSONG buat wadah hasil akhir. Kenapa harus disiapkan di depan? Karena nanti di dalam loop kita mau menaruh barang ke situ. Kalau nggak disiapkan, nggak ada tempat naruhnya.
Isi awalnya kosong `[]`, dan nanti isinya nambah satu-satu.

**`foreach ($produk as $p) { }`**
Ambil isi `$produk` SATU PER SATU, dari depan ke belakang. Item yang lagi dipegang sementara diberi nama `$p`.
Tiap putaran, `$p` isinya beda: putaran 1 = produk pertama, putaran 2 = produk kedua, dst.
Blok di dalam `{ }` dijalankan sekali untuk setiap item.

**`if ( ... ) { }`**
Pertanyaannya: "produk yang lagi gue pegang ini, masuk kriteria atau nggak?"
Tanda `...` di contoh itu **PLACEHOLDER, bukan syntax PHP**. Itu gue tulis biar kamu yang ngisi. Kamu harus ganti jadi pertanyaan nyata, misal: stok produk ini kurang dari batas?
Karena `$p` itu rak berlabel, cara ambil stoknya: `$p["stok"]`. Dan batasnya ada di parameter `$batas`.

**`$hasil[] = $p;`**
Kalau pertanyaannya benar, MASUKKAN produk itu ke rak hasil.
- `$hasil[]` artinya "slot baru paling belakang". Jadi tiap kali, produk baru ditambahkan ke ujung rak, nggak menimpa yang sudah ada
- Bandingkan: `$hasil[0] = $p;` artinya "letakkan di slot 0", dan itu akan MENIMPA isi slot 0 tiap kali. Ini kesalahan umum, dan hasilnya cuma 1 item walau syaratnya lolos berkali-kali
- Cara lain yang sama artinya: `array_push($hasil, $p);` (yang `[]` lebih sering dipakai)

**`return $hasil;`**
Setelah rak `$produk` habis diperiksa, serahkan rak hasilnya ke yang memanggil function.

## Telusuri dengan data nyata (ini cara mikir yang bener)
Data: Kopi (stok 12), Teh (stok 3), Cokelat (stok 0), Gula (stok 20). Batas = 10.

| Putaran | `$p` yang dipegang | Pertanyaan: stok < 10? | Aksi | Isi `$hasil` sekarang |
|---|---|---|---|---|
| 1 | Kopi (12) | TIDAK | tidak masuk | `[]` |
| 2 | Teh (3) | IYA | masuk | `[Teh]` |
| 3 | Cokelat (0) | IYA | masuk | `[Teh, Cokelat]` |
| 4 | Gula (20) | TIDAK | tidak masuk | `[Teh, Cokelat]` |

Setelah loop habis, `return $hasil` -> `[Teh, Cokelat]`. Jumlahnya 2. Itu sebabnya target output `2` lalu nama dua produk itu.

## Pola ini namanya apa dan di mana dipakai
Namanya **filter** (menyaring) dengan pola **akumulator** (mengumpulkan hasil di wadah).
Dipakai di mana-mana, seumur karier:
- Tampilkan produk yang stoknya habis
- Ambil transaksi bulan ini saja
- Cari user yang belum verifikasi email
- Hitung total belanja
Bentuknya selalu sama: siapkan wadah, periksa satu-satu, kumpulkan yang lolos, serahkan hasilnya.

## Bedanya sama `hitungTotal`
- `hitungTotal` wadahnya ANGKA, ditambah pakai `$total = $total + $x;`
- `stokRendah` wadahnya RAK, ditambah pakai `$hasil[] = $x;`
Wadahnya beda, polanya persis sama.

---

# RINGKASAN: 5 hal yang harus kamu ingat
1. `;` di akhir tiap perintah. Ini penyebab 90% parse error
2. Variable = kotak berlabel, selalu mulai `$`
3. `foreach` untuk nyebut semua isi rak, satu per satu
4. Di dalam function pakai `return`, bukan `echo`
5. Run dulu, bandingkan dengan target, baru commit
