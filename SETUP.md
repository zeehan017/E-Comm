# 🚀 NovaShop Setup Guide

## Quick Setup Instructions

### 1. **Configure Web Server Document Root**

**For XAMPP:**
1. Open XAMPP Control Panel
2. Click "Config" next to Apache
3. Select "httpd.conf"
4. Find the `DocumentRoot` line
5. Change it to: `DocumentRoot "/opt/lampp/htdocs/E-Comm/public"`
6. Also update: `<Directory "/opt/lampp/htdocs/E-Comm/public">`
7. Restart Apache

**For WAMP:**
1. Right-click WAMP icon in system tray
2. Apache → httpd.conf
3. Update DocumentRoot to your project's public folder
4. Restart WAMP

### 2. **Database Setup**

1. Open phpMyAdmin: `http://localhost/phpmyadmin`
2. Create new database: `asifechom`
3. Import: `database/database.sql`

### 3. **Test the Application**

Visit: `http://localhost/` (or your configured domain)

## 📁 **New Folder Structure Benefits**

### **Security**
- ✅ Public files only in `public/` directory
- ✅ Sensitive files outside web root
- ✅ `.htaccess` protection for sensitive files

### **Organization**
- ✅ Controllers separated from views
- ✅ Configuration centralized
- ✅ Assets properly organized

### **Scalability**
- ✅ Easy to add new features
- ✅ Clean routing system
- ✅ Modular architecture

### **SEO**
- ✅ Clean URLs (e.g., `/products` instead of `/products.php`)
- ✅ Better search engine indexing
- ✅ Professional URL structure

## 🔗 **URL Examples**

| Old URL | New URL |
|---------|---------|
| `index.php` | `/` |
| `products.php` | `/products` |
| `cart.php` | `/cart` |
| `admin.php` | `/admin` |
| `login.php` | `/login` |

## 🛠️ **Development Workflow**

### **Adding New Pages**
1. Create controller: `src/controllers/newpage.php`
2. Add route: `public/index.php` (routes array)
3. Update navigation: `src/helpers/header.php`

### **Styling**
- Edit: `public/css/style.css`
- Add images: `public/images/`
- Add JavaScript: `public/js/`

### **Database Changes**
- Update: `database/database.sql`
- Import changes to your database

## 🐛 **Troubleshooting**

### **404 Errors**
- Check if mod_rewrite is enabled
- Verify `.htaccess` file exists in `public/`
- Ensure document root is set correctly

### **Database Issues**
- Check `config/database.php` settings
- Ensure MySQL is running
- Verify database exists

### **Permission Issues**
- Check file permissions (755 for directories, 644 for files)
- Ensure web server can read project files

## ✅ **Verification Checklist**

- [ ] Document root points to `public/` folder
- [ ] Database `asifechom` exists and has tables
- [ ] Apache mod_rewrite is enabled
- [ ] All files have correct permissions
- [ ] Can access homepage at root URL
- [ ] Admin login works (`admin@novashop.com` / `password`)

## 🎯 **Next Steps**

1. **Test all functionality**
2. **Customize styling** in `public/css/style.css`
3. **Add products** through admin panel
4. **Configure email settings** (if needed)
5. **Set up SSL** for production

---

**Your e-commerce platform is now ready with a professional folder structure! 🎉**
