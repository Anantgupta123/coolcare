# Cool Care AC Service Website - Testing Checklist

## Setup Requirements
- [ ] Start XAMPP Apache and MySQL services
- [ ] Import database/coolcare.sql into MySQL (via phpMyAdmin or command line)
- [ ] Access the website at http://localhost/cool.care/

## Frontend Testing
- [ ] **Navbar**: Check logo, menu links, call button
- [ ] **Hero Section**: Video autoplay, form fields (name, phone, service, note)
- [ ] **Services Section**: Click service cards, auto-select in form
- [ ] **Pricing Section**: Table displays correct prices
- [ ] **Gallery Section**: Horizontal scrolling animation
- [ ] **Terms Section**: Content display
- [ ] **Footer**: Contact info, links
- [ ] **WhatsApp Button**: Fixed position, correct link

## Backend Testing
- [ ] **Database Connection**: Run test_db.php to verify connection
- [ ] **Form Submission**: Submit booking form, check data in database
- [ ] **Admin Login**: Login with admin@coolcare.com / admin123
- [ ] **Admin Dashboard**: View request counts and recent requests
- [ ] **Admin Requests**: View all requests, update status, delete requests

## Integration Testing
- [ ] **AJAX Submission**: Form submits without page reload
- [ ] **Session Management**: Admin login/logout works correctly
- [ ] **Responsive Design**: Test on mobile devices

## Files Created
- [x] index.html - Main website
- [x] assets/css/style.css - Custom styles
- [x] assets/js/main.js - JavaScript functionality
- [x] backend/config.php - Database configuration
- [x] backend/save-request.php - Form submission handler
- [x] admin/login.php - Admin login page
- [x] admin/dashboard.php - Admin dashboard
- [x] admin/requests.php - Request management
- [x] admin/logout.php - Logout handler
- [x] database/coolcare.sql - Database schema
- [x] test_db.php - Database test script
