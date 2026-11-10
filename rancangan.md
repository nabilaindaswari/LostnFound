color palet : 
#c3e978  (hint)
#f3f6ff 
#8ec1ff
#3770bf
#0055a6

**#RANCANGAN DATABASE**
database lost and found kampus

# USERS
01. id
02. name
03. nim (boleh kosong, untuk admin)
04. email
05. phone
06. role
07. password
08. banned_at
09. email_verified_at (bawaan laravel)
10. remember_token (bawaan laravel)
11. created_at, updated_at

terdapat dua role, yaitu user dan admin.
- user : general user
- admin : admin

nim dan email tidak boleh kembar, biar satu mahasiswa cuma punya satu akun.
banned_at diisi kalau user diblokir admin, user tidak dihapus supaya postingan dan riwayat klaimnya tetap ada.

	a. searcher
: mencari postingan barang temuan. untuk mendapatkan informasi pelapor, searcher harus menjawab 4 pertanyaan terkait detail barang, jawaban harus 100% benar. maksimal 2x percobaan per barang.

	b. reporter
: membuat postingan barang temuan atau barang hilang.

searcher dan reporter bukan role, satu user bisa jadi keduanya.

	c. admin
: memantau aktivitas mencurigakan, mendapatkan informasi user, memblokir user, menghapus postingan, dll.


# CATEGORIES
01. id
02. code
03. name

elec : Elektronik
food : Makanan
acce : Aksesoris
clot : Pakaian
bagg : Tas & Koper
docu : Dokumen & Kartu Identitas
keys : Kunci
jwls : Perhiasan & Barang Berharga
book : Buku & Alat Tulis
spor : Perlengkapan Olahraga
medi : Obat-obatan & Kesehatan
cosm : Kosmetik & Perawatan Diri
toys : Mainan & Hobi
tool : Perkakas & Alat Tukang
misc : Lain-lain / Serbaguna


# LOCATIONS
01. id
02. code
03. name

fh : Fakultas Hukum
feb : Fakultas Ekonomi dan Bisnis
faperta : Fakultas Pertanian
ft : Fakultas Teknik
fisip : Fakultas Ilmu Sosial dan Ilmu Politik
fkip : Fakultas Keguruan dan Ilmu Pendidikan
fahutan : Fakultas Kehutanan
fmipa : Fakultas Matematika dan Ilmu Pengetahuan Alam
fk : Fakultas Kedokteran
gkba : Gedung Kuliah Bersama A
gkbb : Gedung Kuliah Bersama B
rkt : Gedung Rektorat
knf : Gedung Konferensi
st : Jalanan
prp : Perpustakaan
kys : Kiyosu


# ITEMS
01. id
02. type
03. user_id
04. category_id
05. location_id
06. name
07. description
08. location_detail
09. event_date
10. kept_at
11. photo
12. status
13. created_at, updated_at
14. deleted_at

type ada dua:
- found : barang temuan
- lost : barang hilang

event_date = tanggal ketemu (found) atau tanggal hilang (lost).
kept_at = barang disimpan di mana, cuma untuk found. bersifat rahasia, baru muncul setelah klaim berhasil.
description harus umum, jangan tulis detail yang jadi jawaban pertanyaan.
photo cuma satu. wajib untuk found, opsional untuk lost.
deleted_at untuk soft delete, postingan yang dihapus admin cuma disembunyikan.

status:
- open : baru diposting
- claimed : sudah ada minimal 1 orang yang jawab benar (found). orang lain tetap bisa coba klaim.
- done : barang sudah kembali ke pemiliknya, diubah oleh pembuat postingan.
- closed : postingan ditutup tanpa selesai (dibatalkan pembuat atau dihapus admin). bisa difilter di halaman admin.


# barang hilang (lost)
: dibuat oleh pemilik barang. tidak pakai pertanyaan dan klaim, kontak pemilik langsung kelihatan oleh user yang sudah login. pemilik ngecek sendiri barangnya waktu ketemu, lalu ubah status jadi done.


# ITEM_QUESTIONS
01. id
02. item_id
03. order
04. question
05. option_a
06. option_b
07. option_c
08. correct_option

satu barang found punya 4 pertanyaan (order 1 sampai 4).
correct_option isinya a, b, atau c. dicek di server, tidak boleh dikirim ke browser.


# CLAIMS
01. id
02. item_id
03. user_id
04. is_correct
05. correct_count
06. created_at, updated_at

dicatat setiap kali searcher menjawab pertanyaan.
- maksimal 2x per user per barang
- tidak bisa klaim barang sendiri
- user yang diblokir tidak bisa klaim
- tidak bisa klaim kalau status sudah done atau closed
- klaim benar pertama mengubah status dari open jadi claimed

kalau benar, searcher dapat melihat semua informasi pelapor (name, nim, email, phone) dan kept_at.
