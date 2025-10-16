# 🛍️ ShopMaster - Advanced E-Commerce System

<div align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-red.svg" alt="Laravel Version">
  <img src="https://img.shields.io/badge/PHP-8.2+-blue.svg" alt="PHP Version">
  <img src="https://img.shields.io/badge/TailwindCSS-3.x-38B2AC.svg" alt="TailwindCSS">
  <img src="https://img.shields.io/badge/JWT-Auth-green.svg" alt="JWT Auth">
  <img src="https://img.shields.io/badge/Status-Production%20Ready-brightgreen.svg" alt="Status">
  <img src="https://img.shields.io/badge/Architecture-SOLID%20%2B%20Design%20Patterns-orange.svg" alt="Architecture">
</div>

## 📋 Overview
## 📎 Documentation & Demo

- 📘 **API Documentation (Postman)**: [View Full API Docs](https://documenter.getpostman.com/view/33216800/2sB3QNqoY7)
- 🎥 **Live Demo Video**: [Watch the Demo](https://screenrec.com/share/5VTPoj2hki)

These resources demonstrate all API endpoints, request/response examples, and a walkthrough of the user interface, shopping flow, and checkout process.

**ShopMaster** is an advanced, comprehensive e-commerce system built on Laravel 12 with a modern user interface and exceptional user experience. The system provides all essential and advanced e-commerce features with a focus on security, performance, and scalability.

## ✨ Key Features

### 🎨 Frontend (Client-Facing)
- **Modern Homepage** — Animated hero section with featured products showcase
- **Product Catalog** — Product listing with search and category filtering
- **Product Details** — Comprehensive product information display
- **Shopping Cart** — Real-time cart updates with coupon application
- **Checkout Process** — Secure checkout with shipping method selection
- **User Profile** — Order history and profile management
- **Order Tracking** — Complete order details and status tracking
- **Responsive Design** — Mobile-first design with TailwindCSS

### ⚙️ Backend (Admin & API)
- **RESTful API** — Complete API endpoints for all operations
- **Admin Dashboard** — Modern admin interface with statistics
- **JWT Authentication** — Secure token-based API authentication
- **Content Management** — Product, category, and user management
- **Coupon System** — Percentage and fixed amount discounts
- **Shipping Management** — Configurable shipping methods
- **Order Management** — Complete order processing system

### 🔐 Security & Protection
- **JWT Authentication** — Secure token-based API authentication with refresh
- **CSRF Protection** — Built-in Laravel CSRF protection for web forms
- **Password Encryption** — Bcrypt hashing for all passwords
- **Form Request Validation** — Comprehensive validation at all levels
- **Admin Middleware** — Custom admin authentication middleware
- **Rate Limiting** — API endpoints protected with throttling (5 req/min for auth, 60 req/min for cart)
- **CORS Configuration** — Configured for frontend domain access
- **Input Sanitization** — XSS protection through Blade templating
- **SQL Injection Prevention** — Eloquent ORM with parameterized queries

## 🚀 Technologies Used

### Backend
- **Laravel 12.x** — Modern PHP framework with advanced features
- **PHP 8.2+** — Latest PHP with modern syntax
- **MySQL** — Primary database management
- **JWT Auth** — Secure token-based API authentication

### Frontend
- **Blade Templates** — Laravel's powerful templating engine
- **TailwindCSS 3.x** — Utility-first CSS framework
- **Alpine.js** — Lightweight reactive JavaScript framework
- **Vanilla JavaScript** — Clean API interactions

### Development Tools
- **Laravel Pint** — Code formatting and style enforcement
- **PHPUnit** — Comprehensive testing framework
- **Faker** — Realistic test data generation

## 🏗️ Architecture & Design Patterns

### Service Layer Architecture

The application follows a clean service layer pattern with proper separation of concerns:

#### 1. **Service Layer Pattern**
```php
// Service Interface
interface ProductServiceInterface
{
    public function getAllProducts(int $perPage = 15): LengthAwarePaginator;
    public function getProductById(int $id): ?Product;
    public function createProduct(array $data): Product;
    public function updateProduct(int $id, array $data): Product;
    public function deleteProduct(int $id): bool;
}

// Service Implementation
class ProductService implements ProductServiceInterface
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {}
}
```

#### 2. **Dependency Injection**
```php
class ProductController extends Controller
{
    public function __construct(
        private ProductServiceInterface $productService
    ) {}
    
    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->createProduct($request->validated());
        return response()->json(['success' => true, 'data' => $product]);
    }
}
```

#### 3. **Service Container Registration**
```php
// AppServiceProvider.php
public function register(): void
{
    $this->app->bind(ProductServiceInterface::class, ProductService::class);
    $this->app->bind(CartServiceInterface::class, CartService::class);
    $this->app->bind(OrderServiceInterface::class, OrderService::class);
    $this->app->bind(CouponServiceInterface::class, CouponService::class);
    $this->app->bind(ShippingServiceInterface::class, ShippingService::class);
    $this->app->bind(AdminServiceInterface::class, AdminService::class);
    $this->app->bind(UserServiceInterface::class, UserService::class);
}
```

## 📁 Project Structure

```
ecommerce/
├── app/
│   ├── Console/
│   │   └── Commands/         # Artisan Commands
│   ├── Http/
│   │   ├── Controllers/      # All Controllers (26 files)
│   │   │   ├── Admin/        # Admin Panel Controllers
│   │   │   │   ├── Auth/
│   │   │   │   │   └── LoginController.php
│   │   │   │   ├── CategoryController.php
│   │   │   │   ├── CouponController.php
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── OrderController.php
│   │   │   │   ├── ProductController.php
│   │   │   │   ├── ShippingMethodController.php
│   │   │   │   └── UserController.php
│   │   │   ├── Api/          # API Controllers
│   │   │   │   ├── AnalyticsController.php
│   │   │   │   ├── AuthController.php
│   │   │   │   ├── CartController.php
│   │   │   │   ├── CategoryController.php
│   │   │   │   ├── CouponController.php
│   │   │   │   ├── OrderController.php
│   │   │   │   ├── ProductController.php
│   │   │   │   ├── ShippingMethodController.php
│   │   │   │   └── UserController.php
│   │   │   ├── Auth/         # Authentication Controllers
│   │   │   │   ├── LoginController.php
│   │   │   │   └── RegisterController.php
│   │   │   ├── Web/          # Web Controllers
│   │   │   │   ├── CartController.php
│   │   │   │   ├── CheckoutController.php
│   │   │   │   ├── HomeController.php
│   │   │   │   ├── OrderController.php
│   │   │   │   ├── ProductController.php
│   │   │   │   └── ProfileController.php
│   │   │   └── Controller.php
│   │   ├── Middleware/       # Custom Middleware (1 file)
│   │   ├── Requests/         # Form Request Validation (23 files)
│   │   └── Resources/        # API Resources (10 files)
│   ├── Listeners/            # Event Listeners
│   │   └── MergeGuestCartOnLogin.php
│   ├── Models/               # Eloquent Models (9 files)
│   │   ├── Cart.php
│   │   ├── CartItem.php
│   │   ├── Category.php
│   │   ├── Coupon.php
│   │   ├── Order.php
│   │   ├── OrderItem.php
│   │   ├── Product.php
│   │   ├── ShippingMethod.php
│   │   └── User.php
│   ├── Providers/            # Service Providers (4 files)
│   │   ├── AppServiceProvider.php
│   │   ├── AuthServiceProvider.php
│   │   ├── EventServiceProvider.php
│   │   └── RouteServiceProvider.php
│   └── Services/             # Business Logic Services
│       ├── Contracts/        # Service Interfaces (9 files)
│       │   ├── AdminServiceInterface.php
│       │   ├── CartServiceInterface.php
│       │   ├── CategoryServiceInterface.php
│       │   ├── CouponServiceInterface.php
│       │   ├── OrderServiceInterface.php
│       │   ├── ProductServiceInterface.php
│       │   ├── ShippingMethodServiceInterface.php
│       │   ├── ShippingServiceInterface.php
│       │   └── UserServiceInterface.php
│       ├── AdminService.php
│       ├── CartService.php
│       ├── CategoryService.php
│       ├── CouponService.php
│       ├── OrderService.php
│       ├── ProductService.php
│       ├── ShippingMethodService.php
│       ├── ShippingService.php
│       └── UserService.php
├── bootstrap/
│   ├── app.php
│   ├── cache/                # Cached files
│   │   ├── packages.php
│   │   └── services.php
│   └── providers.php
├── config/                   # Configuration files (11 files)
│   ├── app.php
│   ├── auth.php
│   ├── cache.php
│   ├── database.php
│   ├── filesystems.php
│   ├── jwt.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── services.php
│   └── session.php
├── database/
│   ├── database.sqlite       # SQLite Database
│   ├── factories/            # Model Factories (3 files)
│   │   ├── CategoryFactory.php
│   │   ├── ProductFactory.php
│   │   └── UserFactory.php
│   ├── migrations/           # Database Migrations (12 files)
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 2024_01_01_000001_create_categories_table.php
│   │   ├── 2024_01_01_000002_create_products_table.php
│   │   ├── 2024_01_01_000003_create_coupons_table.php
│   │   ├── 2024_01_01_000004_create_shipping_methods_table.php
│   │   ├── 2024_01_01_000005_create_carts_table.php
│   │   ├── 2024_01_01_000006_create_cart_items_table.php
│   │   ├── 2024_01_01_000007_create_orders_table.php
│   │   ├── 2024_01_01_000008_create_order_items_table.php
│   │   └── 2025_10_16_095340_add_unit_price_to_cart_items_table.php
│   └── seeders/              # Database Seeders (6 files)
│       ├── CategorySeeder.php
│       ├── CouponSeeder.php
│       ├── DatabaseSeeder.php
│       ├── ProductSeeder.php
│       ├── ShippingMethodSeeder.php
│       └── UserSeeder.php
├── public/                   # Public assets
│   ├── favicon.ico
│   ├── hot
│   ├── index.php
│   ├── robots.txt
│   └── storage/              # Storage symlink
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── views/                # Blade Templates
│       ├── admin/            # Admin Views (22 files)
│       │   ├── auth/
│       │   │   └── login.blade.php
│       │   ├── categories/
│       │   │   ├── create.blade.php
│       │   │   ├── edit.blade.php
│       │   │   └── index.blade.php
│       │   ├── coupons/
│       │   │   ├── create.blade.php
│       │   │   ├── edit.blade.php
│       │   │   └── index.blade.php
│       │   ├── dashboard.blade.php
│       │   ├── layouts/
│       │   │   └── app.blade.php
│       │   ├── orders/
│       │   │   ├── index.blade.php
│       │   │   └── show.blade.php
│       │   ├── products/
│       │   │   ├── create.blade.php
│       │   │   ├── edit.blade.php
│       │   │   ├── index.blade.php
│       │   │   └── show.blade.php
│       │   ├── shipping-methods/
│       │   │   ├── create.blade.php
│       │   │   ├── edit.blade.php
│       │   │   └── index.blade.php
│       │   └── users/
│       │       ├── create.blade.php
│       │       ├── edit.blade.php
│       │       ├── index.blade.php
│       │       └── show.blade.php
│       ├── auth/             # Auth Views (2 files)
│       ├── cart/             # Cart Views (1 file)
│       ├── checkout/         # Checkout Views (1 file)
│       ├── home.blade.php
│       ├── layouts/          # Layout Views (1 file)
│       ├── orders/           # Order Views (2 files)
│       ├── products/         # Product Views (2 files)
│       ├── profile/          # Profile Views (2 files)
│       └── welcome.blade.php
├── routes/                   # Route definitions (4 files)
│   ├── admin.php             # Admin Routes
│   ├── api.php               # API Routes
│   ├── console.php           # Console Routes
│   └── web.php               # Web Routes
├── storage/                  # File Storage
│   ├── app/
│   │   ├── private/          # Private storage
│   │   └── public/           # Public storage
│   ├── framework/
│   │   ├── cache/            # Framework cache
│   │   ├── sessions/         # Session files
│   │   └── views/            # Compiled views
│   └── logs/
│       └── laravel.log       # Application logs
├── tests/                    # Test files
│   ├── Feature/
│   │   └── ExampleTest.php
│   ├── TestCase.php
│   └── Unit/
│       └── ExampleTest.php
├── vendor/                   # Composer dependencies
├── artisan                   # Laravel Artisan CLI
├── composer.json             # Composer configuration
├── composer.lock             # Composer lock file
├── package.json              # NPM configuration
├── package-lock.json         # NPM lock file
├── phpunit.xml               # PHPUnit configuration
├── vite.config.js            # Vite configuration
├── POSTMAN_COLLECTION_README.md
├── postman_pre_request_script.js
├── ShopMaster_API_Collection.postman_collection.json
├── test-image.html
└── README.md                 # Project documentation
```

## 🗄️ Database Schema

### Core Tables

#### Users Table
```sql
- id (Primary Key)
- name (User Name)
- email (Email Address)
- password_hash (Encrypted Password)
- role (admin/customer)
- created_at, updated_at
```

#### Products Table
```sql
- id (Primary Key)
- name (Product Name)
- slug (Product URL Slug)
- price (Product Price)
- stock (Available Quantity)
- category_id (Category Reference)
- description (Product Description)
- image (Main Product Image)
- created_at, updated_at
```

#### Categories Table
```sql
- id (Primary Key)
- name (Category Name)
- slug (Category URL Slug)
- created_at, updated_at
```

#### Orders Table
```sql
- id (Primary Key)
- user_id (User Reference)
- order_number (Order Number)
- subtotal (Order Subtotal)
- shipping_cost (Shipping Cost)
- discount_amount (Discount Amount)
- total_amount (Order Total)
- coupon_id (Applied Coupon)
- shipping_method_id (Shipping Method)
- status (Order Status)
- shipping_address (Shipping Address - JSON)
- billing_address (Billing Address - JSON)
- notes (Order Notes)
- created_at, updated_at
```

#### Order Items Table
```sql
- id (Primary Key)
- order_id (Order Reference)
- product_id (Product Reference)
- quantity (Item Quantity)
- price (Item Price)
- created_at, updated_at
```

#### Carts Table
```sql
- id (Primary Key)
- user_id (User Reference - nullable)
- session_id (Session ID)
- created_at, updated_at
```

#### Cart Items Table
```sql
- id (Primary Key)
- cart_id (Cart Reference)
- product_id (Product Reference)
- quantity (Item Quantity)
- price (Item Price)
- unit_price (Unit Price at time of adding)
- created_at, updated_at
```

#### Coupons Table
```sql
- id (Primary Key)
- code (Coupon Code)
- discount_type (percent or fixed)
- discount_value (Discount Amount)
- min_order_value (Minimum Order Value)
- expires_at (Expiration Date)
- is_active (Active Status)
- created_at, updated_at
```

#### Shipping Methods Table
```sql
- id (Primary Key)
- name (Shipping Method Name)
- cost (Shipping Cost)
- estimated_days (Delivery Days)
- is_active (Active Status)
- created_at, updated_at
```

## 🔄 Coupon & Shipping Integration Logic

### 🧩 Apply Coupon Logic
**Endpoint**: `POST /api/cart/apply-coupon`

**Input**:
```json
{
    "code": "SAVE10"
}
```

**Validation**:
- Coupon exists and is active
- Coupon is not expired
- Cart total >= minimum order value
- Coupon usage limit not exceeded

**Apply Logic**:
- If `discount_type = 'percent'`: Apply percentage discount
- If `discount_type = 'fixed'`: Subtract fixed amount
- Update cart total and save `coupon_id` to cart

### 🚚 Select Shipping Method Logic
**Endpoint**: `POST /api/cart/set-shipping`

**Input**:
```json
{
    "shipping_id": 2
}
```

**Validation**:
- Method exists and is active

**Apply Logic**:
- Set `shipping_id` to cart
- Add `shipping_methods.cost` to total

### 💰 Final Cart Calculation
```php
$subtotal = sum(cart_items.price * quantity);
$discount = calculateCouponDiscount(coupon);
$shipping = getShippingCost(cart.shipping_id);
$total = $subtotal - $discount + $shipping;
```

## 🧾 JWT Authentication Flow

1. **User Login** → `POST /api/login` → Returns JWT token
2. **Token Storage** → Stored in localStorage/cookie
3. **Protected Endpoints** → Require header: `Authorization: Bearer "token"`
4. **Middleware Validation** → Validates token → Injects user into request
5. **Optional Refresh** → Token refresh mechanism for longer sessions

## 🔌 API Endpoints

### Authentication Endpoints
- `POST /api/auth/login` — User login
- `POST /api/auth/register` — User registration
- `POST /api/auth/logout` — User logout (Protected)
- `POST /api/auth/refresh` — Refresh JWT token (Protected)
- `GET /api/auth/user-profile` — Get user profile (Protected)

### Product Management
- `GET /api/products` — Get all products (Public)
- `POST /api/products` — Create product (Protected)
- `GET /api/products/{id}` — Get product by ID (Protected)
- `PUT /api/products/{id}` — Update product (Protected)
- `DELETE /api/products/{id}` — Delete product (Protected)

### Category Management
- `GET /api/categories` — Get all categories (Protected)
- `POST /api/categories` — Create category (Protected)
- `GET /api/categories/{id}` — Get category by ID (Protected)
- `PUT /api/categories/{id}` — Update category (Protected)
- `DELETE /api/categories/{id}` — Delete category (Protected)

### Order Management
- `GET /api/orders` — Get all orders (Protected)
- `GET /api/orders/{id}` — Get order by ID (Protected)
- `POST /api/orders` — Create order (Protected)
- `POST /api/orders/{id}/cancel` — Cancel order (Protected)

### Coupon Management
- `GET /api/coupons` — Get all coupons (Protected)
- `POST /api/coupons` — Create coupon (Protected)
- `GET /api/coupons/{id}` — Get coupon by ID (Protected)
- `PUT /api/coupons/{id}` — Update coupon (Protected)
- `DELETE /api/coupons/{id}` — Delete coupon (Protected)
- `POST /api/coupons/validate` — Validate coupon code (Protected)

### Shipping Methods
- `GET /api/shipping` — Get all shipping methods (Protected)
- `POST /api/shipping` — Create shipping method (Protected)
- `GET /api/shipping/active` — Get active shipping methods (Protected)
- `GET /api/shipping/{id}` — Get shipping method by ID (Protected)
- `PUT /api/shipping/{id}` — Update shipping method (Protected)
- `DELETE /api/shipping/{id}` — Delete shipping method (Protected)

### Cart Management
- `GET /api/cart` — Get cart contents (Protected)
- `POST /api/cart/add` — Add item to cart (Protected)
- `PUT /api/cart/update` — Update cart item (Protected)
- `DELETE /api/cart/remove` — Remove item from cart (Protected)
- `DELETE /api/cart/clear` — Clear entire cart (Protected)
- `POST /api/cart/apply-coupon` — Apply coupon to cart (Protected)
- `POST /api/cart/set-shipping` — Set shipping method (Protected)

### User Management
- `GET /api/users` — Get all users (Protected)
- `GET /api/users/{id}` — Get user by ID (Protected)
- `PUT /api/users/{id}` — Update user (Protected)
- `DELETE /api/users/{id}` — Delete user (Protected)

## 🌐 Web Routes

### Public Routes
- `GET /` — Homepage with animated hero section and featured products
- `GET /products` — Product listing page with search and filtering
- `GET /products/{slug}` — Product detail page
- `GET /login` — User login page
- `POST /login` — Process user login
- `GET /register` — User registration page
- `POST /register` — Process user registration

### Protected Routes (Require Authentication)
- `GET /cart` — Shopping cart page with real-time updates
- `GET /cart/count` — Get cart item count
- `POST /cart/add` — Add item to cart
- `PUT /cart/update` — Update cart item quantity
- `DELETE /cart/remove` — Remove item from cart
- `POST /cart/apply-coupon` — Apply coupon to cart
- `DELETE /cart/remove-coupon` — Remove applied coupon
- `POST /cart/update-shipping` — Update shipping method
- `GET /cart/totals` — Get cart totals

- `GET /checkout` — Checkout page with shipping selection
- `POST /checkout` — Process checkout and create order

- `GET /orders` — User order history
- `GET /orders/{id}` — Order details and tracking
- `POST /orders/{id}/cancel` — Cancel order

- `GET /profile` — User profile page
- `GET /profile/edit` — Edit profile page
- `PUT /profile/update` — Update profile

### Admin Routes (Require Admin Authentication)
- `GET /admin/dashboard` — Admin dashboard with statistics
- `GET /admin/products` — Product management
- `GET /admin/categories` — Category management
- `GET /admin/orders` — Order management
- `GET /admin/coupons` — Coupon management
- `GET /admin/shipping-methods` — Shipping method management
- `GET /admin/users` — User management

## 🛠️ Installation & Setup

### Requirements
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL/SQLite
- Git

### Installation Steps

1. **Clone the Project**
```bash
git clone https://github.com/mhmdatya72/ShopMaster-Advanced-E-Commerce-System.git
cd ShopMaster-Advanced-E-Commerce-System
```

2. **Install Dependencies**
```bash
composer install
npm install
```

3. **Environment Setup**
```bash
cp .env.example .env
php artisan key:generate
php artisan jwt:secret
```

4. **Database Setup**
```bash
# Update .env with database credentials
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shopmaster
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Run migrations and seeders
php artisan migrate
php artisan db:seed
```

5. **Storage Setup**
```bash
php artisan storage:link
```

6. **Build Assets**
```bash
npm run build
# or for development
npm run dev
```

7. **Start Server**
```bash
php artisan serve
```

## 🔧 Advanced Configuration

### JWT Configuration
```env
JWT_SECRET=your_jwt_secret_key
JWT_TTL=60
JWT_REFRESH_TTL=20160
JWT_ALGO=HS256
JWT_BLACKLIST_ENABLED=true
JWT_BLACKLIST_GRACE_PERIOD=0
```

## 🛡️ Security Configuration

### Rate Limiting
The application implements rate limiting for sensitive endpoints:

```php
// API Auth endpoints - 5 requests per minute
Route::middleware(['throttle:5,1'])->group(function () {
    Route::post('/api/auth/login', [AuthController::class, 'login']);
    Route::post('/api/auth/register', [AuthController::class, 'register']);
});

// API Cart endpoints - 60 requests per minute
Route::middleware(['throttle:60,1'])->group(function () {
    Route::prefix('api/cart')->group(function () {
        // Cart operations
    });
});
```

### CORS Configuration
Configure CORS for frontend domain access in `config/cors.php`:

```php
'allowed_origins' => [
    'http://localhost:3000',  // React/Vue frontend
    'https://yourdomain.com', // Production frontend
],
'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
'allowed_headers' => ['Content-Type', 'Authorization', 'X-Requested-With'],
```

### API Error Response Format
All API endpoints return consistent error responses:

```json
{
    "success": false,
    "message": "Error description",
    "errors": {
        "field_name": ["Validation error message"]
    }
}
```

### Security Headers
Ensure your web server includes security headers:

```apache
# Apache .htaccess
Header always set X-Content-Type-Options nosniff
Header always set X-Frame-Options DENY
Header always set X-XSS-Protection "1; mode=block"
Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains"
```

### Email Configuration
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
```

### Storage Configuration
```env
FILESYSTEM_DISK=public
```

## 📚 Usage Guide

### For Developers

#### Adding a New Product
```php
// In Controller
$product = Product::create([
    'name' => 'New Product',
    'description' => 'Product description',
    'price' => 99.99,
    'stock' => 100,
    'category_id' => 1,
    'is_active' => true
]);
```

#### Adding a New Coupon
```php
$coupon = Coupon::create([
    'code' => 'SAVE20',
    'discount_type' => 'percent',
    'discount_value' => 20,
    'min_order_value' => 100,
    'expires_at' => now()->addDays(30),
    'is_active' => true
]);
```

#### Using the API
```javascript
// User Login
const response = await fetch('/api/auth/login', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({
        email: 'user@example.com',
        password: 'password'
    })
});

const data = await response.json();
const token = data.access_token;

// Using the token
const products = await fetch('/api/products', {
    headers: {
        'Authorization': `Bearer ${token}`
    }
});
```

### For Users

#### Creating a New Account
1. Visit the homepage at `http://127.0.0.1:8000`
2. Click "Register" in the navigation
3. Fill in name, email, and password
4. Click "Create Account"

#### Browsing Products
1. Visit the products page at `http://127.0.0.1:8000/products`
2. Use search functionality to find specific products
3. Filter by categories using the sidebar
4. Click on any product to view details

#### Adding Product to Cart
1. On any product page, select desired quantity
2. Click "Add to Cart" button
3. Cart will update in real-time with the new item

#### Applying a Coupon
1. Go to cart page at `http://127.0.0.1:8000/cart`
2. Enter coupon code in the "Apply Coupon" field
3. Click "Apply" to see discount applied

#### Completing an Order
1. Navigate to checkout page at `http://127.0.0.1:8000/checkout`
2. Enter shipping and billing information
3. Select preferred shipping method
4. Review order summary and complete purchase

### For Administrators

#### Accessing Admin Panel
1. Visit `http://127.0.0.1:8000/admin/login`
2. Login with admin credentials
3. Access dashboard with store statistics

#### Managing Products
1. Go to "Products" section in admin panel
2. Click "Add New Product" to create products
3. Edit existing products or manage inventory
4. Use the delete confirmation modal for safe deletion

#### Managing Coupons
1. Navigate to "Coupons" section
2. Create percentage or fixed amount discounts
3. Set usage limits and expiration dates
4. Monitor coupon usage statistics

#### Order Management
1. View all orders in the "Orders" section
2. Update order status (pending, processing, shipped, delivered)
3. View detailed order information and customer details

## 🔌 API Documentation

### Authentication Endpoints

#### User Login
```http
POST /api/auth/login
Content-Type: application/json

{
    "email": "user@example.com",
    "password": "password"
}
```

#### User Registration
```http
POST /api/auth/register
Content-Type: application/json

{
    "name": "User Name",
    "email": "user@example.com",
    "password": "password",
    "password_confirmation": "password"
}
```

#### Refresh Token
```http
POST /api/auth/refresh
Authorization: Bearer {token}
```

### Product Endpoints

#### Get All Products
```http
GET /api/products
```

#### Create New Product
```http
POST /api/products
Authorization: Bearer {token}
Content-Type: application/json

{
    "name": "New Product",
    "description": "Product description",
    "price": 99.99,
    "stock": 100,
    "category_id": 1
}
```

### Cart Endpoints

#### Add Product to Cart
```http
POST /api/cart/add
Authorization: Bearer {token}
Content-Type: application/json

{
    "product_id": 1,
    "quantity": 2
}
```

#### Apply Coupon
```http
POST /api/cart/apply-coupon
Authorization: Bearer {token}
Content-Type: application/json

{
    "code": "SAVE20"
}
```

#### Set Shipping Method
```http
POST /api/cart/set-shipping
Authorization: Bearer {token}
Content-Type: application/json

{
    "shipping_id": 1
}
```

#### Get Cart Contents
```http
GET /api/cart
Authorization: Bearer {token}
```

#### Create Order
```http
POST /api/orders
Authorization: Bearer {token}
Content-Type: application/json

{
    "shipping_address": {
        "name": "John Doe",
        "address": "123 Main St",
        "city": "New York",
        "state": "NY",
        "zip": "10001",
        "country": "USA"
    },
    "billing_address": {
        "name": "John Doe",
        "address": "123 Main St",
        "city": "New York",
        "state": "NY",
        "zip": "10001",
        "country": "USA"
    },
    "notes": "Please deliver after 5 PM"
}
```

## 🧪 Testing

### Running Tests
```bash
# All tests
php artisan test

# Specific tests
php artisan test --filter=ProductTest

# With coverage
php artisan test --coverage
```

### API Testing
```bash
# Using Postman or curl
curl -X GET http://localhost:8000/api/products \
  -H "Authorization: Bearer your_token_here"
```

## 🚀 Deployment

### Production Setup
```bash
# Optimize application
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Build assets for production
npm run build

# Run migrations
php artisan migrate --force
```

### Production Environment Variables
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=your_db_host
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

JWT_SECRET=your_production_jwt_secret
```

## 🔧 Maintenance & Development

### Updating the Project
```bash
git pull origin main
composer install --no-dev
php artisan migrate
npm run build
```

### Backup
```bash
# Database backup
php artisan db:backup

# File backup
php artisan storage:backup
```

### Performance Monitoring
```bash
# View slow queries
php artisan telescope:install

# Memory monitoring
php artisan horizon:install
```

## 🤝 Contributing

We welcome contributions! Please follow these steps:

1. Fork the project
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📞 Support & Contact

- **Email**: mohamedatya563@gmail.com
- **Phone/WhatsAPP**:+201098387072 
- **Issues**: [GitHub Issues](https://github.com/mhmdatya72/ShopMaster-Advanced-E-Commerce-System.git/issues)

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - Amazing PHP framework
- [TailwindCSS](https://tailwindcss.com) - CSS framework
- [Alpine.js](https://alpinejs.dev) - Lightweight JavaScript library
- [JWT Auth](https://github.com/tymondesigns/jwt-auth) - JWT authentication

---

<div align="center">
  <p>Made with ❤️ using Laravel</p>
  <p>© 2025 ShopMaster. All rights reserved.</p>
</div>
