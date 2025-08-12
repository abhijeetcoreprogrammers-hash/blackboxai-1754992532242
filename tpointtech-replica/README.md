# TPoint Tech Replica - Learning Management System

A complete replica of the TPoint Tech website built with Core PHP using MVC architecture, featuring a commercial-grade MySQL database designed to handle large-scale learning management system data.

## 🚀 Features

- **Complete MVC Architecture**: Clean separation of concerns with Controllers, Models, and Views
- **Commercial Database Design**: Optimized MySQL schema for handling large amounts of educational content
- **Responsive Design**: Modern UI with Orange, White, Green, and Black color scheme
- **Tutorial Management**: Categories, topics, tutorials with rich content support
- **User Management**: Authentication, progress tracking, bookmarks
- **Analytics**: Page views, user engagement tracking
- **Interview Questions**: Categorized technical interview questions
- **Online Compilers**: Support for multiple programming languages
- **Search Functionality**: Full-text search across tutorials and content
- **Comments System**: User discussions and feedback
- **Quiz System**: Interactive quizzes with multiple question types

## 📋 System Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- PDO MySQL extension
- mod_rewrite enabled (for Apache)

## 🛠️ Installation

### Method 1: Using the Web Installer (Recommended)

1. **Download and Extract**
   ```bash
   # Extract the project files to your web server directory
   unzip tpointtech-replica.zip
   cd tpointtech-replica
   ```

2. **Set Permissions**
   ```bash
   chmod -R 755 .
   chmod -R 777 app/config/
   ```

3. **Configure Web Server**
   - Point your web server document root to the `public/` directory
   - Ensure mod_rewrite is enabled for Apache

4. **Run Web Installer**
   - Navigate to `http://your-domain.com/installation.php`
   - Fill in your database credentials
   - Click "Install TPoint Tech Replica"
   - Delete the `installation.php` file after successful installation

### Method 2: Manual Installation

1. **Create Database**
   ```sql
   CREATE DATABASE tpointtech_lms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

2. **Import Database Schema**
   ```bash
   mysql -u username -p tpointtech_lms < database/schema.sql
   ```

3. **Import Sample Data**
   ```bash
   mysql -u username -p tpointtech_lms < database/sample_data.sql
   ```

4. **Configure Application**
   - Edit `app/config/config.php`
   - Update database credentials and base URL

## 🗂️ Project Structure

```
tpointtech-replica/
├── app/
│   ├── config/
│   │   └── config.php          # Application configuration
│   ├── controllers/
│   │   └── HomeController.php  # Homepage controller
│   ├── core/
│   │   ├── Controller.php      # Base controller class
│   │   └── Model.php          # Base model class
│   ├── models/
│   │   ├── CategoryModel.php   # Category data model
│   │   └── TutorialModel.php   # Tutorial data model
│   └── views/
│       ├── layout/
│       │   ├── header.php      # Common header
│       │   └── footer.php      # Common footer
│       └── home/
│           └── index.php       # Homepage view
├── assets/
│   ├── css/
│   │   └── style.css          # Main stylesheet
│   ├── js/
│   │   └── main.js            # JavaScript functionality
│   └── images/                # Static images
├── database/
│   ├── schema.sql             # Database structure
│   └── sample_data.sql        # Sample data
├── public/
│   ├── index.php              # Front controller
│   ├── .htaccess              # URL rewriting rules
│   └── installation.php       # Web installer
└── README.md                  # This file
```

## 🎨 Color Scheme

The application uses a consistent color scheme throughout:

- **Orange (#FF6600)**: Primary accent color for headers and highlights
- **White (#FFFFFF)**: Background and content areas
- **Green (#28A745)**: Success states and secondary accents
- **Black (#000000)**: Text and borders

## 🔧 Configuration

### Database Configuration
Edit `app/config/config.php` to update database settings:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_NAME', 'tpointtech_lms');
```

### Application Settings
```php
define('BASE_URL', 'http://your-domain.com/');
define('SITE_NAME', 'TPoint Tech Replica');
```

## 📊 Database Schema

The database includes the following main tables:

- **users**: User accounts and authentication
- **categories**: Tutorial categories (Python, Java, etc.)
- **topics**: Subcategories within each category
- **tutorials**: Individual tutorial content
- **tags**: Tutorial tagging system
- **interview_questions**: Technical interview questions
- **quiz_questions**: Interactive quiz content
- **user_progress**: Learning progress tracking
- **comments**: User discussions
- **page_views**: Analytics and tracking

## 🚦 Usage

### Adding New Categories
1. Insert into `categories` table
2. Add corresponding topics in `topics` table
3. Create tutorials linked to topics

### Creating Tutorials
1. Use the `tutorials` table to add content
2. Link to appropriate topic via `topic_id`
3. Set featured status with `is_featured` flag

### User Management
- Users are stored in the `users` table
- Roles: admin, instructor, student
- Progress tracking via `user_progress` table

## 🔒 Security Features

- PDO prepared statements for SQL injection prevention
- CSRF token protection
- Input sanitization and validation
- Session security settings
- Password hashing with PHP's password_hash()

## 📱 Responsive Design

The application is fully responsive and works on:
- Desktop computers
- Tablets
- Mobile phones

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## 📄 License

This project is open source and available under the MIT License.

## 🆘 Support

For support and questions:
- Check the installation guide above
- Review the code comments for implementation details
- Ensure all system requirements are met

## 🔄 Updates

To update the application:
1. Backup your database
2. Replace application files (keep config.php)
3. Run any new database migrations
4. Clear any cached data

---

**Built with ❤️ using Core PHP, MySQL, and modern web standards.**
