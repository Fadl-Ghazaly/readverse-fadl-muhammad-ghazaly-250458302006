![Readverse](./Screenshoot/Logo1.png) – Aplikasi Web Baca Novel & Webtoon



Readverse adalah aplikasi web untuk membaca novel/webtoon dengan fitur lengkap seperti manajemen novel, episode, halaman, komentar, bookmark, rating, dan laporan konten.
Dibangun menggunakan Laravel 11, MySQL, serta template NiceAdmin untuk tampilan antarmuka yang modern dan responsif.

🛠 Teknologi yang Digunakan
🔧 Framework & Backend

Laravel 11
https://laravel.com/

Laravel Breeze
https://laravel.com/docs/master/starter-kits#laravel-breeze

PHP 8.3+
https://www.php.net/

MySQL / MariaDB
MySQL: https://www.mysql.com/

MariaDB: https://mariadb.org/

🎨 Frontend

NiceAdmin Template
https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/

Bootstrap 5
https://getbootstrap.com/

JavaScript ES6
https://developer.mozilla.org/en-US/docs/Web/JavaScript

🧰 Tools Pendukung

Composer
https://getcomposer.org/

Node.js & NPM
https://nodejs.org/


📥 Instalasi
Prasyarat

Pastikan perangkat Anda telah menginstal:

PHP 8.3+

Composer

NPM 

MySQL 

Langkah Instalasi

Clone repository

git clone https://github.com/username/readverse.git
cd readverse


Buat file .env

cp .env.example .env


Install dependencies PHP

composer install


Generate APP_KEY

php artisan key:generate --ansi


Install dependency frontend

npm install
npm run build


Migrasi database

php artisan migrate


Jalankan server

php artisan serve

🌱 Seeder (Opsional)

Jalankan untuk membuat data awal:

php artisan db:seed

✨ Fitur – User
Fitur	Deskripsi
📖 Membaca Novel	Membaca novel atau webtoon secara online
⭐ Bookmark Novel	Menyimpan novel favorit
👍 Like & Rating	Memberi suka dan rating
💬 Komentar & Balasan	Interaksi antar pembaca
🚨 Lapor Konten	Melaporkan novel bermasalah
🔔 Notifikasi	Update komentar, episode baru, dll
👤 Kelola Profil	Edit nama, avatar, dan bio
🛠 Fitur – Admin
Fitur	Deskripsi
📚 Kelola Novel	Tambah, edit, hapus novel
🗂 Kelola Genre	Kelola kategori novel
📑 Kelola Episode	Tambah episode & halaman
🖼 Kelola Halaman	Upload gambar per halaman
📝 Moderasi Komentar	Hapus komentar bermasalah
🚨 Tindak Laporan	Menangani report user
🔍 Monitoring Sistem	Dashboard analitik
📸 Pratinjau Website
🔐 Halaman Login

📊 Dashboard Admin

📚 Daftar Novel

📄 Episode Viewer

💬 Sistem Komentar

⭐ Bookmark

📂 Struktur Fitur Utama
/novels
  /episodes
    /pages
/comments
/bookmarks
/reports
/notifications

🤝 Kontribusi

Pull request dan saran sangat diterima!
Silakan fork dan kembangkan sesuai kebutuhan Anda.

💖 Dukungan

Jika proyek ini bermanfaat, Anda bisa mendukung dengan memberikan ⭐ star di GitHub!

📜 Lisensi

Proyek ini menggunakan lisensi MIT.
