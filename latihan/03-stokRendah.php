<?php
function stokRendah(array $produk, int $batas): array
{
    $hasil = [];
    foreach ($produk as $p) {
        if ($p["stok"] < $batas) {
            $hasil[] = $p;
        }
    }

    return $hasil;
}

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
