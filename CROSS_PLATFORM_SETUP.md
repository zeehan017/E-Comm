# NovaShop E-Commerce - Cross-Platform Setup Guide

This guide will help you set up NovaShop E-Commerce on **Windows**, **macOS**, and **Linux** systems.

## 🌍 **System Compatibility**

- ✅ **Windows 10/11** (with XAMPP)
- ✅ **macOS** (with XAMPP)
- ✅ **Linux** (Ubuntu, CentOS, etc. with XAMPP)
- ✅ **PHP 7.4+** (included with XAMPP)
- ✅ **MySQL 5.7+** (included with XAMPP)
- ✅ **Apache 2.4+** (included with XAMPP)

## 📋 **Prerequisites**

### **All Platforms**
1. **XAMPP** - Download from [https://www.apachefriends.org/](https://www.apachefriends.org/)
2. **Web Browser** - Chrome, Firefox, Safari, or Edge
3. **Text Editor** - VS Code, Sublime Text, or Notepad++

## 🚀 **Installation Steps**

### **Step 1: Install XAMPP**

#### **Windows**
1. Download XAMPP for Windows
2. Run installer as Administrator
3. Install to default location: `C:\xampp`
4. Start XAMPP Control Panel

#### **macOS**
1. Download XAMPP for macOS
2. Open the downloaded `.dmg` file
3. Drag XAMPP to Applications folder
4. Start XAMPP from Applications

#### **Linux**
```bash
# Download XAMPP
wget https://sourceforge.net/projects/xampp/files/XAMPP%20Linux/8.2.4/xampp-linux-x64-8.2.4-0-installer.run

# Make executable
chmod +x xampp-linux-x64-8.2.4-0-installer.run

# Install
sudo ./xampp-linux-x64-8.2.4-0-installer.run
```

### **Step 2: Start Services**

#### **Windows**
1. Open XAMPP Control Panel
2. Click **Start** for Apache
3. Click **Start** for MySQL
4. Verify both show green status

#### **macOS**
1. Open XAMPP from Applications
2. Click **Start** for Apache
3. Click **Start** for MySQL
4. Verify both show green status

#### **Linux**
```bash
# Start XAMPP services
sudo /opt/lampp/lampp start

# Check status
sudo /opt/lampp/lampp status
```

### **Step 3: Project Setup**

#### **All Platforms**
1. Extract NovaShop project to XAMPP htdocs:
   - **Windows**: `C:\xampp\htdocs\E-Comm\`
   - **macOS**: `/Applications/XAMPP/xamppfiles/htdocs/E-Comm/`
   - **Linux**: `/opt/lampp/htdocs/E-Comm/`

2. Your project structure should be:
   ```
   E-Comm/
   ├── config/
   │   ├── database.php
   │   └── system_config.php
   ├── database/
   │   └── database.sql
   ├── public/
   │   └── css/
   │       └── style.css
   ├── src/
   │   ├── controllers/
   │   └── helpers/
   ├── index.php
   ├── .htaccess
   └── setup_cross_platform.php
   ```

### **Step 4: Database Setup**

#### **All Platforms**
1. Open browser and go to: `http://localhost/phpmyadmin`
2. Create new database named: `asifechom`
3. Import database structure:
   - Click on `asifechom` database
   - Go to **Import** tab
   - Choose file: `database/database.sql`
   - Click **Go** to import

### **Step 5: Run Setup Script**

#### **All Platforms**
1. Navigate to: `http://localhost/E-Comm/setup_cross_platform.php`
2. Follow the on-screen instructions
3. Verify all checks pass (✅)

### **Step 6: Test Application**

#### **All Platforms**
1. Navigate to: `http://localhost/E-Comm/`
2. You should see the NovaShop homepage
3. Test login with:
   - Email: `admin@novashop.com`
   - Password: `password`

## 🔧 **System-Specific Configuration**

### **Automatic Detection**
The application automatically detects your operating system and configures:
- **Database connections** (TCP vs Socket)
- **File paths** (Windows backslashes vs Unix forward slashes)
- **XAMPP paths** (different on each platform)
- **Error logging** (system-specific paths)

### **Manual Configuration (if needed)**
Edit `config/system_config.php` to customize:
- XAMPP installation paths
- Database connection settings
- File permissions
- Error logging locations

## 🛠️ **Troubleshooting**

### **Common Issues**

#### **Database Connection Failed**
- **Solution**: Make sure MySQL service is running
- **Check**: XAMPP Control Panel shows green status
- **Test**: `http://localhost/phpmyadmin`

#### **CSS Not Loading**
- **Solution**: Check .htaccess file exists
- **Check**: Apache mod_rewrite is enabled
- **Test**: `http://localhost/E-Comm/css/style.css`

#### **Permission Denied**
- **Windows**: Run XAMPP as Administrator
- **macOS**: Check System Preferences > Security
- **Linux**: Use `sudo /opt/lampp/lampp start`

#### **Port Already in Use**
- **Solution**: Stop other web servers (IIS, Apache, etc.)
- **Check**: Ports 80 (Apache) and 3306 (MySQL)
- **Alternative**: Change ports in XAMPP configuration

### **Platform-Specific Issues**

#### **Windows**
- **Issue**: PATH_SEPARATOR constant conflict
- **Solution**: Already fixed in system_config.php
- **Issue**: File path issues
- **Solution**: Automatic path conversion implemented

#### **macOS**
- **Issue**: XAMPP permissions
- **Solution**: Grant full disk access to XAMPP
- **Issue**: MySQL socket connection
- **Solution**: Automatic fallback to TCP implemented

#### **Linux**
- **Issue**: SELinux blocking Apache
- **Solution**: `sudo setsebool -P httpd_can_network_connect 1`
- **Issue**: Firewall blocking ports
- **Solution**: `sudo ufw allow 80` and `sudo ufw allow 3306`

## 📁 **Project Structure**

```
E-Comm/
├── config/
│   ├── database.php          # Database configuration
│   └── system_config.php     # Cross-platform configuration
├── database/
│   └── database.sql          # Database structure
├── public/
│   └── css/
│       └── style.css         # Stylesheets
├── src/
│   ├── controllers/          # Application controllers
│   └── helpers/              # Helper functions
├── less/                     # Temporary files
├── .htaccess                 # Apache configuration
├── index.php                 # Application entry point
├── setup_cross_platform.php  # Cross-platform setup
└── CROSS_PLATFORM_SETUP.md   # This guide
```

## 🔒 **Security Notes**

1. **Delete setup files** after successful installation:
   - `setup_cross_platform.php`
   - Any test files in `less/` directory

2. **Change default passwords**:
   - Database root password
   - Admin user password

3. **Configure firewall** to allow only necessary ports

4. **Keep XAMPP updated** for security patches

## 🌐 **Access URLs**

- **Homepage**: `http://localhost/E-Comm/`
- **Login**: `http://localhost/E-Comm/login`
- **Register**: `http://localhost/E-Comm/register`
- **Admin**: `http://localhost/E-Comm/admin`
- **phpMyAdmin**: `http://localhost/phpmyadmin`

## 📞 **Support**

If you encounter issues:

1. **Run setup script**: `http://localhost/E-Comm/setup_cross_platform.php`
2. **Check XAMPP logs**:
   - **Windows**: `C:\xampp\apache\logs\`
   - **macOS**: `/Applications/XAMPP/xamppfiles/logs/`
   - **Linux**: `/opt/lampp/logs/`
3. **Verify system requirements** are met
4. **Test with simple PHP file** first

---

**Note**: This application is now fully cross-platform compatible and will automatically detect and configure for Windows, macOS, or Linux systems.
