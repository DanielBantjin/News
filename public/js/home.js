// Home.js
let currentIndex = 0;

function moveSlide(step) {
    const items = document.querySelectorAll('.carousel-item');
    items[currentIndex].classList.remove('active');

    // Perbarui indeks saat ini berdasarkan step
    currentIndex = (currentIndex + step + items.length) % items.length;

    items[currentIndex].classList.add('active');
}

// Optional: Menambahkan auto-play dengan interval waktu (misal, 3 detik)
setInterval(() => {
    moveSlide(1); // Pindah ke gambar berikutnya otomatis
}, 3000);


let subMenu = document.getElementById("profileMenu");
let userPic = document.querySelector(".user-pic");

// Fungsi untuk membuka atau menutup dropdown profile
function toggleMenu(event) {
    subMenu.classList.toggle("open-menu");

    // Mencegah event klik pada gambar profile agar tidak menutup dropdown
    event.stopPropagation();
}

// Menutup dropdown saat pengguna klik di luar profile menu
document.addEventListener("click", function(event) {

    if (!userPic.contains(event.target) && !subMenu.contains(event.target)) {
        subMenu.classList.remove("open-menu");
    }
});

