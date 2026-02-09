# Backend Sismedika

Backend API untuk aplikasi Sismedika, dibangun menggunakan Laravel 11.

## Persyaratan Sistem

- PHP >= 8.2
- Composer
- SQLite (default database)

## Instalasi

1.  **Clone repositori** (jika belum) dan masuk ke direktori backend:
    ```bash
    cd backend
    ```

2.  **Install dependensi Composer**:
    ```bash
    composer install
    ```

3.  **Konfigurasi Environment**:
    Salin file contoh `.env` dan buat generate app key:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Setup Database**:
    Secara default, aplikasi menggunakan SQLite. Buat file database jika belum ada:
    *Linux/Mac:*
    ```bash
    touch database/database.sqlite
    ```
    *Windows (PowerShell):*
    ```powershell
    New-Item -ItemType File -Path database/database.sqlite
    ```

5.  **Migrasi dan Seeding Database**:
    Jalankan migrasi untuk membuat tabel dan seeding data awal (User, Makanan, Meja):
    ```bash
    php artisan migrate --seed
    ```
    
    **Akun Default untuk Testing:**
    - **Kasir:** `hanifkasir@mail.com` / `password`
    - **Pelayan:** `hanifwaiter@mail.com` / `password`

6.  **Jalankan Server**:
    ```bash
    php artisan serve
    ```
    Server akan berjalan di `http://localhost:8000`.

## Dokumentasi API

Berikut adalah beberapa endpoint utama yang tersedia:

### Autentikasi
- `POST /api/login`: Login pengguna.

### Meja (Public)
- `GET /api/table`: Mendapatkan daftar semua meja.

### Fitur Terproteksi (Butuh Token Bearer)
Header: `Authorization: Bearer <token>`

- **User Profile**: `GET /api/user`
- **Makanan**: Resource penuh (`/api/food`)
- **Pesanan**:
    - `GET /api/orders`: List pesanan
    - `POST /api/orders`: Buat pesanan baru
    - `GET /api/orders/{id}`: Detail pesanan
    - `PATCH /api/orders/{id}/complete`: Tandai pesanan selesai

## Struktur Folder Utama
- `app/Http/Controllers/Api`: Logika kontroler API.
- `routes/api.php`: Definisi rute API.
- `database/migrations`: Struktur database.
