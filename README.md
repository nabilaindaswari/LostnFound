# LostnFound

Platform web **lost and found** untuk lingkungan kampus. Pengguna dapat melaporkan barang temuan maupun barang hilang, mencari barang, dan melakukan verifikasi kepemilikan sebelum informasi kontak pelapor ditampilkan.

Proyek ini dibuat sebagai tugas Mata Kuliah Pemrograman Web dengan framework Laravel.

* __NABILA INDASWARI__
* __D1041241021__

## Fitur Utama

- **Autentikasi pengguna** — registrasi (nama, NIM, email, nomor telepon) dan login. NIM dan email bersifat unik sehingga satu mahasiswa hanya memiliki satu akun.
- **Barang temuan (`found`)** — pelapor mengunggah satu foto dan menyusun 4 pertanyaan verifikasi, masing-masing dengan 3 pilihan jawaban. Deskripsi barang sengaja dibuat umum agar tidak membocorkan jawaban.
- **Klaim barang** — pencari menjawab 4 pertanyaan. Jawaban harus seluruhnya benar untuk melihat kontak pelapor dan informasi pengambilan (`kept_by`: barang disimpan di mana, oleh siapa, dan siapa yang boleh mengambil). Maksimal 2 percobaan per barang, tidak dapat mengklaim barang sendiri, dan klaim ditolak bila status postingan sudah `done` atau `closed`.
- **Barang hilang (`lost`)** — pemilik membuat postingan tanpa pertanyaan verifikasi. Kontak pemilik langsung dapat dilihat oleh pengguna yang sudah login.
- **Status postingan** — `open`, `claimed`, `done`, dan `closed`. Postingan yang dihapus memakai *soft delete* sehingga datanya tetap tersimpan.
- **Pencarian dan filter** — pencarian berdasarkan nama atau deskripsi barang, serta filter kategori dan lokasi kampus.
- **Panel admin** — memantau aktivitas klaim, memblokir pengguna, dan mengelola seluruh postingan.
- **Penonaktifan akun** — pengguna diblokir lewat kolom `banned_at`, tidak pernah dihapus, supaya postingan dan riwayat klaim tetap tersimpan. Di tampilan publik identitasnya diganti pesan "Pengguna telah dinonaktifkan" disertai disclaimer bahwa interaksi di luar aplikasi menjadi tanggung jawab pengguna.

Per 20 Nov 2026, fondasi database sudah siap. Fitur autentikasi, postingan, klaim, pencarian, dan panel admin masih dikembangkan secara bertahap.

## Teknologi

- PHP 8.2 ke atas
- Laravel 12
- MySQL
- Tailwind CSS v4 melalui Vite
- Alpine.js
- Composer dan npm

## Instalasi

1. Pastikan PHP minimal 8.2, Composer, Node.js/npm, dan MySQL sudah tersedia. Pada lingkungan lokal, MySQL dapat dijalankan melalui Laragon.
2. Buat database MySQL dengan nama `lostnfound`.
3. Clone repository lalu masuk ke direktori proyek:

   ```bash
   git clone <url-repository> LostnFound
   cd LostnFound
   ```

4. Install dependency PHP dan JavaScript:

   ```bash
   composer install
   npm install
   ```

5. Salin file `.env.example` menjadi `.env`, lalu buat kunci aplikasi:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Pada Windows, perintah salin dapat ditulis `copy .env.example .env`.

6. Atur koneksi database di file `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_DATABASE=lostnfound
   ```

   Isi `DB_USERNAME` dan `DB_PASSWORD` sesuai konfigurasi MySQL lokal Anda.

7. Jalankan migrasi tabel:

   ```bash
   php artisan migrate
   ```

   Tambahkan opsi `--seed` jika ingin mengisi data awal: `php artisan migrate --seed`.

8. Buat symbolic link untuk folder penyimpanan foto:

   ```bash
   php artisan storage:link
   ```

9. Build aset frontend untuk produksi:

   ```bash
   npm run build
   ```

## Menjalankan Aplikasi

Jalankan server Laravel dan Vite dalam dua terminal terpisah:

```bash
php artisan serve
npm run dev
```

Selanjutnya buka `http://127.0.0.1:8000` di browser.

Sebagai alternatif, satu perintah berikut menjalankan server web, queue worker, pencatat log, dan Vite secara bersamaan:

```bash
composer dev
```

## Perintah Berguna

| Perintah | Fungsi |
|---|---|
| `php artisan migrate:fresh --seed` | Mengulang seluruh migrasi dan mengisi data awal dari awal |
| `php artisan test` | Menjalankan seluruh test |
| `php artisan test --filter=nama_test` | Menjalankan satu test tertentu |
| `npm run build` | Membuild aset frontend untuk produksi |
| `vendor/bin/pint` | Merapikan format kode PHP |

## Tabel Progress

| No | Tanggal | Milestone | Catatan dan hal yang berubah |
|----|---------|-----------|------------------------------|
| 1 | 9–11 Nov 2026 | Inisialisasi | Inisialisasi Laravel 12, rancangan database dan palet warna, layout dasar Tailwind, pemisahan `head`/`layout` menjadi komponen, serta menu navigasi responsif. |
| 2 | 16–20 Nov 2026 | Tahap 0 | Cleanup skeleton: hapus komponen kosong, SASS, CSS lama, dan dependency Bootstrap; Tailwind v4 diaktifkan lewat Vite; palet dipindah ke `@theme`; brand diambil dari `config('app.name')`. |
| 3 | 20 Nov 2026 | Tahap 1 | Migration domain: `users` (NIM, phone, role, `banned_at`) serta tabel `categories`, `locations`, `items`, `item_questions`, dan `claims`. Kolom `kept_at` diganti `kept_by`. |
| 4 | | Tahap 2 | Belum dikerjakan |
| 5 | | Tahap 3–11 | Belum dikerjakan |
| 6 | | Tahap akhir | Belum dikerjakan |

## Rancangan Database

Struktur tabel, relasi, dan aturan bisnis aplikasi dijelaskan lebih lengkap di file `rancangan.md`.
