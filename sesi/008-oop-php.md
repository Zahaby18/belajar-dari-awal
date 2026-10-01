# SESI 008 - PHP OOP DASAR (sebelum Laravel)

> **LATIHAN TERKAIT:** `latihan/13-oop.php` (akan disiapkan setelah Sesi 007)
> **Prasyarat:** Sesi 001-007, terutama function, array, return type, PDO

## Kenapa kita belajar OOP?
**Perlu, karena Laravel ditulis dengan OOP.** Model, controller, request, service, middleware, dan dependency injection semuanya memakai class dan object.

Kamu tidak perlu menguasai semua teori OOP sebelum mulai Laravel. Target sesi ini lebih praktis: bisa baca class Laravel dan menulis class kecil yang punya tanggung jawab jelas. Polanya: gue jelaskan dan kasih contoh lengkap dulu, kita ketik ulang bersama, baru kamu kerjakan variasi sendiri.

## Yang akan dipelajari
1. **Class vs object**: class itu cetakan/definisi; object itu hasil nyata yang dibuat dari class.
2. **Property vs method**: property menyimpan keadaan/data; method adalah function milik object.
3. **Constructor**: `__construct()` mengisi keadaan awal object saat dibuat dengan `new`.
4. **Visibility**: `public` bisa diakses dari luar; `private` hanya dari dalam class. Kenapa data sebaiknya tidak diubah sembarangan.
5. **Type declaration** di property, parameter, dan return type.
6. **Composition sederhana**: satu object menggunakan object lain, tanpa membuat pewarisan hanya demi berbagi kode.
7. **Menerapkan konsep ke Laravel**: `Product extends Model`, controller sebagai class, dan dependency injection. Kita akan baca contohnya, belum membangun framework sendiri.

## Yang BELUM perlu dikejar
- Design patterns tingkat lanjut, inheritance berlapis, magic methods, reflection, metaprogramming.
- Menghafal semua teori SOLID sebelum menulis aplikasi.
- Membuat class untuk setiap function kecil. OOP membantu mengatur tanggung jawab; bukan berarti semua hal harus jadi class.

## Contoh singkat
```php
class Keranjang
{
    private array $barang = [];

    public function tambah(string $nama, int $jumlah): void
    {
        $this->barang[$nama] = ($this->barang[$nama] ?? 0) + $jumlah;
    }

    public function jumlahBarang(): int
    {
        return array_sum($this->barang);
    }
}

$keranjang = new Keranjang();  // object dibuat dari class
$keranjang->tambah("Kopi", 2); // panggil method pada object

echo $keranjang->jumlahBarang(); // 2
```

Bacanya:
- `class Keranjang` = definisi/cetakan.
- `$keranjang = new Keranjang()` = bikin satu object nyata.
- `$this->barang` = property milik object yang sedang dipakai.
- `tambah()` dan `jumlahBarang()` = method, yaitu function yang dimiliki object.
- `private` menjaga supaya kode luar tidak mengubah `$barang` sembarangan.

Contoh ini pengantar, bukan materi yang harus langsung kamu hafal. Kita akan bedah per baris saat sesinya.

## Kenapa ini nyambung ke Laravel?
Laravel membuat dan menyusun banyak object untuk aplikasi kamu. Contoh bentuk sederhananya:
```php
class ProductController
{
    public function index(ProductService $products)
    {
        return $products->all();
    }
}
```
`ProductController` adalah class. Laravel membuat object yang dibutuhkan dan memberikan `ProductService` ke method `index`. Mekanisme pemberian dependency itu disebut **dependency injection**. Kita akan mulai dari membaca dan mengerti alurnya, bukan langsung disuruh menulis framework.

## Status
Materi pengantar dan posisi di roadmap sudah ditetapkan. Latihan rinci dibuat setelah Update/Delete selesai, supaya scope-nya menyesuaikan bagian yang masih perlu diulang.
