# 🎫 PROJECT : EVENTHUB
EventHub adalah aplikasi berbasis web yang dibangun menggunakan **Laravel** untuk mempermudah pengelolaan dan pemesanan tiket event (konser, seminar, workshop). 
Aplikasi ini memiliki dua peran utama: Pengunjung (User) dan Administrator.

-----

## 👥 Identitas Proyek

| Kategori | Keterangan |
| :--- | :--- |
| **Mata Kuliah** | Implementasi dan Pengujian PL (IMPAL) |
| **Kelompok** | IMPAL-02-05 |
| **Semester** | 5 (2025) |
| **Fokus** | Web Development, MVC Architecture, Database Management |

👥 Anggota 
| Nama | Nim |
| :--- | :--- |
| Nicholas Aditya R. | 1203230080 |
| Arya Maulana | 1203230120 |
| Mukhlis Zahrawani S. | 1203230065 |
| Muamar Haikal F. | 1203230118 |
| Ahmad Wahyudi | 1203230116 |
-----

## 🛠️ Tech Stack (Teknologi)

| Area | Teknologi |
| :--- | :--- |
| **Backend** |   |
| **Frontend** |   |
| **Database** |  |
| **Tools & Libs** |   **QR Code Generator** |

-----
## 🚀 Fitur Utama

### 👤 Pengunjung (User)
- **Browse Event:** Melihat daftar event terbaru yang tersedia.
- **Search:** Mencari event berdasarkan nama atau lokasi.
- **Detail Event:** Melihat deskripsi lengkap, harga, dan sisa tiket.
- **Registrasi/Login:** Membuat akun untuk memesan tiket.

### 🛡️ Admin
- **Dashboard:** Ringkasan data event.
- **Manajemen Event (CRUD):** Menambah, mengedit, dan menghapus event.
- **Upload Gambar:** Menambahkan poster event.
- **Manajemen Stok:** Mengatur harga dan jumlah tiket.

-----

## 🛠️ Teknologi yang Digunakan

- **Backend:** Laravel (PHP Framework)
- **Frontend:** Blade Templates, Bootstrap 5 (via SASS)
- **Build Tool:** Vite
- **Database:** MySQL
- **Bahasa Pemrograman:** PHP 8.2+

-----
## ⚙️ Cara Instalasi (Installation Guide)

Ikuti langkah-langkah ini agar website berjalan dengan lancar tanpa error tampilan atau database.

### 1. Clone Repository
```bash
git clone [https://github.com/username-anda/EventHub.git](https://github.com/username-anda/EventHub.git)
cd EventHub
```
### 2. Install Dependencies
Install library PHP dan JavaScript yang dibutuhkan.
```Bash
composer install
npm install
```
### 3. Konfigurasi Environment (.env)
File .env tidak disertakan di GitHub demi keamanan, jadi Anda harus membuatnya ulang.
```
cp .env.example .env
```
Buka file .env dan sesuaikan konfigurasi database Anda:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eventhub_db
DB_USERNAME=root
DB_PASSWORD=
```
PENTING: Pastikan APP_URL sesuai dengan port server Anda (biasanya 8000).
```
APP_URL=[http://127.0.0.1:8000](http://127.0.0.1:8000)
```
### 4. Generate Key & Database
```
php artisan key:generate
php artisan migrate
```
Jika muncul error "Table sessions not found", jalankan:
```
php artisan make:session-table
php artisan migrate
```
### 5. Build Frontend
Agar tampilan website tidak berantakan :
```
npm run build
```
### 6. Jalankan Aplikasi
```
php artisan serve
```
Buka browser dan akses: 
```
http://127.0.0.1:8000
```
-----

## 🔐 Akun Demo

Gunakan akun berikut untuk pengujian:

**1. Administrator**

  * **Email:** `admin@baru.com`
  * **Password:** `password123`

**2. User Biasa**

  * Silakan daftar akun baru melalui menu **Register**.

-----

> **Copyright © 2025 EventHub.**
> *Dibuat dengan ❤️ dan Kopi untuk Tugas Besar Informatika.*
