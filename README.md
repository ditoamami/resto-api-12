# 🍽️ Restaurant POS API (Laravel)

Aplikasi **Point of Sale (POS)** sederhana berbasis **Laravel REST API**, digunakan untuk mengelola menu, pesanan, meja, dan pengguna (pelayan & kasir).

---

## 🚀 Fitur Utama

- **Autentikasi & Role**
  - Login menggunakan email & password.
  - Role: `pelayan`, `kasir`, `admin`.
- **Manajemen Menu**
  - Tambah, ubah, hapus menu (makanan, minuman, snack).
  - Soft delete dengan relasi aman ke `order_items`.
- **Manajemen Order**
  - Pelayan membuat pesanan (open → paid → closed).
  - Kasir dapat menghasilkan **PDF Receipt**.
- **Manajemen Meja**
  - Status meja: `available`, `occupied`, `reserved`, `inactive`.
- **Seeder Otomatis**
  - Contoh data untuk user, menu, dan meja.

---

## 🧱 Persyaratan Sistem

| Komponen | Versi Minimum |
|-----------|----------------|
| PHP | 8.1 |
| Composer | 2.x |
| Laravel | 10.x |
| MySQL / MariaDB | 5.7 / 10.4 |

---

## ⚙️ Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/username/restaurant-pos-api.git
   cd restaurant-pos-api
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Salin & Konfigurasi `.env`**
   ```bash
   cp .env.example .env
   ```
   Sesuaikan pengaturan database di `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=resto_pos
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate Key Aplikasi**
   ```bash
   php artisan key:generate
   ```

5. **Jalankan Migration & Seeder**
   ```bash
   php artisan migrate --seed
   ```
   Seeder akan menambahkan data:
   - 4 user (`pelayan` & `kasir`)
   - beberapa meja (`book_tables`)
   - contoh menu (`menus`)

6. **Jalankan Server**
   ```bash
   php artisan serve
   ```
   Akses di:  
   👉 `http://127.0.0.1:8000`

---

## 🔑 Autentikasi API

Gunakan **token-based auth (Laravel Sanctum)** untuk mengamankan API.

### Login Endpoint
```
POST /api/login
```
**Body:**
```json
{
  "email": "andi@resto.com",
  "password": "andi"
}
```
**Response:**
```json
{
  "user": {
    "id": 1,
    "name": "Andi Pelayan",
    "role": "pelayan"
  },
  "token": "1|abc123..."
}
```

Gunakan token pada header:
```
Authorization: Bearer <token>
```

---

## 📘 API Endpoint Utama

| Resource | Method | Endpoint | Deskripsi |
|-----------|--------|-----------|------------|
| **Menu** | GET | `/api/menus` | List semua menu |
| | POST | `/api/menus` | Tambah menu |
| | PUT | `/api/menus/{id}` | Update menu |
| | DELETE | `/api/menus/{id}` | Soft delete menu |
| **Order** | GET | `/api/orders` | List pesanan |
| | POST | `/api/orders` | Buat pesanan baru |
| | PUT | `/api/orders/{id}/pay` | Ubah status jadi *paid* |
| | GET | `/api/payments/{id}/receipt` | Download PDF Receipt |
| **Table** | GET | `/api/book-tables` | List meja |
| | PUT | `/api/book-tables/{id}` | Update status meja |

---

## 👥 User Default

| Nama | Email | Role | Password |
|------|--------|-------|-----------|
| Andi Pelayan | `andi@resto.com` | pelayan | andi |
| Budi Pelayan | `budi@resto.com` | pelayan | budi |
| Citra Kasir | `citra@resto.com` | kasir | citra |
| Dewi Kasir | `dewi@resto.com` | kasir | dewi |

---

## 🧰 Tips Pengembangan

- Gunakan **Postman / Thunder Client** untuk uji endpoint.
- Jalankan perintah berikut untuk memperbarui DB tanpa data lama:
  ```bash
  php artisan migrate:fresh --seed
  ```
- Pastikan file `.env` memiliki:
  ```
  APP_DEBUG=true
  LOG_CHANNEL=stack
  ```

---

## 🧾 Lisensi

Proyek ini menggunakan lisensi **MIT License** — bebas digunakan dan dimodifikasi untuk kebutuhan pengembangan.
