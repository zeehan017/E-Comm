# NovaShop E-Commerce - Windows Setup Guide

This guide will help you set up NovaShop E-Commerce on Windows using XAMPP.

## Prerequisites

1. **XAMPP** - Download and install XAMPP from [https://www.apachefriends.org/](https://www.apachefriends.org/)
2. **PHP 7.4 or higher** (included with XAMPP)
3. **MySQL** (included with XAMPP)
4. **Apache** (included with XAMPP)

## Installation Steps

### 1. Install XAMPP

1. Download XAMPP for Windows
2. Run the installer as Administrator
3. Install to default location: `C:\xampp`
4. Start XAMPP Control Panel

### 2. Start Services

1. Open XAMPP Control Panel
2. Start **Apache** service
3. Start **MySQL** service
4. Verify both services are running (green status)

### 3. Project Setup

1. Extract the NovaShop project to: `C:\xampp\htdocs\E-Comm\`
2. Your project structure should be:
   ```
   C:\xampp\htdocs\E-Comm\
   ├── config\
   ├── database\
   ├── public\
   ├── src\
   ├── index.php
   ├── .htaccess
   └── windows_setup.php
   ```

### 4. Database Setup

1. Open your browser and go to: `http://localhost/phpmyadmin`
2. Create a new database named: `asifechom`
3. Import the database structure:
   - Click on the `asifechom` database
   - Go to **Import** tab
   - Choose file: `database/database.sql`
   - Click **Go** to import

### 5. Configuration

1. Run the Windows setup script: `http://localhost/E-Comm/windows_setup.php`
2. This will check all requirements and guide you through setup
3. Verify all checks pass (✅)

### 6. Test the Application

1. Navigate to: `http://localhost/E-Comm/`
2. You should see the NovaShop homepage
3. Test login with:
   - Email: `admin@novashop.com`
   - Password: `password`

## Configuration Files

### Database Configuration (`config/database.php`)

The application automatically detects Windows vs Linux and configures accordingly:

```php
// Windows uses standard MySQL connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, 3306);

// Linux fallback with socket
if ($conn->connect_error && file_exists('/opt/lampp/var/mysql/mysql.sock')) {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, 3306, '/opt/lampp/var/mysql/mysql.sock');
}
```

### Windows Configuration (`config/windows_config.php`)

Contains Windows-specific settings and helper functions:

- XAMPP paths
- Cross-platform file operations
- Windows-specific database connections
- Error logging

## Common Issues & Solutions

### 1. Database Connection Failed

**Symptoms:** "Connection failed" error

**Solutions:**
- Make sure MySQL service is running in XAMPP
- Check if port 3306 is not blocked by firewall
- Verify database credentials in `config/database.php`
- Try restarting MySQL service

### 2. Page Not Found (404)

**Symptoms:** All pages return 404 error

**Solutions:**
- Enable mod_rewrite in Apache:
  1. Open `C:\xampp\apache\conf\httpd.conf`
  2. Uncomment: `LoadModule rewrite_module modules/mod_rewrite.so`
  3. Restart Apache
- Check if `.htaccess` files exist
- Verify project is in correct directory

### 3. Static Assets Not Loading

**Symptoms:** CSS/JS/images not loading

**Solutions:**
- Check file permissions
- Verify `.htaccess` files exist
- Check browser console for errors
- Ensure mod_rewrite is enabled

### 4. Permission Denied

**Symptoms:** "Permission denied" errors

**Solutions:**
- Run XAMPP as Administrator
- Check Windows Defender/Antivirus settings
- Verify file permissions
- Check if files are not read-only

### 5. Session Issues

**Symptoms:** Login/logout not working

**Solutions:**
- Check session directory permissions
- Verify session configuration
- Clear browser cookies
- Check PHP session settings

## Apache Configuration

### Enable mod_rewrite

1. Open: `C:\xampp\apache\conf\httpd.conf`
2. Find and uncomment: `LoadModule rewrite_module modules/mod_rewrite.so`
3. Restart Apache

### Virtual Host (Optional)

For better URL handling, you can create a virtual host:

```apache
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/E-Comm"
    ServerName novashop.local
    <Directory "C:/xampp/htdocs/E-Comm">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

## File Structure

```
E-Comm/
├── config/
│   ├── database.php          # Database configuration
│   └── windows_config.php    # Windows-specific settings
├── database/
│   └── database.sql          # Database structure
├── public/
│   └── css/
│       ├── .htaccess         # Apache configuration
│       └── style.css         # Stylesheets
├── src/
│   ├── controllers/          # Application controllers
│   └── helpers/              # Helper functions
├── .htaccess                 # Main Apache configuration
├── index.php                 # Application entry point
├── windows_setup.php         # Windows setup script
└── WINDOWS_SETUP.md          # This guide
```

## Security Notes

1. **Delete setup files** after successful installation:
   - `setup.php`
   - `windows_setup.php`

2. **Change default passwords**:
   - Database root password
   - Admin user password

3. **Configure firewall** to allow only necessary ports

4. **Keep XAMPP updated** for security patches

## Troubleshooting

### Check XAMPP Logs

- Apache logs: `C:\xampp\apache\logs\`
- MySQL logs: `C:\xampp\mysql\data\`
- PHP logs: `C:\xampp\php\logs\`

### Enable Error Reporting

Add to `config/database.php` for debugging:

```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

### Test Database Connection

Create a test file `test_db.php`:

```php
<?php
require_once 'config/database.php';
echo "Database connection successful!";
?>
```

## Support

If you encounter issues:

1. Check the Windows setup script output
2. Review XAMPP logs
3. Verify all prerequisites are met
4. Test with a simple PHP file first

## Migration from Linux

If migrating from Linux to Windows:

1. Export database from Linux
2. Import to Windows MySQL
3. Update file paths if needed
4. Test all functionality
5. Update any Linux-specific configurations

---

**Note:** This application is now cross-platform compatible and will automatically detect and configure for Windows or Linux systems.
