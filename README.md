# Todo App with Email Reminders - Laravel 11

[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

A robust task management system built with Laravel 11 featuring automated email reminders, CSV exports, and comprehensive logging capabilities.

## ✨ Features

-   **Complete Todo Management**: Full CRUD operations for tasks
-   **Smart Email Reminders**: Automated notifications 10 minutes before due time
-   **CSV Export Integration**: Attach API data as CSV files to emails
-   **Comprehensive Logging**: Track all email activities and system events
-   **Queue System**: Background processing for optimal performance
-   **Responsive Design**: Mobile-friendly interface
-   **Real-time Notifications**: Instant updates on task changes

## 🏗️ System Requirements

| Requirement | Version       |
| ----------- | ------------- |
| PHP         | 8.2 or higher |
| Composer    | 2.0+          |
| MySQL       | 5.7+          |
| MariaDB     | 10.3+         |
| Node.js     | 16+           |
| NPM         | 6+            |

## 🚀 Installation Guide

### Step 1: Clone Repository

```bash
git clone https://github.com/zabiremu/todo-list-project.git
cd todo-list-project
```

### Step 2: Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install

# Build frontend assets
npm run build
```

### Step 3: Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 4: Database Setup

Update your `.env` file with database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo_app
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password
```

### Step 5: Run Database Migrations

```bash
php artisan migrate
```

### Step 6: Email Configuration

Configure your email settings in `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your@gmail.com
MAIL_FROM_NAME="Todo App"
```

### Step 7: Queue Configuration

```env
QUEUE_CONNECTION=database
```

Create queue jobs table:

```bash
php artisan queue:table
php artisan migrate
```

## 🏃‍♂️ Running the Application

### Start Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

### Start Queue Worker

Open a new terminal window and run:

```bash
php artisan queue:work
```

**Important**: Keep this running in the background for email processing.

### Start Task Scheduler

For automated email reminders, set up the Laravel scheduler:

#### Option 1: Development (Manual)

```bash
php artisan schedule:work
```

#### Option 2: Production (Cron Job)

Add this to your crontab:

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

## 📧 Email Setup Guide

### Gmail Configuration

1. **Enable 2-Factor Authentication** on your Gmail account
2. **Generate App Password**:
    - Go to Google Account Settings
    - Security → 2-Step Verification → App passwords
    - Generate password for "Mail"
3. **Use App Password** in `MAIL_PASSWORD` field

### Other Email Providers

| Provider        | SMTP Host             | Port | Encryption |
| --------------- | --------------------- | ---- | ---------- |
| Outlook/Hotmail | smtp-mail.outlook.com | 587  | TLS        |
| Yahoo           | smtp.mail.yahoo.com   | 587  | TLS        |
| Mailgun         | smtp.mailgun.org      | 587  | TLS        |

## 🔧 Configuration Options

### Queue Configuration

For better performance in production, consider using Redis:

```env
QUEUE_CONNECTION=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### Logging Configuration

```env
LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug
```

## 📁 Project Structure

```
todo-list-project/
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   ├── Mail/
│   ├── Jobs/
│   └── Console/Commands/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   └── js/
├── routes/
└── public/
```

## 🐛 Troubleshooting

### Common Issues

#### Queue Jobs Not Processing

```bash
# Check queue status
php artisan queue:failed

# Restart queue worker
php artisan queue:restart
php artisan queue:work
```

#### Email Not Sending

```bash
# Test email configuration
php artisan tinker
Mail::raw('Test message', function ($message) {
    $message->to('test@example.com')->subject('Test Email');
});
```

#### Database Connection Issues

```bash
# Test database connection
php artisan tinker
DB::connection()->getPdo();
```

### Log Files

Check these files for debugging:

-   `storage/logs/laravel.log` - General application logs
-   `storage/logs/queue.log` - Queue processing logs

## 🔒 Security Considerations

-   Keep your `.env` file secure and never commit it to version control
-   Use App Passwords for Gmail (never use your actual password)
-   Regularly update dependencies: `composer update`
-   Enable CSRF protection (enabled by default)

## 📚 API Documentation

The application includes API endpoints for:

-   `/api/todos` - Todo CRUD operations
-   `/api/email-logs` - Email activity logs
-   `/api/export/csv` - CSV export functionality

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/new-feature`
3. Commit changes: `git commit -m 'Add new feature'`
4. Push to branch: `git push origin feature/new-feature`
5. Submit a pull request

## 📄 License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## 📞 Support

For support and questions:

-   **Email**: zabirraihan570@gmail.com

## 🏆 Acknowledgments

-   Laravel Framework team
-   Contributors and testers
-   Open source community

---

**Made with ❤️ by [Zabir Emu](https://github.com/zabiremu)**
