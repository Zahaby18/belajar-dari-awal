<?php
// ============================================================
// SESI 001 - 6 TUGAS KECIL
// Cara jalanin: php latihan/00-mulai.php
// Isi bagian TODO saja. Jangan hapus baris yang lain.
// ============================================================

echo "=== TUGAS 1: cetak teks ===\n";
// TUGAS 1: ganti TODO di bawah jadi namamu
echo "Zahaby";

echo "\n\n=== TUGAS 2: variable ===\n";
// TUGAS 2: bikin $harga = 25000, lalu cetak isinya pakai echo
// tulis 2 baris di bawah sini
$harga=25000;
echo $harga;

echo "\n\n=== TUGAS 3: hitung ===\n";
// TUGAS 3: bikin $harga1 = 10000, $harga2 = 20000, $total = $harga1 + $harga2
// lalu cetak $total. Harus keluar 30000.
// tulis 4 baris di bawah sini
$harga1=10000;
$harga2=20000;
$total=$harga1+$harga2;
echo $total;

echo "\n\n=== TUGAS 4: if ===\n";
// TUGAS 4: kalau $total > 25000 cetak "mahal", kalau nggak cetak "murah"
// tulis di bawah sini
if($total>25000){
    echo "mahal";
}else{
    echo "murah";
}

echo "\n\n=== TUGAS 5: array + foreach ===\n";
// TUGAS 5: bikin $buah = ["apel", "jeruk", "mangga"] lalu cetak satu per baris
// tulis di bawah sini
$buah = ["apel", "jeruk", "mangga"];
echo $buah[0];


echo "\n\n=== TUGAS 6: function pertama ===\n";
// TUGAS 6: bikin function tambah($a, $b) yang return $a + $b
// lalu cetak hasil dari tambah(5, 7). Harus keluar 12.
// tulis di bawah sini

function tambah($a,$b){
    return $a + $b;
}

echo tambah(5,7)


echo "\n";
