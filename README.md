# E-Shop - Online Shopping Platform

E-Shop is a full-featured e-commerce platform built with PHP, offering a seamless online shopping experience for customers. The platform includes user authentication, product management, shopping cart functionality, and an admin dashboard.

## Features

- **User Authentication**
  - User registration and login
  - Profile management
  - Secure session handling

- **Product Management**
  - Product browsing and search
  - Category-based navigation
  - Quick view functionality
  - Product wishlist

- **Shopping Experience**
  - Shopping cart functionality
  - Checkout process
  - Order tracking
  - Wishlist management

- **Admin Dashboard**
  - Product management
  - Order management
  - User management
  - Category management

## Technology Stack

- **Frontend**
  - HTML5
  - CSS3
  - JavaScript
  - Font Awesome Icons
  - Swiper.js for carousels

- **Backend**
  - PHP
  - MySQL Database
  - Session Management

## Project Structure

```
e_shop/
├── admin/           # Admin dashboard files
├── components/      # Reusable PHP components
├── css/            # Stylesheet files
├── js/             # JavaScript files
├── images/         # Image assets
├── upload_images/  # User uploaded images
└── Various PHP files for different pages
```

## Key Files

- `home.php` - Main landing page
- `shop.php` - Product listing page
- `cart.php` - Shopping cart functionality
- `checkout.php` - Order processing
- `login.php` & `register.php` - User authentication
- `admin/` - Admin panel files

## Setup Instructions

1. Clone the repository to your local machine
2. Set up a local web server (e.g., XAMPP, WAMP)
3. Import the database schema 
4. Configure database connection in `components/_db-connect.php`
5. Access the website through your local server

## Requirements

- PHP 7.0 or higher
- MySQL 5.6 or higher
- Web server (Apache/Nginx)
- Modern web browser

## Security Features

- Secure password hashing
- Session-based authentication
- Input validation and sanitization
- XSS protection
- SQL injection prevention

## Contributing

Feel free to submit issues and enhancement requests!

## License

This project is licensed under the MIT License - see the LICENSE file for details. 