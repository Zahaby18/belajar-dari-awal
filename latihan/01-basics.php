<?php
// PENANDA KEPEMILIKAN KODE: blok bertanda INI ZAHAB = bagian yang Zahab implementasi/ubah.
// Kerangka, instruksi, contoh, dan test yang tidak bertanda disiapkan Blessync.
// ============================================================
// SESI TERKAIT : sesi/001-php-dasar.md
// STATUS       : DITUNDA - nanti dikerjakan setelah sesi 003
// Buka file sesi itu buat baca materinya, dan cek PETA-MATERI.md
// kalau bingung nyocokin sesi sama latihan.
// ============================================================
declare(strict_types=1);

// ============================================================
// SESI 001 - PHP DASAR
// Kerangka ini kosong di bagian badan function. KAMU yang isi.
// Jangan hapus signature-nya. Jangan pakai AI buat isi badannya.
// ============================================================

// 1. Jumlahkan semua harga, lalu tambah pajak dalam persen.
//    hitungTotal([10000, 20000], 10) -> 33000.0
function hitungTotal(array $harga, float $pajakPersen): float
{
    // TODO 1: pakai array_sum() buat total, lalu hitung pajaknya
    return 0.0;
}

// >>> INI ZAHAB YANG NGERJAIN: percobaan awal (belum benar, latihan ini memang ditunda)
echo array_sum(hitungTotal[1000,2000],10);
// <<< AKHIR BAGIAN ZAHAB

// 2. 1500000 -> "Rp1.500.000,-"
function formatRupiah(float $angka): string
{
    // TODO 2: number_format($angka, 0, ",", ".") lalu tempel "Rp" dan ",-"
    return "";
}

// >>> INI ZAHAB YANG NGERJAIN: percobaan awal (belum benar, latihan ini memang ditunda)
echo number_format(formatRupiah(1000000))
// <<< AKHIR BAGIAN ZAHAB

// 3. Balikin produk yang stoknya DI BAWAH batas. Pakai foreach, bukan array_filter.
function stokRendah(array $produk, int $batas): array
{
    // TODO 3: siapkan array kosong, loop, cek stok, kalau di bawah batas masukkan
    return [];
}

// >>> INI ZAHAB YANG NGERJAIN: percobaan awal Tugas 3 (fixture mengikuti soal; latihan ditunda)
$produk = [
    ["nama" => "Kopi Arabica",  "harga" => 85000, "stok" => 12],
    ["nama" => "Teh Hijau",     "harga" => 35000, "stok" => 3],
    ["nama" => "Cokelat Bubuk", "harga" => 62000, "stok" => 0],
    ["nama" => "Gula Aren",     "harga" => 25000, "stok" => 20],
];

var_dump(stokRendah($produk, 10));
// <<< AKHIR BAGIAN ZAHAB

// 4. Balikin produk yang namanya cocok, atau null kalau nggak ada.
function cariProduk(array $produk, string $nama): ?array
{
    // TODO 4: loop, bandingkan nama pakai === , langsung return produknya kalau ketemu
    return null;
}
// >>> INI ZAHAB YANG NGERJAIN: percobaan awal Tugas 4 (fixture + pemanggilan, latihan ditunda)
$produk = [
    ["nama" => "Kopi Arabica",  "harga" => 85000, "stok" => 12],
    ["nama" => "Teh Hijau",     "harga" => 35000, "stok" => 3],
    ["nama" => "Cokelat Bubuk", "harga" => 62000, "stok" => 0],
    ["nama" => "Gula Aren",     "harga" => 25000, "stok" => 20],
];

var_dump(cariProduk($produk, "Teh Hijau")); 
// <<< AKHIR BAGIAN ZAHAB

// 5. Cetak tabel rapi ke terminal: Nama | Harga | Stok
function tampilkanTabel(array $produk): void
{
    // TODO 5: pakai str_pad($teks, 20) biar kolomnya lurus
    // Petunjuk: cetak header dulu, lalu loop
}

// >>> INI ZAHAB YANG NGERJAIN: percobaan awal Tugas 5 (fixture mengikuti soal; latihan ditunda)
$produk = [
    ["nama" => "Kopi Arabica",  "harga" => 85000, "stok" => 12],
    ["nama" => "Teh Hijau",     "harga" => 35000, "stok" => 3],
    ["nama" => "Cokelat Bubuk", "harga" => 62000, "stok" => 0],
    ["nama" => "Gula Aren",     "harga" => 25000, "stok" => 20],
];

var_dump(cariProduk($produk, "Kopi Luwak"));
// <<< AKHIR BAGIAN ZAHAB

// ============================================================
// BAGIAN INI JANGAN DIUBAH - jadi tolok ukur kamu benar
// ============================================================

$produk = [
    ["nama" => "Kopi Arabica",  "harga" => 85000, "stok" => 12],
    ["nama" => "Teh Hijau",     "harga" => 35000, "stok" => 3],
    ["nama" => "Cokelat Bubuk", "harga" => 62000, "stok" => 0],
    ["nama" => "Gula Aren",     "harga" => 25000, "stok" => 20],
];

echo "=== HITUNG TOTAL ===\n";
echo hitungTotal([10000, 20000], 10) . "\n";          // harus: 33000

echo "\n=== FORMAT RUPIAH ===\n";
echo formatRupiah(1500000) . "\n";                     // harus: Rp1.500.000,-

echo "\n=== STOK RENDAH (di bawah 10) ===\n";
var_dump(stokRendah($produk, 10));                     // harus: 3 produk (Teh Hijau, Cokelat Bubuk, ... 1 lagi)

echo "\n=== CARI PRODUK ===\n";
var_dump(cariProduk($produk, "Teh Hijau"));            // harus: array Teh Hijau
var_dump(cariProduk($produk, "Kopi Luwak"));           // harus: NULL

echo "\n=== TABEL PRODUK ===\n";
tampilkanTabel($produk);
