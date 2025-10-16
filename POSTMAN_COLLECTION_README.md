#  ShopMaster API Postman Collection

This directory contains a complete Postman collection for testing the ShopMaster E-Commerce API.

##  Files Included

- `ShopMaster_API_Collection.postman_collection.json` - Complete API collection
- `ShopMaster_Environment.postman_environment.json` - Development environment variables
- `POSTMAN_COLLECTION_README.md` - This documentation file

## 🛠️ Setup Instructions

### 1. Import Collection and Environment

1. Open Postman
2. Click **Import** button
3. Import both files:
   - `ShopMaster_API_Collection.postman_collection.json`
   - `ShopMaster_Environment.postman_environment.json`

### 2. Set Environment Variables

1. Select the **ShopMaster Development Environment** from the environment dropdown
2. Update the `base_url` if your Laravel server is running on a different port
3. The `access_token` will be automatically set when you login

### 3. Start Your Laravel Server

```bash
php artisan serve
```

The server will run on `http://127.0.0.1:8000` by default.

##  Authentication Flow

### Step 1: Register a New User
1. Go to **Authentication** → **User Register**
2. Update the request body with your details
3. Send the request
4. Note the response for user details

### Step 2: Login
1. Go to **Authentication** → **User Login**
2. Use the credentials from registration
3. Send the request
4. The `access_token` will be automatically saved to environment variables

### Step 3: Use Protected Endpoints
- All protected endpoints will automatically use the saved `access_token`
- The token will be included in the `Authorization` header as `Bearer {token}`

## API Endpoints Overview

###  Authentication (5 endpoints)
- `POST /api/auth/login` - User login
- `POST /api/auth/register` - User registration
- `POST /api/auth/logout` - User logout
- `POST /api/auth/refresh` - Refresh JWT token
- `GET /api/auth/user-profile` - Get user profile

### 🛍️ Products (5 endpoints)
- `GET /api/products` - Get all products (Public)
- `GET /api/products/{id}` - Get product by ID
- `POST /api/products` - Create product
- `PUT /api/products/{id}` - Update product
- `DELETE /api/products/{id}` - Delete product

###  Categories (5 endpoints)
- `GET /api/categories` - Get all categories
- `GET /api/categories/{id}` - Get category by ID
- `POST /api/categories` - Create category
- `PUT /api/categories/{id}` - Update category
- `DELETE /api/categories/{id}` - Delete category

### 🛒 Cart Management (7 endpoints)
- `GET /api/cart` - Get cart contents
- `POST /api/cart/add` - Add item to cart
- `PUT /api/cart/update` - Update cart item
- `DELETE /api/cart/remove` - Remove item from cart
- `DELETE /api/cart/clear` - Clear entire cart
- `POST /api/cart/apply-coupon` - Apply coupon to cart
- `POST /api/cart/set-shipping` - Set shipping method

###  Orders (4 endpoints)
- `GET /api/orders` - Get all orders
- `GET /api/orders/{id}` - Get order by ID
- `POST /api/orders` - Create order
- `POST /api/orders/{id}/cancel` - Cancel order

###  Coupons (6 endpoints)
- `GET /api/coupons` - Get all coupons
- `GET /api/coupons/{id}` - Get coupon by ID
- `POST /api/coupons` - Create coupon
- `PUT /api/coupons/{id}` - Update coupon
- `DELETE /api/coupons/{id}` - Delete coupon
- `POST /api/coupons/validate` - Validate coupon code

### Shipping Methods (6 endpoints)
- `GET /api/shipping` - Get all shipping methods
- `GET /api/shipping/active` - Get active shipping methods
- `GET /api/shipping/{id}` - Get shipping method by ID
- `POST /api/shipping` - Create shipping method
- `PUT /api/shipping/{id}` - Update shipping method
- `DELETE /api/shipping/{id}` - Delete shipping method

###  Users (4 endpoints)
- `GET /api/users` - Get all users
- `GET /api/users/{id}` - Get user by ID
- `PUT /api/users/{id}` - Update user
- `DELETE /api/users/{id}` - Delete user

###  Analytics (3 endpoints)
- `GET /api/analytics/sales` - Get sales analytics
- `GET /api/analytics/users` - Get user analytics
- `GET /api/analytics/dashboard` - Get dashboard analytics

## 🧪 Testing Workflow

### 1. Basic E-Commerce Flow
1. **Register** a new user
2. **Login** to get access token
3. **Browse products** (public endpoint)
4. **Add products to cart**
5. **Apply a coupon** to cart
6. **Set shipping method**
7. **Create an order**

### 2. Admin Management Flow
1. **Login** as admin user
2. **Create categories**
3. **Create products** with categories
4. **Create coupons**
5. **Create shipping methods**
6. **View analytics**

## 🔧 Environment Variables

| Variable | Description | Default Value |
|----------|-------------|---------------|
| `base_url` | API base URL | `http://127.0.0.1:8000` |
| `access_token` | JWT access token | Auto-populated on login |
| `refresh_token` | JWT refresh token | Auto-populated on login |
| `user_id` | Current user ID | Auto-populated |
| `product_id` | Test product ID | `1` |
| `category_id` | Test category ID | `1` |
| `order_id` | Test order ID | `1` |
| `coupon_id` | Test coupon ID | `1` |
| `shipping_id` | Test shipping method ID | `1` |

##  Rate Limiting

The API implements rate limiting:
- **Authentication endpoints**: 5 requests per minute
- **Cart endpoints**: 60 requests per minute
- **Other endpoints**: No specific limit

## 📝 Request Examples

### Login Request
```json
{
    "email": "user@example.com",
    "password": "password123"
}
```

### Create Product Request
```json
{
    "name": "New Product",
    "description": "Product description here",
    "price": 99.99,
    "stock": 100,
    "category_id": 1,
    "weight": 1.5,
    "attributes": {
        "color": "Red",
        "size": "Large"
    },
    "is_active": true
}
```

### Add to Cart Request
```json
{
    "product_id": 1,
    "quantity": 2
}
```

### Apply Coupon Request
```json
{
    "code": "SAVE20"
}
```

### Create Order Request
```json
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

## 🔍 Response Format

All API responses follow this format:

### Success Response
```json
{
    "success": true,
    "message": "Operation completed successfully",
    "data": {
        // Response data here
    }
}
```

### Error Response
```json
{
    "success": false,
    "message": "Error description",
    "errors": {
        "field_name": ["Validation error message"]
    }
}
```

## 🛠️ Troubleshooting

### Common Issues

1. **401 Unauthorized**
   - Make sure you're logged in and have a valid access token
   - Check if the token has expired and try refreshing it

2. **422 Validation Error**
   - Check the request body format
   - Ensure all required fields are provided
   - Verify data types match the expected format

3. **429 Too Many Requests**
   - You've hit the rate limit
   - Wait a minute before making more requests

4. **500 Internal Server Error**
   - Check if the Laravel server is running
   - Check server logs for detailed error information

### Debug Tips

1. **Check Console Logs**
   - Open Postman Console (View → Show Postman Console)
   - Look for detailed request/response information

2. **Verify Environment Variables**
   - Make sure the correct environment is selected
   - Check that `base_url` is correct

3. **Test Authentication**
   - Try logging in again to get a fresh token
   - Verify the user exists in the database



**Happy Testing! **
