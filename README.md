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

**ShopMaster** is an advanced, comprehensive e-commerce system built on Laravel 12 with a modern user interface and exceptional user experience. The system provides all essential and advanced e-commerce features with a focus on security, performance, and scalability.

## ✨ Key Features

### 🎨 Frontend (Client-Facing)
- **Homepage** — Featured products showcase
- **Product Listing** — Advanced search, filter, and sort functionality
- **Product Detail Page** — Multiple images and comprehensive product information
- **Shopping Cart** — Real-time updates with coupon application
- **Checkout Page** — Secure payment with shipping method selection
- **User Profile** — Order tracking and profile management
- **Order Details** — Complete order history and tracking
- **Responsive Design** — Works seamlessly on all devices

### ⚙️ Backend (Admin & API)
- **Comprehensive API** — RESTful endpoints for all operations
- **Advanced Admin Dashboard** — Complete management interface
- **JWT Authentication** — Secure token-based authentication
- **Product & Category Management** — With image upload capabilities
- **Coupon System** — Multiple discount types and validation
- **Shipping Management** — Configurable shipping methods and costs
- **Analytics & Statistics** — Detailed reporting and insights

### 🔐 Security & Protection
- **JWT Authentication** — With automatic token refresh for API
- **CSRF Protection** — For all web forms
- **Password Encryption** — Using Bcrypt
- **Data Validation** — At all levels with Form Requests
- **Admin Protection** — Custom middleware for admin routes
- **Rate Limiting** — ThrottleRequests middleware for API endpoints
- **CORS Configuration** — For frontend domain access
- **Input Sanitization** — XSS protection on all inputs
- **SQL Injection Prevention** — Eloquent ORM with parameterized queries

## 🚀 Technologies Used

### Backend
- **Laravel 12.x** — Advanced PHP framework
- **PHP 8.2+** — Core programming language
- **MySQL/SQLite** — Database management
- **JWT Auth** — Token-based authentication for API

### Frontend
- **Blade Templates** — Template engine
- **TailwindCSS 3.x** — CSS framework
- **Alpine.js** — Lightweight JavaScript library
- **Vanilla JavaScript** — For API interaction

### Development Tools
- **Laravel Pint** — Code formatting
- **Laravel Sail** — Development environment
- **PHPUnit** — Unit testing
- **Faker** — Test data generation

## 🏗️ Architecture & Design Patterns

### SOLID Principles Implementation

#### 1. **Single Responsibility Principle (SRP)**
- **Controllers**: Handle only HTTP requests/responses
- **Services**: Contain business logic only
- **Models**: Manage data relationships and validation
- **Repositories**: Handle data access operations

#### 2. **Open/Closed Principle (OCP)**
- **Service Interfaces**: Allow extension without modification
- **Middleware**: Extensible authentication and authorization
- **Event Listeners**: Pluggable event handling

#### 3. **Liskov Substitution Principle (LSP)**
- **Service Implementations**: Interchangeable through interfaces
- **Payment Gateways**: Consistent interface for different providers
- **Storage Drivers**: Unified interface for different storage types

#### 4. **Interface Segregation Principle (ISP)**
- **Focused Interfaces**: Separate concerns (ProductService, CartService, etc.)
- **Specific Contracts**: Each service has its own interface
- **Minimal Dependencies**: Controllers depend only on what they need

#### 5. **Dependency Inversion Principle (DIP)**
- **Service Container**: High-level modules don't depend on low-level modules
- **Interface Binding**: Concrete implementations bound to interfaces
- **Dependency Injection**: Constructor injection throughout the application

### Design Patterns Used

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
        private ProductRepositoryInterface $productRepository,
        private ImageServiceInterface $imageService
    ) {}
}
```

#### 2. **Repository Pattern**
```php
interface ProductRepositoryInterface
{
    public function find(int $id): ?Product;
    public function create(array $data): Product;
    public function update(int $id, array $data): Product;
    public function delete(int $id): bool;
    public function paginate(int $perPage): LengthAwarePaginator;
}
```

#### 3. **Factory Pattern**
```php
class PaymentGatewayFactory
{
    public static function create(string $type): PaymentGatewayInterface
    {
        return match($type) {
            'stripe' => new StripeGateway(),
            'paypal' => new PayPalGateway(),
            'square' => new SquareGateway(),
            default => throw new InvalidArgumentException("Unsupported gateway: {$type}")
        };
    }
}
```

#### 4. **Observer Pattern**
```php
class OrderObserver
{
    public function created(Order $order): void
    {
        // Send confirmation email
        // Update inventory
        // Log order creation
    }
    
    public function updated(Order $order): void
    {
        // Handle status changes
        // Send notifications
    }
}
```

#### 5. **Strategy Pattern**
```php
interface DiscountStrategyInterface
{
    public function calculate(float $amount, array $parameters): float;
}

class PercentageDiscountStrategy implements DiscountStrategyInterface
{
    public function calculate(float $amount, array $parameters): float
    {
        return $amount * ($parameters['percentage'] / 100);
    }
}
```

### Service Container Architecture

#### Service Registration
```php
// AppServiceProvider.php
public function register(): void
{
    // Service Layer Bindings
    $this->app->bind(ProductServiceInterface::class, ProductService::class);
    $this->app->bind(CartServiceInterface::class, CartService::class);
    $this->app->bind(OrderServiceInterface::class, OrderService::class);
    $this->app->bind(CouponServiceInterface::class, CouponService::class);
    $this->app->bind(ShippingServiceInterface::class, ShippingService::class);
    $this->app->bind(AdminServiceInterface::class, AdminService::class);
    $this->app->bind(UserServiceInterface::class, UserService::class);
    
    // Repository Layer Bindings
    $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
    
    // External Service Bindings
    $this->app->bind(PaymentGatewayInterface::class, StripeGateway::class);
    $this->app->bind(EmailServiceInterface::class, MailgunEmailService::class);
}
```

#### Dependency Injection Usage
```php
class ProductController extends Controller
{
    public function __construct(
        private ProductServiceInterface $productService,
        private ImageServiceInterface $imageService,
        private CacheServiceInterface $cacheService
    ) {}
    
    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->createProduct($request->validated());
        return response()->json(['success' => true, 'data' => $product]);
    }
}
```

## 📁 Project Structure

```
ecommerce/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/           # API Controllers
│   │   │   ├── Admin/         # Admin Controllers
│   │   │   ├── Auth/          # Authentication Controllers
│   │   │   └── Web/           # Web Controllers
│   │   ├── Middleware/        # Custom Middleware
│   │   └── Requests/          # Form Request Validation
│   ├── Models/                # Eloquent Models
│   ├── Services/              # Business Logic Services
│   │   ├── Contracts/         # Service Interfaces
│   │   └── Implements/        # Service Implementations
│   └── Providers/             # Service Providers
├── database/
│   ├── migrations/            # Database Migrations
│   ├── seeders/              # Database Seeders
│   └── factories/            # Model Factories
├── resources/
│   ├── views/                # Blade Templates
│   │   ├── admin/           # Admin Views
│   │   ├── auth/            # Auth Views
│   │   ├── cart/            # Cart Views
│   │   ├── checkout/        # Checkout Views
│   │   ├── orders/          # Order Views
│   │   ├── products/        # Product Views
│   │   └── profile/         # Profile Views
│   ├── css/                 # Stylesheets
│   └── js/                  # JavaScript Files
├── routes/
│   ├── web.php              # Web Routes
│   ├── api.php              # API Routes
│   └── admin.php            # Admin Routes
└── storage/                 # File Storage
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
- `POST /api/auth/logout` — User logout
- `POST /api/auth/refresh` — Refresh JWT token
- `GET /api/auth/user-profile` — Get user profile

### User Management
- `GET /api/users` — Get all users (Admin)
- `GET /api/users/{id}` — Get user by ID
- `PUT /api/users/{id}` — Update user
- `DELETE /api/users/{id}` — Delete user (Admin)

### Product Management
- `GET /api/products` — Get all products (Public)
- `POST /api/products` — Create product (Admin)
- `GET /api/products/{id}` — Get product by ID
- `PUT /api/products/{id}` — Update product (Admin)
- `DELETE /api/products/{id}` — Delete product (Admin)

### Category Management
- `GET /api/categories` — Get all categories
- `POST /api/categories` — Create category (Admin)
- `GET /api/categories/{id}` — Get category by ID
- `PUT /api/categories/{id}` — Update category (Admin)
- `DELETE /api/categories/{id}` — Delete category (Admin)

### Order Management
- `GET /api/orders` — Get all orders (Admin)
- `GET /api/orders/{id}` — Get order by ID
- `PUT /api/orders/{id}` — Update order (Admin)

### Coupon Management
- `GET /api/coupons` — Get all coupons (Admin)
- `POST /api/coupons` — Create coupon (Admin)
- `GET /api/coupons/{id}` — Get coupon by ID
- `PUT /api/coupons/{id}` — Update coupon (Admin)
- `DELETE /api/coupons/{id}` — Delete coupon (Admin)
- `POST /api/coupons/validate` — Validate coupon code

### Shipping Methods
- `GET /api/shipping` — Get all shipping methods
- `POST /api/shipping` — Create shipping method (Admin)
- `GET /api/shipping/active` — Get active shipping methods
- `GET /api/shipping/{id}` — Get shipping method by ID
- `PUT /api/shipping/{id}` — Update shipping method (Admin)
- `DELETE /api/shipping/{id}` — Delete shipping method (Admin)

### Cart Management
- `GET /api/cart` — Get cart contents
- `POST /api/cart/add` — Add item to cart
- `PUT /api/cart/update` — Update cart item
- `DELETE /api/cart/remove` — Remove item from cart
- `DELETE /api/cart/clear` — Clear entire cart
- `POST /api/cart/apply-coupon` — Apply coupon to cart
- `POST /api/cart/set-shipping` — Set shipping method

### Analytics
- `GET /api/analytics/sales` — Sales statistics (Admin)
- `GET /api/analytics/users` — User statistics (Admin)
- `GET /api/analytics/dashboard` — Dashboard data (Admin)

## 🌐 Web Routes

### Public Routes
- `GET /` — Homepage with featured products
- `GET /products` — Product listing page
- `GET /products/{slug}` — Product detail page
- `GET /login` — Login page
- `POST /login` — Process login
- `GET /register` — Registration page
- `POST /register` — Process registration

### Protected Routes (Require Authentication)
- `GET /cart` — Shopping cart page
- `GET /cart/count` — Get cart item count
- `POST /cart/add` — Add item to cart
- `PUT /cart/update` — Update cart item quantity
- `DELETE /cart/remove` — Remove item from cart
- `POST /cart/apply-coupon` — Apply coupon to cart
- `DELETE /cart/remove-coupon` — Remove applied coupon
- `POST /cart/update-shipping` — Update shipping method
- `GET /cart/totals` — Get cart totals

- `GET /checkout` — Checkout page (Protected)
- `POST /checkout` — Process checkout (Protected)

- `GET /orders` — User order history
- `GET /orders/{id}` — Order details
- `POST /orders/{id}/cancel` — Cancel order

- `GET /profile` — User profile page
- `GET /profile/edit` — Edit profile page
- `PUT /profile/update` — Update profile

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
1. Navigate to the registration page
2. Fill in the required information
3. Click "Create Account"

#### Adding Product to Cart
1. Browse products
2. Click "Add to Cart"
3. Choose desired quantity

#### Applying a Coupon
1. Go to cart page
2. Enter coupon code
3. Click "Apply"

#### Completing an Order
1. Navigate to checkout page
2. Enter shipping address
3. Choose shipping method
4. Complete payment process

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

- **Email**: support@shopmaster.com
- **Website**: https://shopmaster.com
- **Documentation**: https://docs.shopmaster.com
- **Issues**: [GitHub Issues](https://github.com/your-username/shopmaster/issues)

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - Amazing PHP framework
- [TailwindCSS](https://tailwindcss.com) - CSS framework
- [Alpine.js](https://alpinejs.dev) - Lightweight JavaScript library
- [JWT Auth](https://github.com/tymondesigns/jwt-auth) - JWT authentication

---

<div align="center">
  <p>Made with ❤️ using Laravel</p>
  <p>© 2024 ShopMaster. All rights reserved.</p>
</div>
