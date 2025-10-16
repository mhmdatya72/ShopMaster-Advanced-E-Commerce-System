// ShopMaster API Pre-request Scripts
// This script runs before each request in the collection

// Auto-set base URL if not set
if (!pm.environment.get('base_url')) {
    pm.environment.set('base_url', 'http://127.0.0.1:8000');
}

// Add timestamp to requests for debugging
pm.globals.set('request_timestamp', new Date().toISOString());

// Auto-generate test data if needed
if (!pm.environment.get('test_email')) {
    const timestamp = Date.now();
    pm.environment.set('test_email', `test${timestamp}@example.com`);
    pm.environment.set('test_name', `Test User ${timestamp}`);
}

// Add request ID for tracking
pm.globals.set('request_id', pm.variables.replaceIn('{{$randomUUID}}'));

// Log request details
console.log(' Making request to:', pm.request.url.toString());
console.log(' Request time:', pm.globals.get('request_timestamp'));
console.log('Request ID:', pm.globals.get('request_id'));

// Check if access token is needed and available
const protectedEndpoints = [
    '/api/auth/logout',
    '/api/auth/refresh',
    '/api/auth/user-profile',
    '/api/cart',
    '/api/orders',
    '/api/products',
    '/api/categories',
    '/api/coupons',
    '/api/shipping',
    '/api/users',
    '/api/analytics'
];

const currentUrl = pm.request.url.toString();
const needsAuth = protectedEndpoints.some(endpoint => currentUrl.includes(endpoint));

if (needsAuth && !pm.environment.get('access_token')) {
    console.warn('⚠ This endpoint requires authentication but no access token found');
    console.log(' Please login first to get an access token');
}

// Add common headers
pm.request.headers.add({
    key: 'Accept',
    value: 'application/json'
});

pm.request.headers.add({
    key: 'X-Request-ID',
    value: pm.globals.get('request_id')
});

// Add User-Agent header
pm.request.headers.add({
    key: 'User-Agent',
    value: 'ShopMaster-Postman-Collection/1.0'
});

console.log(' Pre-request script completed');
