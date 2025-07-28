# State Fleet Management System v1.0.2

## 🎯 **Overview**

The State Fleet Management System is an enterprise-grade web application designed specifically for managing government vehicle fleets across security and related agencies at the state level. Built with vanilla PHP and following MVC architecture, this system provides comprehensive vehicle tracking, maintenance management, and fleet oversight capabilities.

## 🚀 **Key Features**

### **Vehicle Management**
- **Multi-Type Vehicle Support**: Cars, trucks, motorcycles, boats, helicopters, drones, and more
- **Complete Vehicle Profiles**: Brand, model, serial numbers, engine/chassis details
- **GPS Tracker Integration**: Real-time location monitoring with IMEI tracking
- **Serviceability Status**: Track vehicle condition and availability

### **Three-Tier Maintenance System**
- **Scheduled Maintenance**: Routine 3-month maintenance cycles
- **Unscheduled Maintenance**: Emergency repairs and unexpected issues  
- **Annual Overhaul**: Comprehensive yearly vehicle refurbishment
- **Maintenance History**: Complete e-file system for each vehicle

### **Agency & Location Management**
- **Multi-Agency Support**: Manage vehicles across 8+ security agencies
- **Strategic Deployment**: Track vehicles by senatorial zones and LGAs
- **Hierarchical Organization**: Federal, state, and local agency categorization

### **Security & Compliance**
- **Role-Based Access Control**: 4 user levels (Super Admin, Admin, Data Entry, Guest)
- **Audit Logging**: Comprehensive activity tracking
- **Data Security**: Input sanitization, CSRF protection, secure sessions
- **Enterprise Authentication**: Secure login with password hashing

### **Modern Interface**
- **Responsive Design**: Mobile-friendly Bootstrap 5 interface
- **Professional Theming**: Gold and black state government color scheme
- **In-App Notifications**: Real-time alerts and system updates
- **Dashboard Analytics**: Role-specific data visualization

## 🏛️ **State Benefits**

1. **Complete Asset Visibility**: Database of all state-owned vehicles across agencies
2. **Real-Time Monitoring**: Vehicle status, location, and serviceability tracking
3. **Proactive Maintenance**: Scheduled maintenance to prevent costly repairs
4. **Cost Accountability**: Track maintenance costs and repair history
5. **Enhanced Security**: GPS monitoring of mobile government assets
6. **Strategic Planning**: Fleet composition analysis and resource allocation
7. **Executive Access**: Digital dashboard for Governor and authorized personnel
8. **Advanced Analytics**: Search and filter by brand, location, status, agency

## 🗃️ **Database Architecture**

- **Users & Authentication**: Secure user management with role-based permissions
- **Vehicle Registry**: Comprehensive vehicle information and lifecycle tracking
- **Agency Management**: Security and related government agencies
- **Location Tracking**: Deployment areas across senatorial zones
- **Maintenance System**: Schedules, history, and service provider management
- **Audit Trail**: Complete system activity logging
- **Session Management**: Secure user session tracking

## 🛠️ **Technical Stack**

- **Backend**: Vanilla PHP 8.0+ with MVC Architecture
- **Database**: MySQL/MariaDB with PDO
- **Frontend**: Bootstrap 5, Font Awesome, Custom CSS
- **Security**: bcrypt hashing, CSRF protection, input sanitization
- **Server**: Apache with mod_rewrite

## 📋 **Requirements**

- **PHP**: 8.0 or higher
- **Database**: MySQL 5.7+ or MariaDB 10.3+
- **Web Server**: Apache with mod_rewrite enabled
- **Extensions**: PDO, PDO_MySQL, Session, JSON

## 🚀 **Installation**

### **Quick Setup**
1. **Download/Clone** the repository to your web directory
2. **Create Database**: Import `database/schema.sql`
3. **Configure**: Update `config/database.php` with your credentials
4. **Access**: Visit your domain and login with default credentials

### **Default Login Credentials**
- **Super Admin**: `superadmin` / `password`
- **Admin**: `admin` / `password`  
- **Data Entry**: `dataentry` / `password`
- **Guest**: `guest` / `password`

### **Database Setup**
```sql
CREATE DATABASE fleet_mgt CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
mysql -u your_user -p fleet_mgt < database/schema.sql
```

## 🔧 **Troubleshooting**

### **Debug Tools**
For troubleshooting installation or routing issues:
- **System Check**: Visit `/debug.php` to verify server configuration
- **Routing Test**: Visit `/test_route.php` to check URL routing

### **Common Issues**
- **404 Errors**: Check mod_rewrite is enabled and .htaccess is readable
- **Database Errors**: Verify credentials in config/database.php
- **Permission Issues**: Ensure web server has read access to all files

See `INSTALLATION.md` for comprehensive setup instructions.

## 📁 **Project Structure**

```
├── config/              # Database and application configuration
├── core/                # Core MVC framework files
├── controllers/         # Application controllers
├── models/              # Database models and business logic  
├── views/               # User interface templates
├── database/            # Database schema and migrations
├── .htaccess           # Apache configuration
├── index.php           # Application entry point
├── debug.php           # System diagnostics (development)
└── test_route.php      # Routing diagnostics (development)
```

## 🔐 **Security Features**

- **Input Validation**: Comprehensive data sanitization
- **SQL Injection Prevention**: PDO prepared statements
- **XSS Protection**: Output escaping and CSP headers
- **Session Security**: Secure session management with expiration
- **CSRF Protection**: Token-based form protection
- **Access Control**: Role-based permissions and route protection

## 📊 **Reports & Analytics**

- **Fleet Overview**: Vehicle distribution by agency and location
- **Maintenance Reports**: Service history and upcoming maintenance
- **Fuel Management**: Consumption tracking and cost analysis
- **Usage Statistics**: Trip reports and vehicle utilization
- **Export Options**: CSV data export for external analysis

## 🔄 **Integration Ready**

The system is designed for easy integration with:
- **GPS Tracking Systems**: Real-time location updates
- **Fuel Management Systems**: Automated fuel record integration
- **Financial Systems**: Maintenance cost tracking
- **Notification Services**: SMS/Email alert integration
- **External APIs**: Vehicle registration and licensing systems

## 📞 **Support**

For technical support or feature requests:
- **Documentation**: See `INSTALLATION.md` for detailed setup guide
- **Issues**: Report bugs via GitHub issues
- **Development**: Follow MVC patterns for customizations

## 📄 **License**

Enterprise-grade application developed for state government use. All rights reserved.

---

**State Fleet Management System v1.0.2** - Professional vehicle fleet management for government agencies.

**🎯 Ready for Production Deployment**