# NovaShop E-Commerce Platform

A complete e-commerce solution built with PHP and MySQL, featuring user authentication, product management, shopping cart, wishlist, and admin panel.

## 🏗️ **New Project Structure**

```
E-Comm/
├── public/                     # Public web root (Document Root)
│   ├── index.php              # Main entry point
│   ├── .htaccess              # URL rewriting & security
│   ├── css/                   # Stylesheets
│   │   └── style.css
│   ├── js/                    # JavaScript files
│   └── images/                # Image assets
├── src/                       # Application source code
│   ├── controllers/           # Page controllers
│   │   ├── index.php         # Homepage
│   │   ├── products.php      # Product listing
│   │   ├── cart.php          # Shopping cart
│   │   ├── wishlist.php      # User wishlist
│   │   ├── profile.php       # User profile
│   │   ├── login.php         # Authentication
│   │   ├── register.php      # User registration
│   │   ├── admin.php         # Admin panel
│   │   ├── payment.php       # Checkout
│   │   ├── order_confirmation.php
│   │   └── logout.php
│   ├── helpers/              # Helper functions
│   │   ├── session.php       # Session management
│   │   ├── header.php        # Page header
│   │   └── footer.php        # Page footer
│   ├── models/               # Data models (future)
│   └── views/                # View templates (future)
├── config/                   # Configuration files
│   └── database.php          # Database configuration
├── database/                 # Database files
│   └── database.sql          # Database schema
├── docs/                     # Documentation
├── stack/                    # Old/unused files
└── README.md                 # This file
```

## ✨ **Features**

- **User Authentication**: Registration, login, and session management
- **Product Management**: Browse, search, and filter products
- **Shopping Cart**: Add/remove items, quantity management
- **Wishlist**: Save favorite products for later
- **Order Processing**: Complete checkout with payment simulation
- **Admin Panel**: Manage products, orders, and users
- **Responsive Design**: Modern UI that works on all devices
- **Clean URLs**: SEO-friendly routing (e.g., `/products`, `/cart`)
- **Security**: XSS protection, SQL injection prevention, secure headers

## 🚀 **Installation**

### Prerequisites

- XAMPP, WAMP, or similar local server
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache with mod_rewrite enabled

### Setup Instructions

1. **Clone/Download the project**
   ```bash
   # Place the project in your web server directory
   # For XAMPP: /opt/lampp/htdocs/E-Comm/
   ```

2. **Set Document Root**
   - Configure your web server to use `public/` as the document root
   - For XAMPP: Point to `/opt/lampp/htdocs/E-Comm/public/`

3. **Create Database**
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named `asifechom`
   - Import the `database/database.sql` file

4. **Configure Database Connection**
   - Edit `config/database.php` if needed
   - Default settings:
     - Host: localhost
     - Username: root
     - Password: (empty)
     - Database: asifechom

5. **Start the Application**
   - Start your web server (Apache)
   - Navigate to `http://localhost/E-Comm/public/`

## 👤 **Default Admin Account**

- **Email**: admin@novashop.com
- **Password**: password
- **Role**: Admin

## 🔗 **URL Structure**

- **Homepage**: `/`
- **Products**: `/products`
- **Cart**: `/cart`
- **Wishlist**: `/wishlist`
- **Profile**: `/profile`
- **Login**: `/login`
- **Register**: `/register`
- **Admin Panel**: `/admin`
- **Payment**: `/payment`

## 🛡️ **Security Features**

- **Password Hashing**: Using PHP's `password_hash()`
- **SQL Injection Prevention**: Prepared statements and escaping
- **Session Security**: Secure session management
- **Input Validation**: Server-side validation
- **Security Headers**: XSS protection, content type sniffing prevention
- **File Access Control**: Sensitive files protected from direct access

## 🎨 **Design Features**

- **Modern UI**: Clean, professional design
- **Responsive**: Works on desktop, tablet, and mobile
- **Dark Theme**: Purple accent colors
- **CSS Custom Properties**: Easy theming
- **Optimized Assets**: Compressed CSS/JS with caching

## 🔧 **Technical Stack**

- **Backend**: PHP 7.4+
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **Server**: Apache with mod_rewrite
- **Authentication**: Session-based
- **Security**: Multiple layers of protection

## 📁 **Key Files Explained**

### **Entry Point**
- `public/index.php`: Main router that handles all requests

### **Configuration**
- `config/database.php`: Database and application settings

### **Controllers**
- `src/controllers/`: Contains all page logic and business rules

### **Helpers**
- `src/helpers/`: Reusable functions and components

### **Assets**
- `public/css/`: Stylesheets
- `public/js/`: JavaScript files
- `public/images/`: Image assets

## 🚀 **Development**

### **Adding New Pages**
1. Create controller in `src/controllers/`
2. Add route in `public/index.php`
3. Update navigation in `src/helpers/header.php`

### **Styling**
- Modify `public/css/style.css`
- Uses CSS custom properties for easy theming

### **Database Changes**
- Update `database/database.sql`
- Import changes to your database

## 🐛 **Troubleshooting**

### **Common Issues**

1. **404 Errors**
   - Ensure mod_rewrite is enabled
   - Check `.htaccess` file exists
   - Verify document root is set to `public/`

2. **Database Connection**
   - Check `config/database.php` settings
   - Ensure MySQL is running
   - Verify database exists

3. **Permission Issues**
   - Check file permissions
   - Ensure web server can read files

### **Debug Mode**
- Check Apache error logs
- Enable PHP error reporting
- Use browser developer tools

## 📝 **License**

This project is for educational purposes. Feel free to use and modify as needed.

## 🤝 **Support**

For issues or questions:
- Check the troubleshooting section
- Review the code comments
- Test with the provided sample data

---

**Built with ❤️ using PHP & MySQL**