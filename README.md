# News Article

---

Proyek ini adalah aplikasi berbasis web yang dirancang untuk mengelola artikel dan blog dengan mudah. Aplikasi ini menyediakan tiga menu utama, yaitu:

Beranda:

-Menampilkan berita terbaru, artikel yang dipublikasikan, dan tag yang sedang tren.

-Memberikan akses cepat ke artikel populer dan informasi terkini.

Artikel:

-Menu ini memungkinkan pengguna untuk membuat, mengedit, mempublikasikan, dan menghapus artikel.

-Artikel dapat dikategorikan, ditandai dengan tag, dan disertai gambar opsional untuk mendukung konten.

-Fitur pencarian, penyaringan, dan pengurutan membantu pengguna menemukan artikel dengan mudah.

Blog:

-Tempat untuk menampilkan kumpulan artikel berdasarkan kategori atau topik tertentu.

-Memungkinkan eksplorasi konten berdasarkan minat pengguna.

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
git clone https://github.com/DanielBantjin/News.git
cd news
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

### 4. **Migrasi Database**
Jalankan migrasi untuk membuat tabel-tabel yang diperlukan di database:
```bash
php artisan migrate
```
"Jika terjadi masalah ketika melakukan migrasi table bisa donwload database di bawah"

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
- **Tailwind & Alpine.js** Framework front-end untuk styling.
- **MySQL:** Database yang digunakan untuk pembuatan aplikasi.

Link database : https://drive.google.com/file/d/1d4hnwvQg9g9L_R2gRdgue6t3HoHiu449/view?usp=sharing

## **Contact**
      

Email: danielbancin10@gmail.com

GitHub: https://github.com/danielbantjin


@Winnicode Garuda Teknologi.
<img src="public/img/logo.png" alt="Deskripsi Gambar" width="200" />




    
    
      
    
      
    
    
      
    
      
    
    
      
    
      
    
    
      
    
