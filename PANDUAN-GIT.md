# PANDUAN GIT: PULL & PUSH
Baca ini sekali, hafal 4 perintah, sisanya cuma kebiasaan.

## Aturan pembagian tugas (ini yang bikin kita NGGAK pernah bentrok)
- **Kamu** cuma edit file di folder `latihan/`
- **Gue** edit folder `sesi/`, `log/`, dan file di root
- Jadi kita nggak akan nabrak file yang sama

## SEKALI SAJA: clone repo ke laptop
```
git clone https://github.com/Zahaby18/belajar-dari-awal.git
cd belajar-dari-awal
```
Kalau di laptop belum ada git:
- Windows: download Git for Windows (git-scm.com)
- Mac: buka Terminal, ketik `git --version` (biasanya udah ada, kalau nggak: install Xcode Command Line Tools)
- Linux: `sudo apt install git`

Setelah clone, repo kamu udah terhubung ke GitHub. Nggak perlu setup apa-apa lagi.

---

## SETIAP KAMU MAU MULAI BELAJAR (1 perintah)
```
git pull
```
Ini narik materi/update terbaru dari gue. **Lakukan ini SEBELUM mulai nulis kode**, biar kamu nggak ketinggalan materi dan nggak bentrok.

## SETIAP SELESAI NGERJAIN LATIHAN (3 perintah)
```
git add -A
git commit -m "sesi 001: tugas 1-3"
git push
```
Arti tiap perintah:
- `git add -A` = "tandai semua perubahan di folder ini buat disimpan"
- `git commit -m "..."` = "simpan sebagai satu titik riwayat, dengan catatan ini"
- `git push` = "kirim ke GitHub"

Pesan commit yang benar: **jelasin APA yang kamu kerjakan**, bukan "update" atau "fix".
- Bagus: `sesi 001: tugas 1-3 (variable, hitung, if)`
- Jelek: `update`, `revisi`, `asdf`

## RUTINITAS HARIAN (cuma ini)
```
# sebelum mulai
git pull

# ...kerja...

# setelah selesai
git add -A && git commit -m "pesan" && git push
```

---

## Kalau muncul masalah

**"Authentication failed" / disuruh login**
GitHub nggak nerima password biasa. Kamu harus pakai **Personal Access Token (PAT)**:
1. github.com → klik foto profil → Settings → Developer settings → Personal access tokens → Tokens (classic) → Generate new token
2. Centang scope `repo`
3. Copy tokennya (cuma muncul sekali)
4. Saat git minta password, paste token itu
5. Supaya disimpan permanen: `git config --global credential.helper store`

**"Updates were rejected because the remote contains work you do not have"**
Artinya: ada update dari gue yang belum kamu tarik. Solusinya:
```
git pull
git push
```
Kalau tetap nolak dan bilang "divergent branches":
```
git config pull.rebase false
git pull
git push
```

**"nothing to commit, working tree clean"**
Artinya: nggak ada yang berubah, kamu belum nyimpen file apa-apa, atau file-nya udah kestore dari sebelumnya. Cek dengan `git status`.

**"CONFLICT" / "merge conflict"**
Terjadi kalau kita kompak ngedit file yang sama. Kabarin gue, jangan diutak-atik sendiri. Kita selesaikan bareng, dan itu pengalaman belajar yang bagus (merge conflict itu realita kerja tim).

## Cara cek status kapan pun
```
git status      # apa yang berubah
git log --oneline   # riwayat commit kamu
```

## Nggak mau ribet ketik 3 perintah?
Bikin alias sekali, lalu tinggal ketik `kirim "pesan"`:
```
git config --global alias.kirim '!f() { git add -A && git commit -m "$1" && git push; }; f'
```
Pemakaian: `git kirim "sesi 001: tugas 1-3"`
(Gue tetep saranin kamu ketik 3 perintah aslinya selama sebulan pertama, biar ngerti yang terjadi.)
