<?php
// ============================================================
// SOLUSI TUGAS 3 - stokRendah
// ATURAN: JANGAN COPY PASTE. Ketik ulang pakai tanganmu sendiri.
// Copy paste = nggak ada yang nempel di otak. Ngetik ulang = nempel.
// ============================================================

// Function ini tugasnya: saring produk yang stoknya kurang dari batas.
// Parameter:
//   array $produk  = rak berisi banyak produk
//   int $batas     = angka batas stok
// Return:
//   array = rak berisi produk yang lolos saringan
function stokRendah(array $produk, int $batas): array
{
    // LANGKAH 1: siapkan rak kosong buat nampung hasil
    $hasil = [];

    // LANGKAH 2: periksa isi $produk satu per satu
    // $p adalah nama sementara untuk produk yang lagi dipegang
    foreach ($produk as $p) {

        // LANGKAH 3: pertanyaannya -> stok produk ini kurang dari batas?
        // INGAT: $p itu rak, jadi harus pakai label ["stok"] buat ambil isinya
        if ($p["stok"] < $batas) {

            // LANGKAH 4: kalau iya, MASUKKAN produk itu ke rak hasil
            // tanda [] di belakang $hasil artinya "tambah ke slot paling belakang"
            // JANGAN pakai echo di sini, karena tugas function ini mengumpulkan, bukan mencetak
            $hasil[] = $p;
        }
    }

    // LANGKAH 5: serahkan rak hasilnya ke yang memanggil function ini
    return $hasil;
}

// ============================================================
// BAGIAN TES - sama dengan yang ada di materi, jangan diubah
// ============================================================

$produk = [
    ["nama" => "Kopi Arabica",  "harga" => 85000, "stok" => 12],
    ["nama" => "Teh Hijau",     "harga" => 35000, "stok" => 3],
    ["nama" => "Cokelat Bubuk", "harga" => 62000, "stok" => 0],
    ["nama" => "Gula Aren",     "harga" => 25000, "stok" => 20],
];

$hasil = stokRendah($produk, 10);
echo count($hasil) . "\n";
foreach ($hasil as $p) {
    echo $p["nama"] . " - " . $p["stok"] . "\n";
}
