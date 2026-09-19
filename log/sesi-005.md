# LOG SESI 005 (19 Sep 2026) - Halaman web pertama

## TUGAS 09 - halaman HTML daftar produk
Commit: `f59094b` ("selesain latihan-09")

### Yang BENAR
- `foreach ($produk as $p) : ?>` ... `<?php endforeach; ?>` -> bentuk loop-di-dalam-HTML tepat
- `htmlspecialchars($p["nama"])` -> **konsep keamanan XSS langsung diterapkan di percobaan pertama**. Ini penting
- `count($produk)` untuk total
- Halaman jalan di server bawaan PHP, output HTML-nya benar (`<td>1</td><td>Kopi Arabica</td>...`)

### BUG YANG LOLOS DARI PENGECEKAN LAMA
```php
<td><?php echo $p["stok"]; ?></td>
<tr>          <-- HARUSNYA </tr>, kurang garis miring
```
Jadi setiap baris tabel dibuka `<tr>` tapi nggak pernah ditutup. Header row-nya ditutup dengan benar, jadi totalnya `<tr>` 5 vs `</tr>` 1.

### Kenapa ini pelajaran besar (2 lapis)
**Lapis 1: browser itu pemaaf.** Browser tetap menampilkan tabel yang kelihatan normal walau HTML-nya rusak. Jadi "di browser kelihatan bagus" BUKAN bukti bahwa HTML-nya benar. Bug seperti ini kelihatan jelas di kode, tapi nggak kelihatan di layar.
**Lapis 2: pengecekan yang gue tulis juga nggak nangkap.** Pengecekan awal (9 poin) cuma ngecek keberadaan tag dan teks, bukan keseimbangan tag berpasangan. Jadi bug-nya lolos dua-duanya.

### Tindakan
Pengecekan `cek-09.php` ditambah 2 poin baru (jumlah `<tr>` = jumlah `</tr>`, jumlah `<td>` = jumlah `</td>`), jadi total 11 pengecekan.
Hasil setelah penambahan:
- Kode Zahab: 10 PASS / 1 FAIL -> bug ketangkep
- Jawaban referensi: 11 PASS / 0 FAIL

### Pelajaran untuk Zahab
1. Test hijau bukan jaminan kode benar. Test cuma ngecek hal-hal yang kita kepikiran untuk dicek
2. HTML punya tag berpasangan: `<tr>` harus ditutup `</tr>`, `<td>` ditutup `</td>`, `<table>` ditutup `</table>`. Lupa satu garis miring = struktur rusak
3. Di Laravel nanti, HTML rusak bikin masalah nyata: form di dalam tabel nggak bisa di-submit, dan Google salah baca struktur halaman

### Sisa pekerjaan
1. Ganti `<tr>` jadi `</tr>` di akhir tiap baris produk
2. `php latihan/cek-09.php` harus 11 PASS
3. Commit + push
