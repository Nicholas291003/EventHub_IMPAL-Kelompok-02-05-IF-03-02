# 🎫 PROJECT : EVENTHUB

> **Web Manajemen & E-Ticketing Event Terpusat**
> *Platform modern untuk pengelolaan event, penjualan tiket, dan validasi peserta berbasis QR Code.*

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

## 🗺️ Peta Fitur (Feature Map)

### 👮 Administrator (Pengelola)

  * **Dashboard Utama:** Grafik statistik *real-time* (Total Event, Tiket Terjual, Pendapatan).
  * **Manajemen Event (CRUD):** Tambah, Edit, Hapus event & upload banner.
  * **Manajemen User:** Memantau pengguna terdaftar & mengubah role user.
  * **Laporan Keuangan:** Rekapitulasi pendapatan per event dalam bentuk tabel & modal.
  * **Detail Transaksi:** Melihat siapa saja pembeli tiket untuk setiap event.

### 👤 User (Pengunjung/Peserta)

  * **Exploration:** Landing page dengan pencarian event & filter.
  * **Booking Flow:** Pembelian tiket dengan validasi stok otomatis.
  * **Tiket Saya:** Halaman khusus menampilkan tiket yang dibeli.
  * **QR Code Unik:** Setiap *single ticket* memiliki QR Code unik untuk validasi.
  * **Profil:** Ubah foto profil (avatar), username, dan password.

-----

## 🚀 Quick Start
### ⚙️ Cara Instalasi (Run Local)

Ikuti langkah-langkah berikut untuk menjalankan project ini :

**1. Clone Repository**
Masuk ke folder project:
```bash
cd eventhub
````

**2. Install Dependencies**
Install library PHP dan asset Frontend:

```bash
composer install
npm install
```

**3. Setup Environment**
Duplikat file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Buka file `.env` dan sesuaikan konfigurasi database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eventhub
DB_USERNAME=root
DB_PASSWORD=
```

**4. Generate Key & Storage**

```bash
php artisan key:generate
php artisan storage:link
```

**5. Migrasi Database**
Pastikan XAMPP/MySQL sudah jalan, lalu jalankan:

```bash
php artisan migrate --seed
```

**6. Jalankan Aplikasi**
Anda butuh dua terminal untuk menjalankan Laravel 11 (karena menggunakan Vite):

*Terminal 1 (Server PHP):*

```bash
php artisan serve
```

*Terminal 2 (Build Assets):*

```bash
npm run dev
```

Buka browser dan akses: `http://localhost:8000`

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
