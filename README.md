<h1>SiDapur - Sistem E-commerce Produk Dapur</h1>

<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/182fcaa0-8905-48c3-b38a-25b1ffb69f76" />


SiDapur adalah aplikasi e-commerce lengkap untuk penjualan produk dapur dan kebutuhan rumah tangga, dibangun dengan Laravel 12 dan Tailwind CSS.
## 📋 Fitur Utama
👤 Untuk Customer

   * ✅ Registrasi & Login dengan email/nomor telepon
   * ✅ Browsing Produk dengan kategori
   * ✅ Keranjang Belanja dinamis
   * ✅ Checkout System multi-step
   * ✅ Multi-payment (COD, Transfer Bank, QRIS, Kartu Kredit)
   * ✅ Riwayat Pesanan dengan tracking status
   * ✅ Manajemen Alamat pengiriman
   * ✅ Profile Management dengan update password

👨‍💼 Untuk Admin

   * ✅ Dashboard Admin dengan statistik
   * ✅ Manajemen Produk (CRUD lengkap)
   * ✅ Manajemen Kategori produk
   * ✅ Manajemen Pengguna customer
   * ✅ Manajemen Pesanan dengan status tracking
   * ✅ Verifikasi Pembayaran manual/otomatis
   * ✅ Laporan Penjualan (basic)

## 🚀 Teknologi Stack
### Backend
    Laravel 12 - PHP Framework
    PHP 8.4 - Bahasa pemrograman
    MariaDB/MySQL - Database
    Eloquent ORM - Database operations
    Middleware - Authentication & Authorization
### Frontend
    Blade Templating - View engine
    Tailwind CSS 3 - Styling framework
    JavaScript Vanilla - Interaktivitas
    Vite - Asset bundler
    Responsive Design - Mobile-first approach
### Integrasi Eksternal
    Midtrans - Payment gateway (planned)
    RajaOngkir API - Shipping calculation (planned)
    WhatsApp API - Notifications (planned)

## 📁 Struktur Proyek 
```
sidapur/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php
│   │   │   ├── AuthController.php
│   │   │   ├── CartController.php
│   │   │   ├── OrderController.php
│   │   │   └── ...
│   │   ├── Middleware/
│   │   │   └── RoleMiddleware.php
│   │   └── Requests/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Products.php
│   │   ├── Orders.php
│   │   └── ...
│   └── Services/
│       ├── MidtransService.php
│       └── RajaOngkirService.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   ├── admin/
│   │   ├── customer/
│   │   └── auth/
│   └── css/
├── public/
│   └── storage/    # Uploaded files
├── routes/
│   └── web.php
├── .env.example
├── composer.json
└── package.json
```

# 🛠️ Instalasi & Setup
### Prerequisites
    PHP 8.4 atau lebih tinggi
    Composer
    Node.js & NPM
    MariaDB/MySQL
    Git
### Step-by-Step Installation
1. Clone Repository
```
git clone https://github.com/Platotel3s/SiDapur-4.git
cd SiDapur-4
```
2. Install Dependencies
```
composer install
npm install
```
3. Setup Environment
```
cp .env.example .env
php artisan key:generate
```
4. Konfigurasi Database
    Edit file .env:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sidapur
DB_USERNAME=root
DB_PASSWORD=
```
5. Migrasi Database

```
php artisan migrate --seed
```
6. Storage Link
```
php artisan storage:link
```
7. Compile Assets
```
npm run build
# atau untuk development
npm run dev
```
8. Jalankan Server
```
php artisan serve
```
9. Akses Aplikasi
```
Website: http://localhost:8000
```

# 📊 Database Schema
### Tabel Utama
    users - Data pengguna (admin & customer)
    products - Produk yang dijual
    categories - Kategori produk
    keranjangs - Keranjang belanja
    item_keranjangs - Item dalam keranjang
    orders - Data pesanan
    order_items - Item dalam pesanan
    addresses - Alamat pengiriman
    payments - Data pembayaran

# 🔐 Authentication & Authorization
### Role System
    Admin: Akses penuh ke semua fitur
    Customer: Hanya bisa akses fitur customer


# 💳 Payment Flow
<img width="4922" height="773" alt="deepseek_mermaid_20251202_ae3cbe" src="https://github.com/user-attachments/assets/078bc322-a7fb-42d3-979d-dcfb54546182" />

# 🚚 Shipping System
### Fitur Pengiriman
    Multi-courier Support (JNE, Tiki, POS)
    Real-time Shipping Cost
    Address Validation
    Tracking Number

# Integrasi RajaOngkir

// Contoh penggunaan
$shippingService = new RajaOngkirService();
$options = $shippingService->getShippingOptions(
    $originCityId,
    $destinationCityId,
    $weight
);

# 📱 Responsive Design
Breakpoints
```
Mobile: < 640px
Tablet: 640px - 1024px
Desktop: > 1024px
```
# Components Responsive
    Navigation bar adaptif
    Product grid responsive
    Tables menjadi cards di mobile
    Form optimization untuk mobile
# 🔧 Development Commands
### Common Artisan Commands
```
# Generate resources
php artisan make:model Product -m
php artisan make:controller ProductController --resource
php artisan make:request StoreProductRequest

# Database
php artisan migrate
php artisan migrate:refresh --seed
php artisan db:seed

# Cache
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Create admin user
php artisan tinker
>>> User::create(['name'=>'Admin','email'=>'admin@sidapur.com','password'=>bcrypt('password'),'role'=>'admin']);

NPM Commands
bash

# Development
npm run dev

# Production build
npm run build

# Watch for changes
npm run watch

# Check for errors
npm run lint
```
# 🧪 Testing
### Unit Tests
```
php artisan test
```
### Feature Tests
```
// Contoh test
public function test_customer_can_add_to_cart()
{
    $user = User::factory()->create(['role' => 'customer']);
    $product = Product::factory()->create();
    
    $response = $this->actingAs($user)
        ->post('/cart/add/' . $product->id);
    
    $response->assertRedirect()
        ->assertSessionHas('success');
}
```
# 📈 Performance Optimization
### Implementasi
    Eager Loading untuk N+1 problem
    Database Indexing untuk query cepat
    Caching untuk data statis
    Lazy Loading Images
    Minified Assets
### Optimization Tips
```
php

// Gunakan eager loading
$orders = Order::with(['user', 'items.product'])->get();

// Gunakan pagination
$products = Product::paginate(12);

// Cache expensive queries
$categories = Cache::remember('categories', 3600, function() {
    return Category::all();
});
```
# 🔒 Security Features
### Implementasi Keamanan

    CSRF Protection untuk semua form
    XSS Prevention dengan Blade escaping
    SQL Injection Prevention dengan Eloquent
    Password Hashing dengan bcrypt
    Session Security dengan encryption
    File Upload Validation
### Security Middleware
```
// Di bootstrap/app.php
protected $middleware = [
    \App\Http\Middleware\EncryptCookies::class,
    \App\Http\Middleware\VerifyCsrfToken::class,
    // ...
];
```
# 📦 Deployment
### Server Requirements
    PHP 8.4+
    MariaDB/MySQL 10.3+
    Composer 2.0+
    Node.js 18+
    Web Server (Apache/Nginx)
### Deployment Steps
1. Setup Server
```
sudo apt update
sudo apt install php8.4 php8.4-mysql php8.4-xml php8.4-mbstring
sudo apt install mariadb-server nginx
```
2. Deploy Code
```
git pull origin main
composer install --optimize-autoloader --no-dev
npm install && npm run build
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
3. Setup Nginx
```
nginx
```
```
server {
    listen 80;
    server_name sidapur.com;
    root /var/www/sidapur/public;
    
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
    }
    
    location ~ /\.ht {
        deny all;
    }
}
```
# 🤝 Kontribusi
### Cara Berkontribusi

1. Fork repository
2. Buat feature branch (git checkout -b feature/AmazingFeature)
3. Commit perubahan (git commit -m 'Add some AmazingFeature')
4. Push ke branch (git push origin feature/AmazingFeature)
5. Buat Pull Request
6. Coding Standards
7. Ikuti PSR-12 coding standard
8. Gunakan English untuk comments
9. Tulis tests untuk new features
10. Update documentation

# 📄 Lisensi

### Proyek ini dilisensikan di bawah MIT License - lihat file LICENSE untuk detail.

# 📞 Support & Contact
### Tim Pengembang
 1. 💻 Lead Developer : Syaiful Yudha Platoteles 
 2. 🖌️ UI/UX Designer : Muhammad Kurniawan 
 3. 👴 Project Manager : Haditya Pandu

# 🎯 Roadmap
### Versi 1.0 (Current)

    Basic e-commerce features
    Admin dashboard
    Customer portal
    Cart & checkout
### Versi 2.0 (Planned)
    Payment gateway integration
    Shipping API integration
    Product reviews
    Wishlist feature
    Coupon system
### Versi 3.0 (Future)
    Mobile app (React Native)
    AI product recommendations
    Multi-vendor support
    International shipping
