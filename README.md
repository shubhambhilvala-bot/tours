# Saarthi Voyages - Tours & Travels Booking Website

A modern and responsive PHP-based tours and travels booking website with user authentication, tour management, and booking system.

## Features

- **User Authentication**: Registration, login, and user profile management
- **Tour Management**: Browse, search, and filter tours by category, destination, and price
- **Booking System**: Complete booking process with payment integration
- **Responsive Design**: Modern UI that works on all devices
- **Admin Panel**: Manage tours, bookings, and users (admin functionality)
- **Search & Filter**: Advanced search and filtering options
- **Reviews & Ratings**: Customer reviews and rating system
- **Secure Payment**: Payment processing with form validation

## Technology Stack

- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+
- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap 5
- **Icons**: Font Awesome 6
- **Server**: Apache/Nginx (XAMPP/WAMP/MAMP)

## Installation

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- XAMPP, WAMP, or MAMP (for local development)

### Setup Instructions

1. **Clone or Download the Project**
   ```bash
   # If using git
   git clone <repository-url>
   # Or download and extract the ZIP file
   ```

2. **Set Up the Database**
   - Open your MySQL client (phpMyAdmin, MySQL Workbench, etc.)
   - Create a new database named `tours_booking`
   - Import the `database.sql` file to create tables and sample data

3. **Configure Database Connection**
   - Open `config/database.php`
   - Update the database credentials:
   ```php
   $host = 'localhost';
   $dbname = 'tours_booking';
   $username = 'your_username';
   $password = 'your_password';
   ```

4. **Set Up Web Server**
   - Place the project files in your web server's document root
   - For XAMPP: `C:\xampp\htdocs\tours\`
   - For WAMP: `C:\wamp\www\tours\`
   - For MAMP: `/Applications/MAMP/htdocs/tours/`

5. **Access the Website**
   - Start your web server (Apache) and MySQL
   - Open your browser and navigate to: `http://localhost/tours/`

## Default Login Credentials

### Admin Account
- Email: `admin@saarthivoyages.com`
- Password: `password`

### Sample User Accounts
- Email: `john@example.com`
- Password: `password`

- Email: `jane@example.com`
- Password: `password`

## Project Structure

```
tours/
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── script.js
├── config/
│   └── database.php
├── includes/
│   ├── functions.php
│   ├── header.php
│   └── footer.php
├── admin/           # Admin panel (to be implemented)
├── index.php        # Homepage
├── tours.php        # Tours listing
├── tour-details.php # Individual tour page
├── book-tour.php    # Booking page
├── register.php     # User registration
├── login.php        # User login
├── logout.php       # User logout
├── database.sql     # Database setup
└── README.md        # This file
```

## Features Overview

### For Visitors
- Browse featured tours on homepage
- Search and filter tours by destination, category, duration, and price
- View detailed tour information with images and descriptions
- Read customer reviews and ratings
- Register for an account

### For Registered Users
- Complete booking process with payment
- View booking history
- Manage profile information
- Write reviews for tours
- Receive booking confirmations

### For Administrators
- Manage tours (add, edit, delete)
- View and manage bookings
- Manage user accounts
- View analytics and reports

## Customization

### Adding New Tours
1. Access the admin panel (to be implemented)
2. Or directly insert into the database:
   ```sql
   INSERT INTO tours (title, description, destination, category, duration, price, image, featured) 
   VALUES ('Tour Title', 'Description', 'Destination', 'category', duration, price, 'image_url', featured);
   ```

### Modifying Styles
- Edit `assets/css/style.css` to customize the appearance
- The website uses Bootstrap 5, so you can also override Bootstrap classes

### Adding New Features
- Functions are organized in `includes/functions.php`
- Database queries can be modified in the respective PHP files
- JavaScript functionality is in `assets/js/script.js`

## Security Features

- Password hashing using PHP's `password_hash()`
- SQL injection prevention with prepared statements
- Input sanitization and validation
- Session management
- CSRF protection (basic implementation)

## Payment Integration

The booking system includes a payment form structure. To integrate with real payment gateways:

1. **Stripe Integration**
   - Sign up for a Stripe account
   - Add Stripe PHP SDK
   - Implement payment processing in `book-tour.php`

2. **PayPal Integration**
   - Sign up for PayPal Developer account
   - Add PayPal PHP SDK
   - Implement PayPal payment buttons

## Deployment

### Local Development
- Use XAMPP, WAMP, or MAMP for local development
- Ensure PHP and MySQL are running
- Access via `http://localhost/tours/`

### Production Deployment
1. Upload files to your web server
2. Create a production database
3. Update database credentials in `config/database.php`
4. Set proper file permissions
5. Configure SSL certificate for secure payments
6. Set up email functionality for booking confirmations

## Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Check database credentials in `config/database.php`
   - Ensure MySQL service is running
   - Verify database name exists

2. **Page Not Found (404)**
   - Check file paths and permissions
   - Ensure Apache/Nginx is configured correctly
   - Verify .htaccess file (if using)

3. **Images Not Loading**
   - Check image URLs in the database
   - Ensure proper file permissions
   - Verify image paths are correct

4. **Booking Not Working**
   - Check if user is logged in
   - Verify database tables are created
   - Check for JavaScript errors in browser console

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This project is open source and available under the [MIT License](LICENSE).

## Support

For support and questions:
- Create an issue in the repository
- Contact: support@saarthivoyages.com

## Future Enhancements

- [ ] Admin panel with full CRUD operations
- [ ] Email notifications for bookings
- [ ] Real payment gateway integration
- [ ] Multi-language support
- [ ] Mobile app development
- [ ] Advanced analytics dashboard
- [ ] Social media integration
- [ ] Blog/News section
- [ ] Newsletter subscription
- [ ] Advanced search with maps integration

---

**Note**: This is a demonstration project. For production use, implement proper security measures, error handling, and payment gateway integration.
