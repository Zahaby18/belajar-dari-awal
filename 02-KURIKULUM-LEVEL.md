# KURIKULUM: Level 0 -> Senior (Jago Banget)
Bukan daftar materi. Ini daftar **gerbang**: kamu naik level kalau bisa lewatin tes gerbangnya, bukan kalau materinya selesai ditonton.

Estimasi jam fokus (jujur, bukan marketing):
- Level 0 -> 1 (hireable junior): ~240 jam
- Level 1 -> 2 (mid, kerja mandiri): ~400 jam tambahan
- Level 2 -> 3 (senior, dipercaya desain sistem): ~600 jam tambahan
- Level 3 -> 4 (jago banget / architect, jadi rujukan orang): ~800 jam tambahan

Total ke "jago banget": **~2.000 jam fokus**.
Di 2 hari/minggu x 4 jam = 8 jam/minggu -> ~4,8 tahun. **Ini angka sebenarnya.**
Di 5 hari/minggu x 4 jam = 20 jam/minggu -> ~2 tahun.
Nggak ada jalan pintas yang jujur. Yang bisa dipercepat cuma kualitas jamnya, bukan jumlahnya.

---

## LEVEL 0: Fundamental (fondasi yang bikin kamu nggak tersesat)
**Isi:** terminal/Linux CLI, Git, HTTP/REST, SQL & relasi, PHP OOP modern, JavaScript ES6+, HTML/CSS, debugging.
**Gerbang naik ke Level 1** (semua harus "iya", tanpa buka Google):
1. Bikin CRUD pakai PHP murni + PDO + SQL, dari nol, tanpa framework, tanpa tutorial
2. Nulis JOIN 3 tabel sendiri dan jelasin hasilnya
3. Bikin + perbaiki merge conflict di Git
4. Jelasin kenapa `===` lebih aman dari `==`
5. Deploy 1 file PHP yang jalan ke server sendiri
**Kalau gerbang ini gagal, Laravel cuma akan jadi hafalan, bukan skill.**

## LEVEL 1: Employable (bisa dibayar untuk bikin fitur)
**Isi:** Laravel (routing, Eloquent, migration, validation, auth, Policy, Queue), Blade/Tailwind, front-end pilih satu (React+TS atau Vue), Pest, Composer/Vite, deploy + env, Docker dasar, Git flow tim.
**Gerbang naik ke Level 2:**
1. App Laravel punya test (min 25) yang jalan di CI, bukan cuma di laptop
2. Bisa jelasin dan perbaiki N+1 query di kode sendiri
3. Bisa bikin form + validasi + otorisasi (siapa boleh akses apa) tanpa contoh
4. Bisa baca log produksi dan menemukan penyebab 500
5. Ada 1 app live + 1 PR merged di repo orang lain (open source)
**Di titik ini kamu bisa lamar kerja. Target: junior-mid Rp 5-13 jt.**

## LEVEL 2: Independent (nggak perlu disuapin)
**Isi:** arsitektur aplikasi (Service/Action/Repository), transaksi DB & race condition, caching (Redis), queue + worker + retry, job gagal dan idempotency, testing pyramid (unit/feature/E2E), static analysis level tinggi, refactoring kode jelek, observability (log/monitoring), performance (query, index, cache, front-end), API design (versioning, pagination, rate limit), keamanan (OWASP: XSS, CSRF, SQL injection, IDOR, secret handling), Docker produksi, CI/CD penuh.
**Gerbang naik ke Level 3:**
1. Bisa ambil fitur ambigu dari produk dan pecah jadi task teknis sendiri
2. Bisa bikin keputusan teknis + jelasin trade-off-nya ke non-teknis
3. Pernah benerin bug produksi yang cuma muncul sekali sejuta request (race condition / timeout / memory)
4. Bisa review PR orang lain dan ketemu masalah sebelum masuk produksi
5. Optimasi aplikasi sampai jelas angkanya (before/after ms, jumlah query)
**Di titik ini kamu dipercaya pegang fitur besar. Target: mid-senior Rp 13-22 jt.**

## LEVEL 3: Senior (yang dimintain tolong)
**Isi:** system design (skalabilitas, load balancing, sharding, message broker), domain modeling & DDD praktis, multi-tenant SaaS, integrasi payment/third-party yang rapi, migrasi data besar tanpa downtime, incident handling & postmortem, mentoring, estimasi project, legacy code rescue, AI-native features (Laravel AI SDK 13: agent, embeddings, vector search).
**Gerbang naik ke Level 4:**
1. Pernah desain sistem yang dipakai orang lain, dari nol sampai produksi
2. Pernah menangani insiden produksi dan bikin pencegahan yang bertahan
3. Kode kamu jadi rujukan orang lain (dipakai library internal / dipelajari tim)
4. Bisa nolak ide buruk dengan argumen teknis + alternatif, dan diterima

## LEVEL 4: Jago banget (rujukan)
Ciri-cirinya bukan "hafal semua", tapi:
1. Bisa belajar teknologi baru dalam 1-2 minggu sampai level produktif
2. Bisa bilang "engineer ini salah" dan langsung nunjukin buktinya
3. Bisa naikin level orang lain, bukan cuma dirinya sendiri
4. Pilihan teknologinya benar bukan karena ikut tren, tapi karena trade-off
5. Punya 1-2 spesialisasi dalam yang orang lain datang ke kamu untuk itu
6. Bisa nulis dokumentasi/keputusan teknis yang dipakai 5 tahun kemudian
**Di level ini uang datang dari reputasi, bukan melamar.**

---

## Aturan progres
- Naik level **dites**, bukan diakui sendiri. Gue kasih tugas, kamu kerjain tanpa bantuan, gue nilai.
- Kalau gagal gerbang: ngulang bagian yang gagal, bukan lanjut materi baru.
- Kalau 3 sesi berturut-turut nggak ada commit: gue stop kasih materi sampai kamu mulai nulis kode. (Ini bukan hukuman, ini cara kerja mentor 20 tahun: coder tumbuh dari kode, bukan dari catatan.)
