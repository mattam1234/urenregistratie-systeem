# Deployment Guide - Urenregistratie Systeem

## Environment Requirements

This Laravel application requires:
- **PHP**: 7.2.5 to 7.4 (PHP 8+ may require dependency updates)
- **Database**: MySQL 5.7+ or MariaDB 10.2+
- **Composer**: Latest version
- **Node.js**: 12.x or higher
- **npm**: 6.x or higher

## PHP Version Compatibility

⚠️ **Important**: This project is currently configured for PHP 7.2.5 - 7.4. If you need to use PHP 8.x:

1. Update `composer.json` dependencies to PHP 8 compatible versions:
   ```bash
   composer require "laravel/framework:^8.0" --update-with-dependencies
   composer require "laravel/ui:^3.0" --update-with-dependencies
   ```

2. Update other dependencies as needed
3. Test thoroughly after upgrading

## Local Development Setup

### Prerequisites Check

```bash
# Check PHP version (should be 7.2.5 - 7.4)
php -v

# Check Composer installation
composer --version

# Check Node.js installation
node --version

# Check npm installation
npm --version
```

### Step-by-Step Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/mattam1234/urenregistratie-systeem.git
   cd urenregistratie-systeem
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```
   
   If you encounter PHP version errors, either:
   - Use PHP 7.2-7.4, OR
   - Update dependencies for your PHP version (see PHP Version Compatibility above)

3. **Install JavaScript dependencies**
   ```bash
   npm install
   ```

4. **Environment configuration**
   ```bash
   cp .env.example .env
   ```

5. **Edit `.env` file with your settings:**
   ```env
   APP_NAME="Urenregistratie Systeem"
   APP_ENV=local
   APP_DEBUG=true
   APP_URL=http://localhost:8000

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=urenregistratie
   DB_USERNAME=your_db_user
   DB_PASSWORD=your_db_password
   ```

6. **Generate application key**
   ```bash
   php artisan key:generate
   ```

7. **Create database**
   ```bash
   mysql -u root -p
   CREATE DATABASE urenregistratie CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   EXIT;
   ```

8. **Run migrations**
   ```bash
   php artisan migrate
   ```

9. **Seed database (optional)**
   If you have seeders:
   ```bash
   php artisan db:seed
   ```

10. **Compile assets**
    ```bash
    npm run dev
    ```

11. **Start development server**
    ```bash
    php artisan serve
    ```

12. **Access application**
    Open browser: `http://localhost:8000`

## Production Deployment

### Pre-Deployment Checklist

- [ ] Backup existing database
- [ ] Review and update `.env` settings
- [ ] Test application in staging environment
- [ ] Ensure all migrations are ready
- [ ] Compile production assets
- [ ] Set proper file permissions

### Production Environment Setup

1. **Configure environment**
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://your-domain.com
   
   # Use strong random key
   APP_KEY=base64:YOUR_GENERATED_KEY_HERE
   
   # Production database
   DB_CONNECTION=mysql
   DB_HOST=your_db_host
   DB_PORT=3306
   DB_DATABASE=your_db_name
   DB_USERNAME=your_db_user
   DB_PASSWORD=strong_password_here
   
   # Recommended production settings
   CACHE_DRIVER=redis
   SESSION_DRIVER=redis
   QUEUE_CONNECTION=redis
   ```

2. **Install dependencies (production)**
   ```bash
   composer install --optimize-autoloader --no-dev
   npm install --production
   ```

3. **Optimize application**
   ```bash
   # Cache configuration
   php artisan config:cache
   
   # Cache routes
   php artisan route:cache
   
   # Cache views
   php artisan view:cache
   
   # Compile assets for production
   npm run production
   ```

4. **Set file permissions**
   ```bash
   # Make storage and cache writable
   chmod -R 775 storage bootstrap/cache
   
   # Set ownership (replace www-data with your web server user)
   chown -R www-data:www-data storage bootstrap/cache
   ```

5. **Run migrations (production)**
   ```bash
   php artisan migrate --force
   ```

6. **Disable setup routes**
   Ensure `/setup` and `/add-users` routes remain commented in `routes/web.php`

### Web Server Configuration

#### Apache with mod_php

1. **VirtualHost configuration** (`/etc/apache2/sites-available/urenregistratie.conf`):
   ```apache
   <VirtualHost *:80>
       ServerName your-domain.com
       ServerAlias www.your-domain.com
       DocumentRoot /var/www/urenregistratie-systeem/public
       
       <Directory /var/www/urenregistratie-systeem/public>
           Options -Indexes +FollowSymLinks
           AllowOverride All
           Require all granted
       </Directory>
       
       ErrorLog ${APACHE_LOG_DIR}/urenregistratie-error.log
       CustomLog ${APACHE_LOG_DIR}/urenregistratie-access.log combined
   </VirtualHost>
   ```

2. **Enable site and modules**
   ```bash
   sudo a2ensite urenregistratie.conf
   sudo a2enmod rewrite
   sudo systemctl restart apache2
   ```

#### Nginx with PHP-FPM

1. **Server block** (`/etc/nginx/sites-available/urenregistratie`):
   ```nginx
   server {
       listen 80;
       listen [::]:80;
       server_name your-domain.com www.your-domain.com;
       root /var/www/urenregistratie-systeem/public;
       
       index index.php;
       
       charset utf-8;
       
       # Security headers
       add_header X-Frame-Options "SAMEORIGIN" always;
       add_header X-Content-Type-Options "nosniff" always;
       add_header X-XSS-Protection "1; mode=block" always;
       
       location / {
           try_files $uri $uri/ /index.php?$query_string;
       }
       
       location = /favicon.ico { 
           access_log off; 
           log_not_found off; 
       }
       
       location = /robots.txt  { 
           access_log off; 
           log_not_found off; 
       }
       
       error_page 404 /index.php;
       
       location ~ \.php$ {
           fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
           fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
           include fastcgi_params;
           fastcgi_hide_header X-Powered-By;
       }
       
       location ~ /\.(?!well-known).* {
           deny all;
       }
   }
   ```

2. **Enable site**
   ```bash
   sudo ln -s /etc/nginx/sites-available/urenregistratie /etc/nginx/sites-enabled/
   sudo nginx -t
   sudo systemctl restart nginx
   ```

### SSL/HTTPS Setup (Let's Encrypt)

```bash
# Install Certbot
sudo apt install certbot python3-certbot-apache  # For Apache
sudo apt install certbot python3-certbot-nginx   # For Nginx

# Obtain certificate
sudo certbot --apache -d your-domain.com -d www.your-domain.com  # Apache
sudo certbot --nginx -d your-domain.com -d www.your-domain.com   # Nginx

# Auto-renewal (already set up by Certbot)
sudo certbot renew --dry-run
```

### Database Backup Strategy

1. **Manual backup**
   ```bash
   mysqldump -u username -p database_name > backup_$(date +%Y%m%d_%H%M%S).sql
   ```

2. **Automated daily backup** (crontab):
   ```bash
   0 2 * * * /usr/bin/mysqldump -u username -ppassword database_name > /backup/urenregistratie_$(date +\%Y\%m\%d).sql
   ```

### Queue Workers (if using queues)

1. **Supervisor configuration** (`/etc/supervisor/conf.d/urenregistratie-worker.conf`):
   ```ini
   [program:urenregistratie-worker]
   process_name=%(program_name)s_%(process_num)02d
   command=php /var/www/urenregistratie-systeem/artisan queue:work --sleep=3 --tries=3 --max-time=3600
   autostart=true
   autorestart=true
   stopasgroup=true
   killasgroup=true
   user=www-data
   numprocs=2
   redirect_stderr=true
   stdout_logfile=/var/www/urenregistratie-systeem/storage/logs/worker.log
   stopwaitsecs=3600
   ```

2. **Start worker**
   ```bash
   sudo supervisorctl reread
   sudo supervisorctl update
   sudo supervisorctl start urenregistratie-worker:*
   ```

## Maintenance

### Clear Application Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Update Application

```bash
# Pull latest changes
git pull origin main

# Update dependencies
composer install --optimize-autoloader --no-dev
npm install --production

# Run migrations
php artisan migrate --force

# Clear and rebuild cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Compile assets
npm run production

# Restart queue workers if using
sudo supervisorctl restart urenregistratie-worker:*
```

### Monitor Logs

```bash
# Laravel logs
tail -f storage/logs/laravel.log

# Web server logs (Apache)
tail -f /var/log/apache2/urenregistratie-error.log

# Web server logs (Nginx)
tail -f /var/log/nginx/error.log
```

## Troubleshooting

### Common Issues

1. **500 Internal Server Error**
   - Check file permissions: `chmod -R 775 storage bootstrap/cache`
   - Check logs: `tail -f storage/logs/laravel.log`
   - Clear cache: `php artisan cache:clear`

2. **Database Connection Error**
   - Verify `.env` database credentials
   - Ensure database exists
   - Check database server is running

3. **Asset Loading Issues**
   - Run `npm run production`
   - Clear browser cache
   - Check `APP_URL` in `.env`

4. **Session Issues**
   - Check session driver in `.env`
   - Ensure storage directory is writable
   - Clear sessions: `php artisan session:flush`

## Security Checklist

- [ ] Set `APP_DEBUG=false` in production
- [ ] Use HTTPS (SSL certificate installed)
- [ ] Strong database passwords
- [ ] Regular backups configured
- [ ] File permissions properly set
- [ ] Setup routes disabled or removed
- [ ] Security headers configured (CSP, HSTS, etc.)
- [ ] Keep dependencies updated
- [ ] Monitor logs regularly
- [ ] Configure firewall (UFW/iptables)

## Support

For deployment issues, check:
1. Laravel logs: `storage/logs/laravel.log`
2. Web server logs
3. GitHub issues: https://github.com/mattam1234/urenregistratie-systeem/issues
