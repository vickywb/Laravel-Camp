# Laravel-Camp

Platform pemesanan camp online dengan sistem pembayaran terintegrasi. Aplikasi ini memungkinkan user untuk browsing berbagai pilihan camp, melihat benefit/fasilitas, melakukan checkout, dan membayar menggunakan Midtrans.

## 🚀 Fitur Utama

### Authentication & Authorization

- OAuth Login (Google & Facebook) dengan Laravel Socialite
- Manual Login & Register dengan validasi email
- Role-Based Access Control (Admin & Member)
- Email Verification

### Core Features

- **Repository Pattern** untuk clean architecture
- **Eloquent ORM** dengan relasi database yang kompleks
- **Camp Management** - CRUD camps dan benefits
- **Checkout System** - proses pemesanan lengkap
- **Payment Integration** - Midtrans gateway
- **Discount/Promo System** - manajemen diskon untuk camps
- **Transaction History** - tracking pembelian user
- **Admin Dashboard** - dashboard admin terpisah
- **File Upload** - auto-download OAuth avatar, upload dokumen
- **User Profile** - profil dan occupasi user
- **Email Notifications** - notifikasi otomatis
- **API Sanctum** - token-based authentication

## 🛠️ Tech Stack

- **Backend**: Laravel 10
- **PHP**: 8.3+
- **Database**: MySQL/MariaDB
- **Frontend**: Blade Template, Laravel UI
- **Payment**: Midtrans PHP SDK
- **Authentication**: OAuth (Google, Facebook), Laravel Sanctum
- **Other**: Socialite, Laravel Mix

## ⚙️ Installation

1. **Clone repository dan install dependencies**

    ```bash
    composer install
    npm install
    ```

2. **Generate application key**

    ```bash
    php artisan key:generate
    ```

3. **Setup environment variables**
    - Copy `.env.example` ke `.env`
    - Set database credentials
    - Set OAuth credentials (Google & Facebook)
    - Set Midtrans API keys

4. **Run migrations**

    ```bash
    php artisan migrate
    ```

5. **Seed database**

    ```bash
    php artisan db:seed
    ```

6. **Build assets**

    ```bash
    npm run dev
    ```

7. **Start development server**
    ```bash
    php artisan serve
    ```

## 🔐 User Roles

- **Admin (Role 1)**: Kelola camps, benefits, discounts, transaksi
- **Member (Role 2)**: Browse camps, booking, checkout, pembayaran
