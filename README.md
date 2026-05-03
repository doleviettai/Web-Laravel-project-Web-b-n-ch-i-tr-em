# 🧸 Elecom — Website Bán Đồ Chơi Trẻ Em

> Dự án web thương mại điện tử xây dựng bằng **Laravel (PHP)**, hỗ trợ đa vai trò: Admin, Người bán (Vendor) và Khách hàng. Hệ thống cho phép quản lý sản phẩm, đơn hàng, giỏ hàng, vận chuyển và đánh giá sản phẩm toàn diện.

---

## 📋 Mục lục

- [Giới thiệu dự án](#-giới-thiệu-dự-án)
- [Công nghệ sử dụng](#-công-nghệ-sử-dụng)
- [Kiến trúc hệ thống & Vai trò](#-kiến-trúc-hệ-thống--vai-trò)
- [Chức năng chi tiết](#-chức-năng-chi-tiết)
  - [Trang chủ & Xác thực](#trang-chủ--xác-thực)
  - [Quản trị viên (Admin)](#-quản-trị-viên-admin)
  - [Người bán (Vendor/Seller)](#-người-bán-vendorseller)
  - [Khách hàng (Customer)](#-khách-hàng-customer)
- [Cơ sở dữ liệu (sơ lược)](#-cơ-sở-dữ-liệu-sơ-lược)
- [Hướng dẫn cài đặt](#-hướng-dẫn-cài-đặt)
- [Cấu trúc thư mục](#-cấu-trúc-thư-mục)
- [Tác giả](#-tác-giả)

---

## 📌 Giới thiệu dự án

**Elecom** là một nền tảng thương mại điện tử chuyên về đồ chơi trẻ em, được phát triển bằng framework **Laravel**. Hệ thống hỗ trợ ba nhóm người dùng với quyền hạn khác nhau:

- **Admin**: Quản lý toàn bộ hệ thống — danh mục, sản phẩm, người dùng, đơn hàng, lịch sử giao dịch.
- **Vendor (Người bán)**: Quản lý cửa hàng, theo dõi đơn hàng được giao từ Admin, xử lý vận chuyển.
- **Customer (Khách hàng)**: Duyệt sản phẩm, lọc theo giá, thêm vào giỏ hàng, đặt hàng và theo dõi đơn hàng.

---

## 🛠 Công nghệ sử dụng

| Thành phần | Công nghệ |
|---|---|
| Backend Framework | Laravel (PHP) |
| Frontend | Blade Template + HTML/CSS/JS |
| Xác thực | Laravel Breeze / Auth tích hợp |
| ORM | Eloquent ORM |
| Database | MySQL |
| Tìm kiếm động | AJAX (POST requests) |
| Xuất PDF | Tích hợp xuất PDF đơn hàng |
| Phân quyền | Middleware `rolemanager` (admin / vendor / customer) |

---

## 🏗 Kiến trúc hệ thống & Vai trò

Hệ thống sử dụng **middleware phân quyền theo role** (`rolemanager`). Mỗi role có prefix URL và nhóm route riêng biệt:

```
/               → Trang chủ (public)
/admin/...      → Dành cho Admin
/vendor/...     → Dành cho Vendor (Người bán)
/customer/...   → Dành cho Customer (Khách hàng)
```

Tất cả các route bảo vệ đều yêu cầu `auth` + `verified` + đúng role tương ứng.

---

## ⚙ Chức năng chi tiết

### Trang chủ & Xác thực

- Trang chào mừng (`/`) hiển thị giao diện giới thiệu.
- Đăng ký, đăng nhập, xác thực email, quên mật khẩu (thông qua `auth.php` của Laravel Breeze).
- Chỉnh sửa thông tin cá nhân, đổi mật khẩu, xóa tài khoản.

---

### 🔐 Quản trị viên (Admin)

**Truy cập:** `/admin/...` | **Middleware:** `rolemanager:admin`

#### 1. Dashboard & Cài đặt
- Xem tổng quan hệ thống tại `/admin/dashboard`.
- Chỉnh sửa cài đặt tài khoản Admin, cập nhật ảnh đại diện.

#### 2. Quản lý Danh mục (Category)
- Tạo danh mục mới, xem danh sách danh mục.
- Sửa, xóa, tìm kiếm danh mục bằng AJAX.

#### 3. Quản lý Danh mục con (SubCategory)
- Tạo, xem, sửa, xóa danh mục con.
- Tìm kiếm nhanh bằng AJAX.

#### 4. Quản lý Thuộc tính sản phẩm (Product Attribute)
- Tạo và quản lý các thuộc tính mặc định cho sản phẩm (màu sắc, kích thước, v.v.).
- CRUD đầy đủ: Thêm / Xem / Sửa / Xóa thuộc tính.
- Tìm kiếm thuộc tính bằng AJAX.

#### 5. Quản lý Sản phẩm
- Danh sách sản phẩm toàn hệ thống, tìm kiếm sản phẩm.
- Thêm sản phẩm mới, chỉnh sửa, xóa sản phẩm.
- **Quản lý đánh giá sản phẩm:**
  - Xem danh sách đánh giá, tìm kiếm đánh giá.
  - Thêm / Xóa từng item trong đơn đánh giá.
  - Tạo đơn đánh giá mới, xóa toàn bộ đánh giá (truncate).

#### 6. Quản lý Người dùng

**Khách hàng (Client):**
- Danh sách khách hàng, tìm kiếm.
- Xem chi tiết khách hàng, cập nhật ảnh đại diện.

**Người bán (Vendor):**
- Danh sách vendor, tìm kiếm.
- Thêm vendor mới, chỉnh sửa thông tin, xóa vendor.

#### 7. Quản lý Đơn hàng & Lịch sử

**Giỏ hàng (Cart History):**
- Xem lịch sử giỏ hàng của khách, tìm kiếm.
- **Xuất PDF hóa đơn giỏ hàng** (`/admin/print_pdf/admin/{id}`).
- Xóa bản ghi giỏ hàng.

**Đơn hàng (Order History):**
- Xem toàn bộ lịch sử đơn hàng, tìm kiếm theo điều kiện.
- Xem chi tiết đơn hàng, cập nhật trạng thái đơn hàng.
- Xóa đơn hàng.
- **Tạo thông tin vận chuyển** cho đơn hàng, giao cho vendor xử lý.

---

### 🏪 Người bán (Vendor/Seller)

**Truy cập:** `/vendor/...` | **Middleware:** `rolemanager:vendor`

#### 1. Dashboard & Hồ sơ
- Xem dashboard cửa hàng cá nhân.
- Xem lịch sử đơn hàng của cửa hàng.
- Cập nhật ảnh đại diện cửa hàng.

#### 2. Quản lý Sản phẩm (Vendor)
- Xem danh sách sản phẩm thuộc cửa hàng, tìm kiếm.
- **Quản lý đánh giá sản phẩm** (tương tự Admin):
  - Xem, tìm kiếm đánh giá.
  - Thêm / Xóa item đánh giá.
  - Tạo và quản lý đơn đánh giá.

#### 3. Quản lý Cửa hàng & Vận chuyển
- Xem danh sách đơn hàng cần xử lý vận chuyển (`/vendor/store/ship`).
- **Xuất PDF đơn hàng** của cửa hàng.
- Tìm kiếm đơn hàng.
- Xem chi tiết đơn hàng, cập nhật trạng thái.
- **Tạo thông tin vận chuyển** (nhập thông tin ship cho từng đơn).

---

### 🛒 Khách hàng (Customer)

**Truy cập:** `/customer/...` | **Middleware:** `rolemanager:customer`

#### 1. Tài khoản & Hồ sơ
- Xem dashboard cá nhân.
- Xem trang giới thiệu.
- Chỉnh sửa thông tin hồ sơ (tên, địa chỉ, ảnh, v.v.).
- Xem **danh sách đơn hàng** đã đặt, xóa đơn hàng.
- Theo dõi **trạng thái vận chuyển** theo tên đơn (`/customer/setting/list_ship/{name}`).
- Trang liên hệ.

#### 2. Duyệt & Tìm kiếm Sản phẩm
- Xem toàn bộ sản phẩm.
- **Tìm kiếm sản phẩm theo tên** (AJAX).
- **Lọc sản phẩm theo khoảng giá** (6 mức):
  - 0 – 100k
  - 100k – 500k
  - 500k – 1 triệu
  - 1 triệu – 2 triệu
  - 2 triệu – 5 triệu
  - 5 triệu – 10 triệu

#### 3. Chi tiết Sản phẩm & Đặt hàng
- Xem chi tiết sản phẩm (ảnh, mô tả, thuộc tính, giá).
- **Tạo và xác nhận đơn hàng trực tiếp** từ trang sản phẩm.
- **Thêm vào giỏ hàng** (`Add to Cart`).

#### 4. Giỏ hàng
- Xem toàn bộ giỏ hàng.
- Xóa từng sản phẩm khỏi giỏ.
- **Đặt hàng từ giỏ hàng** (tạo đơn + xác nhận).
- Đếm số lượng sản phẩm trong giỏ theo thời gian thực (AJAX: `/customer/countcartpro/{id}`).

---

## 🗄 Cơ sở dữ liệu (sơ lược)

Dựa trên các Controller và Route, hệ thống bao gồm các thực thể chính:

| Bảng | Mô tả |
|---|---|
| `users` | Người dùng hệ thống (admin / vendor / customer) |
| `categories` | Danh mục sản phẩm |
| `sub_categories` | Danh mục con |
| `product_attributes` | Thuộc tính sản phẩm |
| `products` | Sản phẩm |
| `carts` | Giỏ hàng |
| `orders` | Đơn hàng |
| `order_items` | Chi tiết đơn hàng |
| `reviews` | Đánh giá sản phẩm |
| `stores` | Cửa hàng của vendor |
| `shipments` | Thông tin vận chuyển |

---

## 🚀 Hướng dẫn cài đặt

### Yêu cầu hệ thống

- PHP >= 8.1
- Composer
- MySQL
- Node.js & NPM (cho assets)

### Các bước cài đặt

```bash
# 1. Clone repository
git clone https://github.com/doleviettai/Web-Laravel-project-Web-b-n-ch-i-tr-em.git
cd Web-Laravel-project-Web-b-n-ch-i-tr-em/elecom

# 2. Cài đặt dependency PHP
composer install

# 3. Cài đặt dependency frontend
npm install && npm run dev

# 4. Tạo file cấu hình môi trường
cp .env.example .env

# 5. Tạo application key
php artisan key:generate

# 6. Cấu hình database trong file .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=elecom
DB_USERNAME=root
DB_PASSWORD=

# 7. Chạy migration và seed dữ liệu mẫu
php artisan migrate --seed

# 8. Tạo symbolic link cho storage
php artisan storage:link

# 9. Khởi chạy server
php artisan serve
```

Truy cập ứng dụng tại: `http://localhost:8000`

---

## 📁 Cấu trúc thư mục

```
elecom/
├── app/
│   └── Http/
│       └── Controllers/
│           ├── Admin/              # Controllers cho Admin
│           │   ├── AdminMainController.php
│           │   ├── CategoryController.php
│           │   ├── SubCategoryController.php
│           │   ├── ProductController.php
│           │   ├── ProductAttributeController.php
│           │   ├── ProductDiscountController.php
│           │   ├── UserManageController.php
│           │   └── HistoryController.php
│           ├── Seller/             # Controllers cho Vendor
│           │   ├── SellerMainController.php
│           │   ├── SellerProductController.php
│           │   └── SellerStoreController.php
│           ├── Customer/           # Controllers cho Customer
│           │   ├── CustomerMainController.php
│           │   ├── CustomerProductController.php
│           │   └── CustomerProductCartController.php
│           ├── MasterCategoryController.php
│           ├── MasterSubcategoryController.php
│           └── ProfileController.php
├── routes/
│   ├── web.php                     # Toàn bộ route của ứng dụng
│   └── auth.php                    # Route xác thực (Breeze)
├── resources/
│   └── views/                      # Blade templates
|        └── css/                      
|        └── img/                     
|        └── js/                   
|        └── views/
|            └── admin/                        # Views cho Admin
|            └── auth/                         # Views xác thực (đăng nhập, đăng ký, v.v.)
|            └── components/                   # Views dùng chung (header, footer, v.v.) 
|            └── customer/                     # Views cho Customer
|            └── layouts/                      # Views bố cục chung
|            └── profile/                      # Views quản lý hồ sơ người dùng  
|            └── seller/                       # Views cho nhân viên bán hàng (Vendor)
|            └── dashboard.blade.php/          # Dashboard chung cho tất cả vai trò
|            └── vendor.blade.php/             # Dashboard riêng cho Vendor     
|            └── welcome.blade.php/            # Trang chào mừng (public)  
| 
├── database/
│   ├── migrations/                 # Migration CSDL
│   └── seeders/                    # Dữ liệu mẫu
└── public/                         # Assets công khai
```

---

