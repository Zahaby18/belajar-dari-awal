from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]

# Existing task files: each header explains how to read the inline ownership markers.
for rel in [
    "latihan/00-mulai.php", "latihan/01-basics.php", "latihan/02-functions.php",
    "latihan/03-stokRendah.php", "latihan/04-produkMahal.php", "latihan/05-cariProduk.php",
    "latihan/06-tampilkanTabel.php", "latihan/07-db-setup.php", "latihan/08-db-baca.php",
    "latihan/09-halaman.php", "latihan/10-form.php",
]:
    p = ROOT / rel
    s = p.read_text(encoding="utf-8")
    if "PENANDA KEPEMILIKAN KODE" not in s:
        marker = "<?php\n"
        note = "// PENANDA KEPEMILIKAN KODE: blok bertanda INI ZAHAB = bagian yang Zahab implementasi/ubah.\n// Kerangka, instruksi, contoh, dan test yang tidak bertanda disiapkan Blessync.\n"
        s = s.replace(marker, marker + note, 1)
        p.write_text(s, encoding="utf-8")

# Insert paired comments around learner implementations. Exact snippets are stable and unique.
blocks = {
"latihan/00-mulai.php": [
('echo "Zahaby";', '// >>> INI ZAHAB YANG NGERJAIN: Tugas 1\necho "Zahaby";\n// <<< AKHIR BAGIAN ZAHAB'),
('$harga=25000;\necho $harga;', '// >>> INI ZAHAB YANG NGERJAIN: Tugas 2\n$harga=25000;\necho $harga;\n// <<< AKHIR BAGIAN ZAHAB'),
('$harga1=10000;\n$harga2=20000;\n$total=$harga1+$harga2;\necho $total;', '// >>> INI ZAHAB YANG NGERJAIN: Tugas 3\n$harga1=10000;\n$harga2=20000;\n$total=$harga1+$harga2;\necho $total;\n// <<< AKHIR BAGIAN ZAHAB'),
('if($total>25000){\n    echo "mahal";\n}else{\n    echo "murah";\n}', '// >>> INI ZAHAB YANG NGERJAIN: Tugas 4\nif($total>25000){\n    echo "mahal";\n}else{\n    echo "murah";\n}\n// <<< AKHIR BAGIAN ZAHAB'),
('$buah = ["apel", "jeruk", "mangga"];\n\nforeach($buah as $i){\n    echo $i . "\\n";\n}', '// >>> INI ZAHAB YANG NGERJAIN: Tugas 5\n$buah = ["apel", "jeruk", "mangga"];\n\nforeach($buah as $i){\n    echo $i . "\\n";\n}\n// <<< AKHIR BAGIAN ZAHAB'),
('function tambah($a,$b){\n    return $a + $b;\n}\n\necho tambah(5,7);', '// >>> INI ZAHAB YANG NGERJAIN: Tugas 6\nfunction tambah($a,$b){\n    return $a + $b;\n}\n\necho tambah(5,7);\n// <<< AKHIR BAGIAN ZAHAB'),
],
"latihan/01-basics.php": [
('echo array_sum(hitungTotal[1000,2000],10);', '// >>> INI ZAHAB YANG NGERJAIN: percobaan awal (belum benar, latihan ini memang ditunda)\necho array_sum(hitungTotal[1000,2000],10);\n// <<< AKHIR BAGIAN ZAHAB'),
('echo number_format(formatRupiah(1000000))', '// >>> INI ZAHAB YANG NGERJAIN: percobaan awal (belum benar, latihan ini memang ditunda)\necho number_format(formatRupiah(1000000))\n// <<< AKHIR BAGIAN ZAHAB'),
('$produk = [\n    ["nama" => "Kopi Arabica",  "harga" => 85000, "stok" => 12],\n    ["nama" => "Teh Hijau",     "harga" => 35000, "stok" => 3],\n    ["nama" => "Cokelat Bubuk", "harga" => 62000, "stok" => 0],\n    ["nama" => "Gula Aren",     "harga" => 25000, "stok" => 20],\n];\n\nvar_dump(stokRendah($produk, 10));', '// >>> INI ZAHAB YANG NGERJAIN: percobaan awal Tugas 3 (fixture mengikuti soal; latihan ditunda)\n$produk = [\n    ["nama" => "Kopi Arabica",  "harga" => 85000, "stok" => 12],\n    ["nama" => "Teh Hijau",     "harga" => 35000, "stok" => 3],\n    ["nama" => "Cokelat Bubuk", "harga" => 62000, "stok" => 0],\n    ["nama" => "Gula Aren",     "harga" => 25000, "stok" => 20],\n];\n\nvar_dump(stokRendah($produk, 10));\n// <<< AKHIR BAGIAN ZAHAB'),
('var_dump(cariProduk($produk, "Teh Hijau")); ', '// >>> INI ZAHAB YANG NGERJAIN: percobaan awal pemanggilan Tugas 4 (latihan ditunda)\nvar_dump(cariProduk($produk, "Teh Hijau")); \n// <<< AKHIR BAGIAN ZAHAB'),
],
"latihan/02-functions.php": [
('function hitungJumlah(array $angka) {', '// >>> INI BLESSYNC YANG NGERJAIN: contoh akumulator untuk dipelajari\nfunction hitungJumlah(array $angka) {'),
('echo hitungJumlah([10000, 20000, 30000]);   // 60000', 'echo hitungJumlah([10000, 20000, 30000]);   // 60000\n// <<< AKHIR CONTOH BLESSYNC'),
('function hitungTotal(array $harga, float $pajak): float{', '// >>> INI ZAHAB YANG NGERJAIN: implementasi Tugas 1\nfunction hitungTotal(array $harga, float $pajak): float{'),
('echo hitungTotal([10000,20000],10);', 'echo hitungTotal([10000,20000],10);\n// <<< AKHIR BAGIAN ZAHAB'),
('echo number_format(1500000, 0, ",", ".") . "\\n";', '// >>> INI ZAHAB YANG NGERJAIN: mencoba number_format untuk Tugas 2\necho number_format(1500000, 0, ",", ".") . "\\n";'),
('function formatRupiah(float $angka): string{', '// >>> INI ZAHAB YANG NGERJAIN: implementasi Tugas 2\nfunction formatRupiah(float $angka): string{'),
('echo formatRupiah(85000). "\\n";', 'echo formatRupiah(85000). "\\n";\n// <<< AKHIR BAGIAN ZAHAB'),
],
"latihan/03-stokRendah.php": [
('function stokRendah(array $produk, int $batas): array', '// >>> INI ZAHAB YANG NGERJAIN: implementasi Tugas 3 (filter produk stok rendah)\nfunction stokRendah(array $produk, int $batas): array'),
('    return $hasil;\n}', '    return $hasil;\n}\n// <<< AKHIR BAGIAN ZAHAB'),
],
"latihan/04-produkMahal.php": [
('function produkMahal(array $produk, int $hargaMinimal): array', '// >>> INI ZAHAB YANG NGERJAIN: variasi mandiri Tugas 4\nfunction produkMahal(array $produk, int $hargaMinimal): array'),
('    return $hasil;\n}', '    return $hasil;\n}\n// <<< AKHIR BAGIAN ZAHAB'),
],
"latihan/05-cariProduk.php": [
('function cariProduk(array $produk, string $nama): ?array', '// >>> INI ZAHAB YANG NGERJAIN: implementasi Tugas 5\nfunction cariProduk(array $produk, string $nama): ?array'),
('    return null;\n}', '    return null;\n}\n// <<< AKHIR BAGIAN ZAHAB'),
],
"latihan/06-tampilkanTabel.php": [
('function tampilkanTabel(array $produk): void', '// >>> INI ZAHAB YANG NGERJAIN: implementasi Tugas 6\nfunction tampilkanTabel(array $produk): void'),
('    }\n}', '    }\n}\n// <<< AKHIR BAGIAN ZAHAB'),
],
"latihan/07-db-setup.php": [
('$db->exec("CREATE TABLE IF NOT EXISTS ', '// >>> INI ZAHAB YANG NGERJAIN: implementasi TODO 1 (CREATE TABLE)\n$db->exec("CREATE TABLE IF NOT EXISTS '),
('        stok INTEGER NOT NULL\n)");', '        stok INTEGER NOT NULL\n)");\n// <<< AKHIR BAGIAN ZAHAB'),
('$stmt = $db->prepare("INSERT INTO produk (nama, harga, stok) VALUES (?, ?, ?)");', '// >>> INI ZAHAB YANG NGERJAIN: implementasi TODO 2 (INSERT 4 produk)\n$stmt = $db->prepare("INSERT INTO produk (nama, harga, stok) VALUES (?, ?, ?)");'),
('$stmt->execute(["Gula Aren", 25000, 20]);', '$stmt->execute(["Gula Aren", 25000, 20]);\n// <<< AKHIR BAGIAN ZAHAB'),
],
"latihan/08-db-baca.php": [
('function ambilSemuaProduk(PDO $db): array', '// >>> INI ZAHAB YANG NGERJAIN: implementasi TODO 1\nfunction ambilSemuaProduk(PDO $db): array'),
('    return $db->query("SELECT * FROM produk ORDER BY id")->fetchAll();\n}', '    return $db->query("SELECT * FROM produk ORDER BY id")->fetchAll();\n}\n// <<< AKHIR BAGIAN ZAHAB'),
('function cariProdukById(PDO $db, int $id): ?array', '// >>> INI ZAHAB YANG NGERJAIN: implementasi TODO 2-3\nfunction cariProdukById(PDO $db, int $id): ?array'),
('    return $row === false ? null : $row;\n}', '    return $row === false ? null : $row;\n}\n// <<< AKHIR BAGIAN ZAHAB'),
],
"latihan/09-halaman.php": [
('        foreach($produk as $p) : ?>', '        <!-- >>> INI ZAHAB YANG NGERJAIN: loop produk dan isi 4 sel tabel -->\n        <?php foreach($produk as $p) : ?>'),
('        <?php endforeach; ?>\n    </table>', '        <?php endforeach; ?>\n        <!-- <<< AKHIR BAGIAN ZAHAB -->\n    </table>'),
('    <p>Total produk: <?= count($produk);  ?></p>', '    <!-- >>> INI ZAHAB YANG NGERJAIN: hitung jumlah produk -->\n    <p>Total produk: <?= count($produk);  ?></p>\n    <!-- <<< AKHIR BAGIAN ZAHAB -->'),
],
"latihan/10-form.php": [
('$db->exec("CREATE TABLE IF NOT EXISTS produk (', '// >>> INI ZAHAB YANG NGERJAIN: menambahkan CREATE TABLE di file form (duplikat; bukan bagian wajib Tugas 10)\n$db->exec("CREATE TABLE IF NOT EXISTS produk ('),
('    stok INTEGER NOT NULL\n)");', '    stok INTEGER NOT NULL\n)");\n// <<< AKHIR BAGIAN ZAHAB'),
('    $inputNama = trim($_POST["nama"] ?? "");', '    // >>> INI ZAHAB YANG NGERJAIN: implementasi TODO 1-3 (ambil, validasi, INSERT + redirect)\n    $inputNama = trim($_POST["nama"] ?? "");'),
('        exit;\n    }\n}', '        exit;\n    }\n    // <<< AKHIR BAGIAN ZAHAB\n}'),
('    if ($error !== []): ?>', '    <!-- >>> INI ZAHAB YANG NGERJAIN: implementasi TODO 4 (tampilkan pesan error) -->\n    <?php if ($error !== []): ?>'),
('    <?php endif; ?>\n\n\n    <form method="post">', '    <?php endif; ?>\n    <!-- <<< AKHIR BAGIAN ZAHAB -->\n\n    <form method="post">'),
('        <label> Nama :', '        <!-- >>> INI ZAHAB YANG NGERJAIN: implementasi TODO 5 (form input) -->\n        <label> Nama :'),
('        <button type="submit">Simpan</button>\n    </form>', '        <button type="submit">Simpan</button>\n        <!-- <<< AKHIR BAGIAN ZAHAB -->\n    </form>'),
],
}

for rel, replacements in blocks.items():
    p = ROOT / rel
    s = p.read_text(encoding="utf-8")
    for old, new in replacements:
        if new in s:
            continue
        if old not in s:
            raise RuntimeError(f"Anchor tidak ketemu di {rel}: {old[:80]!r}")
        s = s.replace(old, new, 1)
    p.write_text(s, encoding="utf-8")

# Files not yet edited by Zahab / mentor-made tools and examples: say so explicitly.
mentor_only = {
    "latihan/11-edit.php": "KERANGKA BLESSYNC - Zahab belum mengerjakan latihan ini.",
    "latihan/12-hapus.php": "KERANGKA BLESSYNC - Zahab belum mengerjakan latihan ini.",
    "latihan/cek-09.php": "ALAT PENGECEKAN BLESSYNC - bukan tugas implementasi Zahab.",
    "latihan/cek-10.php": "ALAT PENGECEKAN BLESSYNC - bukan tugas implementasi Zahab.",
    "latihan/cek-10-buka.php": "ALAT SIMULASI BLESSYNC - bukan tugas implementasi Zahab.",
    "latihan/cek-10-kirim.php": "ALAT SIMULASI BLESSYNC - bukan tugas implementasi Zahab.",
    "latihan/cek-driver.php": "ALAT SIMULASI BLESSYNC - bukan tugas implementasi Zahab.",
    "latihan/cek-11.php": "ALAT PENGECEKAN BLESSYNC - bukan tugas implementasi Zahab.",
    "latihan/cek-12.php": "ALAT PENGECEKAN BLESSYNC - bukan tugas implementasi Zahab.",
    "latihan/lihat-db.php": "ALAT BANTU BLESSYNC - bukan tugas implementasi Zahab.",
    "latihan/solusi/03-stokRendah-solusi.php": "CONTOH JAWABAN BLESSYNC - bandingkan dengan implementasi Zahab di ../03-stokRendah.php.",
}
for rel, label in mentor_only.items():
    p = ROOT / rel
    s = p.read_text(encoding="utf-8")
    if "INI BLESSYNC YANG NGERJAIN" not in s:
        s = s.replace("<?php\n", "<?php\n// INI BLESSYNC YANG NGERJAIN: " + label + "\n", 1)
        p.write_text(s, encoding="utf-8")

# Every teaching session is Blessync-authored; Zahab writes code in the linked exercise files.
for p in (ROOT / "sesi").glob("*.md"):
    s = p.read_text(encoding="utf-8")
    note = "> **PENANDA PENULIS:** materi dan contoh kode di file sesi ini ditulis Blessync. Implementasi latihan Zahab ada di file `latihan/` yang tertaut di atas dan ditandai langsung di kodenya.\n"
    if "PENANDA PENULIS" not in s:
        lines = s.splitlines(keepends=True)
        # Put after the LATIHAN TERKAIT block, or after title/prerequisite block for session 008.
        idx = 0
        while idx < len(lines) and (lines[idx].startswith("# ") or lines[idx].strip() == "" or lines[idx].startswith("> **LATIHAN TERKAIT:**") or lines[idx].startswith("> - ") or lines[idx].startswith("> **Prasyarat:**")):
            idx += 1
        lines.insert(idx, "\n" + note + "\n")
        p.write_text("".join(lines), encoding="utf-8")

print("Authorship markers added.")
