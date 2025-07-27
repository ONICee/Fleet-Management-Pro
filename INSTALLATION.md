# State Fleet Management System - Installation Guide

## Overview

The State Fleet Management System is an enterprise-grade application designed to manage government vehicle fleets. This system provides comprehensive tracking, maintenance scheduling, and reporting capabilities for state-owned vehicles deployed across various security and related agencies.

## System Requirements

### Server Requirements
- **Web Server**: Apache 2.4+ or Nginx 1.18+
- **PHP**: 7.4+ (Recommended: PHP 8.1+)
- **Database**: MySQL 5.7+ or MariaDB 10.3+
- **Memory**: Minimum 512MB RAM (Recommended: 2GB+)
- **Storage**: Minimum 500MB free space (Recommended: 5GB+)

### PHP Extensions Required
- PDO MySQL
- JSON
- OpenSSL
- MBString
- CURL
- GD or ImageMagick (for future image handling)
- Zip (for data exports)

### Browser Compatibility
- Chrome 70+
- Firefox 65+
- Safari 12+
- Edge 80+

## Installation Steps

### 1. Download and Extract Files

1. Download the fleet management system files
2. Extract to your web server's document root directory
3. Ensure proper file permissions:
   ```bash
   chmod -R 755 /path/to/fleet-management/
   chmod -R 777 /path/to/fleet-management/logs/
   ```

### 2. Database Setup

#### Option A: Manual Database Creation

1. Access your MySQL/MariaDB server:
   ```bash
   mysql -u root -p
   ```

2. Create the database:
   ```sql
   CREATE DATABASE fleet_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

3. Create a dedicated database user:
   ```sql
   CREATE USER 'fleet_user'@'localhost' IDENTIFIED BY 'your_secure_password';
   GRANT ALL PRIVILEGES ON fleet_management.* TO 'fleet_user'@'localhost';
   FLUSH PRIVILEGES;
   ```

4. Import the database schema:
   ```bash
   mysql -u fleet_user -p fleet_management < database/schema.sql
   ```

#### Option B: Using Database Administration Tool

1. Open phpMyAdmin or your preferred database tool
2. Create a new database named `fleet_management`
3. Set charset to `utf8mb4` and collation to `utf8mb4_unicode_ci`
4. Import the `database/schema.sql` file

### 3. Configuration

#### Database Configuration

1. Open `config/database.php`
2. Update the database connection settings:
   ```php
   private $host = 'localhost';           // Your database host
   private $db_name = 'fleet_management'; // Your database name
   private $username = 'fleet_user';      // Your database username
   private $password = 'your_password';   // Your database password
   ```

#### Security Configuration

1. Generate a secure secret key for sessions
2. Update the application constants in `index.php`:
   ```php
   define('DEBUG', false);  // Set to false for production
   ```

### 4. Web Server Configuration

#### Apache Configuration

1. Ensure mod_rewrite is enabled:
   ```bash
   sudo a2enmod rewrite
   sudo systemctl restart apache2
   ```

2. The `.htaccess` file is already configured with:
   - URL rewriting rules
   - Security headers
   - Cache optimization
   - Directory access restrictions

#### Nginx Configuration

Add this to your Nginx server block:

```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/fleet-management;
    index index.php;

    # Security headers
    add_header X-Frame-Options DENY;
    add_header X-Content-Type-Options nosniff;
    add_header X-XSS-Protection "1; mode=block";

    # Prevent access to sensitive files
    location ~ /\.(htaccess|htpasswd|ini|log|sh|sql|conf) {
        deny all;
    }

    # Prevent access to config and core directories
    location ~ ^/(config|core|models|controllers)/ {
        deny all;
    }

    # PHP handling
    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # URL rewriting
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # Static file caching
    location ~* \.(css|js|png|jpg|jpeg|gif|ico|svg)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
}
```

### 5. SSL Configuration (Recommended for Production)

#### Using Let's Encrypt (Free SSL)

1. Install Certbot:
   ```bash
   sudo apt install certbot python3-certbot-apache
   ```

2. Generate SSL certificate:
   ```bash
   sudo certbot --apache -d your-domain.com
   ```

3. Update the `.htaccess` file to force HTTPS:
   ```apache
   # Uncomment these lines in .htaccess
   RewriteCond %{HTTPS} off
   RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
   ```

### 6. Default User Accounts

The system comes with pre-configured user accounts for different roles:

| Role | Username | Password | Access Level |
|------|----------|----------|-------------|
| Super Admin | superadmin | password | Full system access |
| Admin | admin | password | Vehicle & maintenance management |
| Data Entry Officer | dataentry | password | Data entry & editing |
| Guest | guest | password | Read-only access |

**⚠️ IMPORTANT**: Change all default passwords immediately after installation!

### 7. Post-Installation Setup

#### Change Default Passwords

1. Log in as superadmin
2. Navigate to Users > Manage Users
3. Edit each user account and set strong passwords
4. Consider disabling accounts that are not needed

#### Configure Agencies

1. Navigate to Agencies
2. Update the sample agencies with your actual agencies
3. Add new agencies as needed
4. Ensure contact information is accurate

#### Configure Deployment Locations

1. Navigate to Locations
2. Update sample locations with actual deployment zones
3. Add local government areas and senatorial zones
4. Set up proper geographical organization

#### System Security Checklist

- [ ] Change all default passwords
- [ ] Disable DEBUG mode in production
- [ ] Configure SSL/HTTPS
- [ ] Set up regular database backups
- [ ] Configure log rotation
- [ ] Review and update file permissions
- [ ] Set up monitoring and alerts

## Troubleshooting

### Common Issues

#### 1. Database Connection Errors
- Verify database credentials in `config/database.php`
- Ensure MySQL/MariaDB service is running
- Check database user permissions

#### 2. 404 Errors for All Pages
- Verify mod_rewrite is enabled (Apache)
- Check .htaccess file exists and is readable
- For Nginx, verify rewrite rules are configured

#### 3. Permission Denied Errors
- Check file permissions (755 for directories, 644 for files)
- Ensure web server has read access to all files
- Verify database connection permissions

#### 4. Session Issues
- Check PHP session configuration
- Verify session directory permissions
- Clear browser cookies and cache

### Log Files

Monitor these locations for errors:
- Apache: `/var/log/apache2/error.log`
- Nginx: `/var/log/nginx/error.log`
- PHP: `/var/log/php_errors.log`
- Application: `logs/application.log` (if configured)

## Performance Optimization

### Database Optimization

1. Enable MySQL query cache
2. Optimize MySQL configuration for your server size
3. Consider adding database indices for large datasets
4. Implement regular maintenance routines

### PHP Optimization

1. Enable OPcache:
   ```ini
   opcache.enable=1
   opcache.memory_consumption=128
   opcache.max_accelerated_files=4000
   ```

2. Optimize PHP settings:
   ```ini
   memory_limit = 256M
   upload_max_filesize = 10M
   post_max_size = 10M
   max_execution_time = 60
   ```

### Caching Strategy

1. Enable browser caching via .htaccess
2. Consider implementing Redis for session storage
3. Use CDN for static assets in production

## Backup and Maintenance

### Database Backups

Create automated database backups:

```bash
#!/bin/bash
# Daily database backup script
DATE=$(date +%Y%m%d_%H%M%S)
mysqldump -u fleet_user -p fleet_management > /backup/fleet_db_$DATE.sql
# Keep only last 30 days of backups
find /backup -name "fleet_db_*.sql" -mtime +30 -delete
```

### File System Backups

Backup the entire application directory regularly:

```bash
#!/bin/bash
# Application backup script
DATE=$(date +%Y%m%d_%H%M%S)
tar -czf /backup/fleet_app_$DATE.tar.gz /path/to/fleet-management/
```

### Maintenance Tasks

Implement regular maintenance:

1. **Weekly**: Clear old session files
2. **Monthly**: Optimize database tables
3. **Quarterly**: Review system logs and clean up
4. **Annually**: Update dependencies and security patches

## Security Best Practices

### Server Security

1. Keep OS and software updated
2. Use strong passwords and SSH keys
3. Configure firewall rules
4. Disable unnecessary services
5. Regular security audits

### Application Security

1. Input validation is implemented
2. SQL injection protection via PDO
3. XSS protection in views
4. CSRF token validation
5. Secure session management

### Data Protection

1. Encrypt sensitive data
2. Implement proper access controls
3. Regular security assessments
4. Compliance with data protection laws

## Support and Updates

### Getting Support

1. Check this documentation first
2. Review system logs for errors
3. Consult the troubleshooting section
4. Contact your system administrator

### System Updates

1. Always backup before updates
2. Test updates in staging environment
3. Review changelog for breaking changes
4. Plan maintenance windows for updates

## Version Information

- **Current Version**: 1.0.0
- **Release Date**: 2024
- **Compatibility**: PHP 7.4+, MySQL 5.7+
- **License**: Government Use License

---

## Quick Start Checklist

- [ ] Server requirements met
- [ ] Database created and schema imported
- [ ] Configuration files updated
- [ ] Web server configured
- [ ] SSL certificate installed (production)
- [ ] Default passwords changed
- [ ] Sample data configured
- [ ] Backup system implemented
- [ ] Security checklist completed
- [ ] System tested and verified

For additional assistance, please refer to the system documentation or contact your IT administrator.