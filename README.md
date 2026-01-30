# Urenregistratie Systeem (Time Registration System)

A Laravel-based time registration and project management system that allows users to track their working hours, manage projects, tasks, and leave requests (verlof).

## Features

- **User Authentication**: Secure login and registration system
- **Time Tracking**: Track time spent on tasks with a built-in timer
- **Project Management**: Create, edit, and manage projects with status tracking (pending/completed)
- **Task Management**: 
  - Regular tasks with categories
  - Project-specific tasks
  - Track estimated hours vs actual hours
  - Mark tasks as pending or completed
- **Leave Management (Verlof)**: Submit and manage leave requests
- **Categories**: Organize tasks by categories
- **User Roles**: Support for different user functions (functie)

## Requirements

- PHP >= 7.2.5
- Composer
- MySQL/MariaDB
- Node.js & npm
- Apache/Nginx web server

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/mattam1234/urenregistratie-systeem.git
   cd urenregistratie-systeem
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies**
   ```bash
   npm install
   ```

4. **Create environment file**
   ```bash
   cp .env.example .env
   ```

5. **Configure environment**
   Edit `.env` file and set your database credentials:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password
   ```

6. **Generate application key**
   ```bash
   php artisan key:generate
   ```

7. **Run database migrations**
   ```bash
   php artisan migrate
   ```

8. **Compile assets**
   ```bash
   npm run dev
   ```
   For production:
   ```bash
   npm run production
   ```

9. **Start development server**
   ```bash
   php artisan serve
   ```

10. **Access the application**
    Open your browser and navigate to `http://localhost:8000`

## Database Structure

The application uses the following main tables:
- `users` - User accounts
- `functies` - User roles/functions
- `categories` - Task categories
- `tasks` - Regular tasks
- `projects` - Projects
- `project_tasks` - Tasks associated with projects
- `verlofs` - Leave requests

## Usage

### Managing Tasks
1. Navigate to Tasks section
2. Create new tasks with:
   - Title and description
   - Category
   - Start and end dates
   - Estimated hours
   - Assigned user
3. Track actual hours spent
4. Mark tasks as pending or completed

### Managing Projects
1. Access Projects section
2. Create projects with title and description
3. Track project status (pending/completed)
4. Assign project-specific tasks

### Time Tracking
- Use the built-in timer on the dashboard
- Start, pause, and reset timer
- Record time spent on tasks

### Leave Requests
1. Navigate to Verlof section
2. Submit leave requests with:
   - Reason (reden)
   - Start date (BeginDatum)
   - End date (EindDatum)
3. View and manage your leave requests

## Security

- All routes are protected with authentication middleware
- Users can only edit/delete their own resources
- Setup routes are disabled in production (remove comments to enable for development only)
- Input validation on all forms
- CSRF protection enabled

## Testing

Run the test suite:
```bash
php artisan test
```

Or using PHPUnit directly:
```bash
vendor/bin/phpunit
```

## Deployment

### Pre-deployment Checklist

1. **Environment Configuration**
   - Set `APP_ENV=production` in `.env`
   - Set `APP_DEBUG=false` in `.env`
   - Configure production database credentials
   - Set secure `APP_KEY`

2. **Optimize Application**
   ```bash
   composer install --optimize-autoloader --no-dev
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   npm run production
   ```

3. **Set Permissions**
   ```bash
   chmod -R 755 storage bootstrap/cache
   chown -R www-data:www-data storage bootstrap/cache
   ```

4. **Database**
   ```bash
   php artisan migrate --force
   ```

5. **Security**
   - Ensure setup routes (`/setup`, `/add-users`) remain commented out
   - Enable HTTPS
   - Set secure session configuration
   - Configure CORS if needed

### Web Server Configuration

#### Apache
Create `.htaccess` in public directory (already included with Laravel):
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

#### Nginx
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/urenregistratie-systeem/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## Maintenance

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Update Dependencies
```bash
composer update
npm update
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For issues and questions, please use the GitHub issue tracker.
