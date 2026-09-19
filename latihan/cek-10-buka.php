<?php
declare(strict_types=1);

// ============================================================
// SESI TERKAIT : sesi/006-form-crud.md
// STATUS       : ALAT PENGECEKAN, bukan tugas
//
// Simulasi buka halaman dari browser (request GET).
//
// Kenapa perlu file ini? Karena kalau file PHP dijalankan langsung
// dari terminal (`php 10-form.php`), PHP TIDAK mengisi $_SERVER.
// Di dunia nyata (lewat browser/server), $_SERVER selalu ada isinya.
// Jadi file ini menyiapkan $_SERVER dulu supaya pemeriksaannya persis
// seperti kondisi sungguhan.
// ============================================================

$_SERVER["REQUEST_METHOD"] = "GET";

include __DIR__ . "/10-form.php";
