# DIAGNOSTIK LEVEL 0
Sesi 000. Tujuan: cari titik terendah kamu, biar gue nggak ngajarin hal yang udah kamu bisa.
Jawab sebisanya. **"Gak tahu" itu jawaban sah** dan tetap dihitung data. Jangan buka Google/AI.

## Bagian A: konsep (jawab singkat, 1-3 baris)
1. Bedanya `GET` dan `POST` apa? Kapan pakai `PUT`?
2. HTTP status 401 vs 403 bedanya apa?
3. Apa itu cookie? Bedanya sama session di server?
4. Di SQL, bedanya `LEFT JOIN` dan `INNER JOIN`?
5. Apa itu index di database dan kapan bikin lambat?
6. Di PHP, apa bedanya `==` dan `===`?
7. Apa itu class? Bedanya class sama function biasa?
8. Apa itu interface dan kenapa dipakai?
9. Git: bedanya `merge` dan `rebase`?
10. Kalau kamu `git commit` lalu sadar ada typo di nama file, apa yang kamu lakukan?
11. Di JavaScript: bedanya `var`, `let`, `const`? Kenapa `let` di dalam loop sering bikin bug?
12. Apa itu REST API? Contoh endpoint untuk ambil daftar produk?

## Bagian B: baca kode (jelasin apa yang terjadi, ada bug atau nggak)
```php
$users = User::all();
foreach ($users as $user) {
    echo $user->orders->count();
}
```
13. Jelasin apa yang kode ini lakukan ke database. Ada masalah?

```php
function cek($a, $b) {
    if ($a == "0") return true;
    return $b ?? false;
}
```
14. Ada berapa masalah di sini? Sebut semuanya.

## Bagian C: praktik (ini yang paling penting)
15. Bikin file `todo.php` di folder bootcamp/latihan:
    - Pakai PHP murni (boleh PDO + SQLite), tanpa framework
    - Bisa: tambah todo, list todo, tandai selesai, hapus
    - Input dari CLI (`php todo.php tambah "beli susu"`)
    - Data disimpan, nggak hilang saat dijalankan lagi
    - Ada 1 file test (boleh manual assert atau PHPUnit) yang menguji tambah + selesai
    - Commit ke git dengan pesan yang jelas
16. Kalau mentok: tulis di chat bagian mana yang mentok, itu jawaban yang gue tunggu.

## Cara gue nilai
- Bagian A: nggak ada jawaban benar/salah. Gue cuma ukur vocabulary kamu.
- Bagian B: ini tes insting. Salah di sini wajar banget buat yang "0 banget".
- Bagian C: ini yang menentukan titik mulai. Kalau 15 nggak kelar dalam 3 jam, berarti kita mulai dari Fundamental PHP dulu, bukan Laravel.
