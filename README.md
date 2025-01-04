README untuk Proyek Manajemen Artikel

Ikhtisar Proyek

Proyek ini adalah sistem manajemen artikel berbasis web yang dibangun menggunakan framework Laravel. Sistem ini memungkinkan pengguna untuk membuat, mengedit, mempublikasikan, dan menghapus artikel. Fitur tambahan termasuk penandaan (tagging), kategorisasi, dan penyaringan artikel berdasarkan berbagai kriteria. Selain itu, sistem ini menyediakan antarmuka publik di mana pengguna dapat melihat artikel yang telah dipublikasikan, tag yang sedang tren, dan berita terbaru.

Fitur

Autentikasi Pengguna:

Pengguna harus login untuk membuat, mengedit, atau menghapus artikel.
Artikel dikaitkan dengan pengguna yang sedang login.
Manajemen Artikel:

Membuat Artikel: Pengguna dapat membuat artikel baru dengan judul, konten, kategori, tag, dan gambar opsional.
Mengedit Artikel: Pengguna dapat memperbarui judul, konten, kategori, dan gambar artikel mereka.
Menghapus Artikel: Pengguna dapat menghapus artikel mereka, yang juga akan menghapus gambar terkait dari penyimpanan.
Mempublikasikan Artikel: Artikel dapat dipublikasikan atau disimpan sebagai draf. Artikel yang dipublikasikan dapat dilihat oleh publik.
Penyaringan dan Pengurutan:

Artikel dapat disaring berdasarkan kategori, status (draf/dipublikasikan), dan dicari berdasarkan judul atau konten.
Artikel dapat diurutkan berdasarkan tanggal pembuatan (terbaru atau terlama).
Antarmuka Publik:

Halaman Beranda: Menampilkan berita terbaru (artikel yang baru dipublikasikan), tag yang sedang tren, dan topik yang sedang tren (artikel yang paling banyak dilihat).
Tampilan Artikel: Pengguna dapat melihat artikel individu, dan jumlah tampilan artikel akan bertambah setiap kali artikel dilihat.
Sistem Tagging:

Artikel dapat diberi beberapa tag.
Tag yang sedang tren ditampilkan berdasarkan jumlah artikel yang terkait dengan setiap tag.
Unggah Gambar:

Artikel dapat menyertakan gambar opsional, yang disimpan di direktori penyimpanan publik.
