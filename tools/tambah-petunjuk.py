#!/usr/bin/env python3
"""Tambahin petunjuk silang: sesi <-> latihan."""
import os, re, glob

ROOT = "/root/bootcamp"

# peta: sesi -> latihan yang terkait
SESI_KE_LATIHAN = {
    "sesi/001-php-survival.md": [
        "latihan/00-mulai.php (Tugas 1-6 kecil)",
        "latihan/01-basics.php (versi berat, DITUNDA - materinya di sesi/001-php-dasar.md)",
    ],
    "sesi/001-php-dasar.md": [
        "latihan/01-basics.php (5 function, masih ditunda)",
    ],
    "sesi/002-function-olah-data.md": [
        "latihan/02-functions.php (Tugas 1 hitungTotal, Tugas 2 formatRupiah)",
        "latihan/03-stokRendah.php (Tugas 3)",
        "latihan/04-produkMahal.php (Tugas 4)",
        "latihan/solusi/03-stokRendah-solusi.php (contoh jawaban Tugas 3)",
    ],
    "sesi/003-cari-dan-tampilkan.md": [
        "latihan/05-cariProduk.php (Tugas 5)",
        "latihan/06-tampilkanTabel.php (Tugas 6)",
    ],
    "sesi/004-database.md": [
        "latihan/07-db-setup.php (Tugas 07)",
        "latihan/08-db-baca.php (Tugas 08)",
    ],
    "sesi/005-halaman-web.md": [
        "latihan/09-halaman.php (Tugas 09)",
        "latihan/cek-09.php (alat pengecekan otomatis)",
    ],
}

# peta: latihan -> sesi + status
LATIHAN_KE_SESI = {
    "latihan/00-mulai.php": ("sesi/001-php-survival.md", "LULUS"),
    "latihan/01-basics.php": ("sesi/001-php-dasar.md", "DITUNDA - jadi tugas pengulangan setelah sesi 006"),
    "latihan/02-functions.php": ("sesi/002-function-olah-data.md", "LULUS"),
    "latihan/03-stokRendah.php": ("sesi/002-function-olah-data.md", "LULUS"),
    "latihan/04-produkMahal.php": ("sesi/002-function-olah-data.md", "LULUS"),
    "latihan/05-cariProduk.php": ("sesi/003-cari-dan-tampilkan.md", "LULUS"),
    "latihan/06-tampilkanTabel.php": ("sesi/003-cari-dan-tampilkan.md", "LULUS"),
    "latihan/07-db-setup.php": ("sesi/004-database.md", "LULUS"),
    "latihan/08-db-baca.php": ("sesi/004-database.md", "LULUS"),
    "latihan/09-halaman.php": ("sesi/005-halaman-web.md", "LULUS (11 PASS di cek-09.php)"),
    "latihan/cek-09.php": ("sesi/005-halaman-web.md", "ALAT PENGECEKAN, bukan tugas"),
    "latihan/solusi/03-stokRendah-solusi.php": ("sesi/002-function-olah-data.md", "CONTOH JAWABAN"),
    "latihan/00-mulai.php": ("sesi/001-php-survival.md", "LULUS"),
}

MARK_SESI = "> **LATIHAN TERKAIT:**"
MARK_LATIHAN = "SESI TERKAIT"

def tambah_petunjuk_sesi():
    for path, latihan in SESI_KE_LATIHAN.items():
        full = os.path.join(ROOT, path)
        teks = open(full, encoding="utf-8").read()
        if MARK_SESI in teks:
            continue  # sudah pernah
        baris = teks.split("\n")
        # cari heading pertama
        idx = next((i for i, b in enumerate(baris) if b.startswith("# ")), 0)
        daftar = "\n".join("> - `" + x.split(" (")[0] + "`" + (" (" + x.split(" (", 1)[1] if " (" in x else "") for x in latihan)
        blok = ["", MARK_SESI, daftar, ""]
        baris = baris[:idx + 1] + blok + baris[idx + 1:]
        open(full, "w", encoding="utf-8").write("\n".join(baris))
        print("SESI   +", path)

def tambah_petunjuk_latihan():
    for path, (sesi, status) in LATIHAN_KE_SESI.items():
        full = os.path.join(ROOT, path)
        teks = open(full, encoding="utf-8").read()
        if MARK_LATIHAN in teks:
            continue
        baris = teks.split("\n")
        blok = [
            "// ============================================================",
            f"// {MARK_LATIHAN} : {sesi}",
            f"// STATUS       : {status}",
            "// Buka file sesi itu buat baca materinya, dan cek PETA-MATERI.md",
            "// kalau bingung nyocokin sesi sama latihan.",
            "// ============================================================",
        ]
        # cari baris <?php
        idx = next((i for i, b in enumerate(baris) if b.strip() == "<?php"), None)
        if idx is None:
            baris = blok + baris
        else:
            baris = baris[:idx + 1] + blok + baris[idx + 1:]
        open(full, "w", encoding="utf-8").write("\n".join(baris))
        print("LATIHAN+", path)

if __name__ == "__main__":
    tambah_petunjuk_sesi()
    tambah_petunjuk_latihan()
