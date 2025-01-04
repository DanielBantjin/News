# README Proyek Manajemen Artikel

---

## **Ikhtisar Proyek**

Proyek ini adalah sistem manajemen artikel berbasis web yang dibangun menggunakan framework Laravel. Sistem ini memungkinkan pengguna untuk membuat, mengedit, mempublikasikan, dan menghapus artikel. Fitur tambahan mencakup penandaan (tagging), kategorisasi, dan penyaringan artikel berdasarkan berbagai kriteria. Sistem juga menyediakan antarmuka publik untuk menampilkan artikel yang telah dipublikasikan, tag yang sedang tren, dan berita terbaru.

---

## **Fitur**

- **Autentikasi Pengguna:**
  - Pengguna harus login untuk membuat, mengedit, atau menghapus artikel.
  - Artikel dikaitkan dengan pengguna yang sedang login.

- **Manajemen Artikel:**
  - **Membuat Artikel:** Pengguna dapat membuat artikel baru dengan judul, konten, kategori, tag, dan gambar opsional.
  - **Mengedit Artikel:** Pengguna dapat memperbarui judul, konten, kategori, dan gambar artikel mereka.
  - **Menghapus Artikel:** Pengguna dapat menghapus artikel mereka, termasuk gambar terkait.
  - **Mempublikasikan Artikel:** Artikel dapat dipublikasikan atau disimpan sebagai draf. Artikel yang dipublikasikan tersedia untuk publik.

- **Penyaringan dan Pengurutan:**
  - Artikel dapat disaring berdasarkan kategori, status (draf/dipublikasikan), dan dicari berdasarkan judul atau konten.
  - Artikel dapat diurutkan berdasarkan tanggal pembuatan (terbaru atau terlama).

- **Antarmuka Publik:**
  - **Halaman Beranda:** Menampilkan berita terbaru (artikel yang baru dipublikasikan), tag yang sedang tren, dan artikel paling banyak dilihat.
  - **Tampilan Artikel:** Pengguna dapat melihat artikel individu, dan jumlah tampilan artikel akan bertambah setiap kali dilihat.

- **Sistem Tagging:**
  - Artikel dapat diberi beberapa tag.
  - Tag yang sedang tren ditampilkan berdasarkan jumlah artikel yang menggunakan tag tersebut.

- **Unggah Gambar:**
  - Artikel dapat menyertakan gambar opsional yang disimpan di direktori penyimpanan publik.

---

## **Instalasi**

### 1. **Clone Repository**
```bash
git clone https://github.com/username/proyek-manajemen-artikel.git
cd proyek-manajemen-artikel
```

### 2. **Install Dependencies**
Pastikan Anda telah menginstal Composer (dependency manager untuk PHP). Jalankan perintah berikut untuk menginstal semua dependensi:
```bash
composer install
```

### 3. **Konfigurasi Environment**
Salin file `.env.example` dan ubah namanya menjadi `.env`:
```bash
cp .env.example .env
```
Buka file `.env` dan sesuaikan konfigurasi database, seperti nama database, username, dan password:
```
DB_DATABASE=nama_database
DB_USERNAME=username_database
DB_PASSWORD=password_database
```
Generate application key:
```bash
php artisan key:generate
```

### 4. **Migrasi Database**
Jalankan migrasi untuk membuat tabel-tabel yang diperlukan di database:
```bash
php artisan migrate
```
(Opsional) Jika Anda ingin mengisi database dengan data dummy, jalankan seeder:
```bash
php artisan db:seed
```

### 5. **Konfigurasi Penyimpanan Gambar**
Buat symbolic link untuk mengakses gambar yang diunggah:
```bash
php artisan storage:link
```

### 6. **Jalankan Server Lokal**
Jalankan server lokal Laravel:
```bash
php artisan serve
```
Buka browser dan akses `http://localhost:8000` untuk melihat aplikasi.

### 7. **(Opsional) Konfigurasi Tambahan**
- Untuk menggunakan fitur email (misalnya, untuk reset password), sesuaikan konfigurasi email di file `.env`.
- Jika Anda ingin menggunakan cache atau queue, pastikan untuk mengonfigurasi driver yang sesuai di file `.env`.

---

## **Cara Penggunaan**

- **Membuat Artikel:**
  1. Navigasikan ke halaman "Buat Artikel".
  2. Isi judul, konten, kategori, dan tag.
  3. Opsional, unggah gambar.
  4. Simpan artikel sebagai draf atau publikasikan langsung.

- **Mengedit Artikel:**
  1. Buka "Artikel Saya" dan pilih artikel yang ingin diedit.
  2. Perbarui judul, konten, kategori, atau gambar.
  3. Simpan perubahan.

- **Menghapus Artikel:**
  1. Buka "Artikel Saya" dan pilih artikel yang ingin dihapus.
  2. Konfirmasi penghapusan.

- **Melihat Artikel:**
  - Artikel yang dipublikasikan dapat dilihat di halaman beranda atau dengan mengunjungi URL artikel secara langsung.

---

## **Dependensi**

- **Laravel:** Framework PHP yang digunakan untuk membangun aplikasi.
- **Bootstrap:** Framework front-end untuk styling.
- **MySQL:** Database yang digunakan untuk menyimpan artikel, kategori, tag, dan informasi pengguna.

