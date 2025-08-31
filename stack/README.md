# Stack Folder - Old/Unused Files

This folder contains the original HTML and PHP files that were replaced by the new e-commerce system.

## Files in this folder:

### HTML Files (Static versions)
- `admin.html` - Static admin panel page
- `cart.html` - Static shopping cart page
- `index.html` - Static homepage
- `payment.html` - Static payment page
- `products.html` - Static products page
- `profile.html` - Static profile page
- `wishlist.html` - Static wishlist page

### Old PHP Files
- `connect.php` - Old database connection file (replaced by config/db.php)
- `register_new.php` - Old registration file (replaced by register.php)
- `style.css` - Old CSS file (moved to assets/css/style.css)

## Why these files are here:

These files were the original static/demo versions of the e-commerce site. They have been replaced by:

1. **Dynamic PHP files** with database integration
2. **Proper folder structure** with config/, includes/, and assets/ directories
3. **Session management** and user authentication
4. **Database-driven content** instead of static HTML

## Current Active Files:

The new e-commerce system uses these files in the main directory:
- `index.php` - Dynamic homepage
- `products.php` - Dynamic product listing
- `cart.php` - Functional shopping cart
- `wishlist.php` - User wishlist management
- `profile.php` - User profile dashboard
- `admin.php` - Admin panel
- `login.php` / `register.php` - Authentication
- `payment.php` - Checkout process
- `order_confirmation.php` - Order confirmation

## Note:

These files are kept for reference but are no longer used by the application. You can safely delete this folder if you don't need the old files for reference.
