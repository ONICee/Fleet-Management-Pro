# State Fleet Management System

[![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)](https://github.com/your-org/fleet-management)
[![License](https://img.shields.io/badge/license-Government%20Use-green.svg)](LICENSE)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B-purple.svg)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-orange.svg)](https://mysql.com)

An enterprise-grade fleet management system designed specifically for state government vehicle operations. This system provides comprehensive tracking, maintenance scheduling, and reporting capabilities for state-owned vehicles deployed across various security and related agencies.

## 🚀 Key Features

### **Core Functionality**
- **Vehicle Management**: Complete lifecycle management of all state vehicles
- **Agency Assignment**: Track vehicles assigned to different government agencies
- **Location Tracking**: Monitor vehicle deployment across senatorial zones and LGAs
- **Maintenance Scheduling**: Three-tier maintenance system (Scheduled, Unscheduled, Overhaul)
- **Real-time Monitoring**: GPS tracker status and vehicle serviceability tracking
- **Comprehensive Reporting**: Generate detailed reports for fleet performance analysis

### **Advanced Features**
- **Role-Based Access Control**: Four distinct user roles with appropriate permissions
- **In-App Notifications**: Real-time alerts for maintenance, document expiry, and system events
- **Audit Trail**: Complete system activity logging for accountability
- **Search & Analytics**: Advanced search capabilities with instant results
- **Responsive Design**: Modern, mobile-friendly interface with gold and black theme
- **Enterprise Security**: CSRF protection, XSS prevention, and secure session management

### **State-Specific Requirements**
- **Multi-Level Organization**: Federal, State, and Local agency support
- **Geographic Zones**: Senatorial zone and LGA-based organization
- **Document Management**: Insurance and registration expiry tracking
- **Maintenance Categories**: Scheduled (3-month), Unscheduled (as-needed), Overhaul (annual)
- **Vehicle Types**: Support for land, air, sea, and unconventional vehicles (drones)

## 🏗️ System Architecture

### **MVC Pattern**
```
📁 fleet-management/
├── 📁 config/           # Database and application configuration
├── 📁 core/             # Core application classes (Router, Session, Base classes)
├── 📁 controllers/      # Request handlers and business logic
├── 📁 models/           # Data access layer and business models
├── 📁 views/            # User interface templates
├── 📁 database/         # Database schema and migrations
├── 📁 logs/             # Application logs
├── 📄 index.php         # Application entry point
├── 📄 .htaccess         # URL rewriting and security headers
└── 📄 README.md         # This file
```

### **Technology Stack**
- **Backend**: Vanilla PHP 7.4+ with PDO MySQL
- **Frontend**: Bootstrap 5 with modern CSS3 and JavaScript
- **Database**: MySQL 5.7+ / MariaDB 10.3+
- **Architecture**: Model-View-Controller (MVC)
- **Security**: CSRF protection, XSS prevention, SQL injection protection

## 👥 User Roles & Permissions

| Role | Permissions | Dashboard Features |
|------|-------------|-------------------|
| **Super Admin** | Full system access, user management, system logs | System-wide statistics, user activity, critical alerts |
| **Admin** | Vehicle & maintenance management, reports | Fleet performance metrics, maintenance scheduling |
| **Data Entry Officer** | Create/edit vehicles, maintenance, fuel records | Recent entries, incomplete records, personal activity |
| **Guest** | Read-only access to vehicle information | Basic fleet overview and statistics |

## 🔧 Installation

### **Quick Start**
1. **Requirements Check**: Ensure PHP 7.4+, MySQL 5.7+, and required extensions
2. **Download**: Extract files to your web server directory
3. **Database**: Import `database/schema.sql` to create tables
4. **Configuration**: Update `config/database.php` with your credentials
5. **Test**: Run `test_installation.php` to verify setup
6. **Launch**: Access the system via your web browser

### **Default Credentials**
| Role | Username | Password |
|------|----------|----------|
| Super Admin | `superadmin` | `password` |
| Admin | `admin` | `password` |
| Data Entry | `dataentry` | `password` |
| Guest | `guest` | `password` |

⚠️ **Security**: Change all default passwords immediately after installation!

### **Detailed Installation**
For complete installation instructions, see [INSTALLATION.md](INSTALLATION.md)

## 📱 User Interface

### **Design Philosophy**
- **Professional Government Theme**: Gold and black color scheme representing authority and excellence
- **Responsive Design**: Optimized for desktop, tablet, and mobile devices
- **Intuitive Navigation**: Role-based menus and clear information hierarchy
- **Accessibility**: WCAG-compliant design with proper contrast and keyboard navigation

### **Key Screens**
- **Dashboard**: Role-specific overview with relevant statistics and alerts
- **Vehicle Management**: Comprehensive vehicle database with search and filters
- **Maintenance Tracking**: Schedule and track all maintenance activities
- **Reports & Analytics**: Generate detailed reports with export capabilities
- **User Management**: Administrative tools for user and permission management

## 🔒 Security Features

### **Data Protection**
- ✅ SQL Injection Prevention (PDO prepared statements)
- ✅ Cross-Site Scripting (XSS) Protection
- ✅ Cross-Site Request Forgery (CSRF) Protection
- ✅ Secure Session Management
- ✅ Input Validation and Sanitization
- ✅ Password Hashing (bcrypt)

### **Access Control**
- ✅ Role-Based Permissions
- ✅ Session Security with Regeneration
- ✅ Activity Logging and Audit Trail
- ✅ Failed Login Attempt Monitoring
- ✅ Secure Headers Configuration

### **Infrastructure Security**
- ✅ Directory Access Protection
- ✅ Sensitive File Protection
- ✅ HTTPS Support (recommended for production)
- ✅ Database Connection Security

## 📊 Fleet Management Capabilities

### **Vehicle Information Management**
- **Basic Details**: Brand, model, serial number, year allotted
- **Technical Specs**: Engine number, chassis number, VIN
- **Tracking**: GPS tracker number, IMEI, status monitoring
- **Assignment**: Agency allocation and deployment location
- **Documentation**: Insurance, registration, and expiry tracking

### **Maintenance System**
- **Scheduled Maintenance**: Regular 3-month service cycles
- **Unscheduled Maintenance**: Emergency and as-needed repairs
- **Annual Overhauls**: Comprehensive yearly refurbishment
- **Cost Tracking**: Estimated vs. actual maintenance costs
- **Service History**: Complete maintenance record for each vehicle

### **Reporting & Analytics**
- **Fleet Overview**: Total vehicles by type, brand, and status
- **Serviceability Reports**: Operational vs. non-operational vehicles
- **Maintenance Reports**: Due dates, overdue items, cost analysis
- **Geographic Distribution**: Vehicles by senatorial zone and LGA
- **Agency Reports**: Vehicle allocation by agency and type

## 🔄 Workflow Management

### **Vehicle Lifecycle**
1. **Registration**: Add new vehicle with complete details
2. **Assignment**: Allocate to appropriate agency and location
3. **Tracking**: Monitor GPS status and serviceability
4. **Maintenance**: Schedule and track all service activities
5. **Reporting**: Generate reports for decision-making

### **Maintenance Workflow**
1. **Schedule**: Create maintenance appointments based on dates/mileage
2. **Track**: Monitor work progress and parts usage
3. **Complete**: Record actual costs and update vehicle status
4. **Analyze**: Review maintenance patterns and costs

## 🎯 Benefits for State Government

### **Operational Benefits**
- **Real-Time Visibility**: Know location and status of all state vehicles
- **Cost Optimization**: Prevent expensive repairs through scheduled maintenance
- **Asset Protection**: Track and secure valuable government assets
- **Compliance**: Maintain documentation for regulatory requirements

### **Strategic Benefits**
- **Data-Driven Decisions**: Analytics for fleet optimization and planning
- **Accountability**: Complete audit trail for all fleet activities
- **Efficiency**: Streamlined processes for vehicle management
- **Transparency**: Clear reporting for stakeholders and oversight

### **Financial Benefits**
- **Reduced Maintenance Costs**: Preventive vs. reactive maintenance
- **Asset Utilization**: Optimize vehicle deployment and usage
- **Budget Planning**: Accurate forecasting based on historical data
- **Cost Control**: Track and manage all fleet-related expenses

## 📈 Performance & Scalability

### **Optimization Features**
- **Database Indexing**: Optimized queries for large datasets
- **Caching Strategy**: Browser and application-level caching
- **Efficient Architecture**: MVC pattern for maintainable code
- **Resource Management**: Minimal server resource usage

### **Scalability**
- **Multi-Agency Support**: Handle multiple agencies and locations
- **Large Fleet Management**: Designed for hundreds of vehicles
- **User Capacity**: Support for multiple concurrent users
- **Growth Ready**: Architecture supports future enhancements

## 🛠️ Technical Specifications

### **Server Requirements**
- **Web Server**: Apache 2.4+ or Nginx 1.18+
- **PHP**: 7.4+ (Recommended: 8.1+)
- **Database**: MySQL 5.7+ or MariaDB 10.3+
- **Memory**: 512MB+ RAM (Recommended: 2GB+)
- **Storage**: 500MB+ (Recommended: 5GB+)

### **Browser Support**
- Chrome 70+, Firefox 65+, Safari 12+, Edge 80+
- Mobile responsive design for tablets and smartphones
- Progressive web app capabilities

## 📚 Documentation

- **[Installation Guide](INSTALLATION.md)**: Complete setup instructions
- **[User Manual](docs/USER_MANUAL.md)**: End-user documentation
- **[Admin Guide](docs/ADMIN_GUIDE.md)**: Administrative procedures
- **[API Documentation](docs/API.md)**: Integration capabilities
- **[Security Guide](docs/SECURITY.md)**: Security best practices

## 🔮 Future Enhancements

### **Planned Features**
- [ ] Mobile Application (iOS/Android)
- [ ] Email Notifications Integration
- [ ] Advanced GPS Tracking Integration
- [ ] Fuel Management System
- [ ] Driver Management Module
- [ ] Document Management System
- [ ] API for Third-Party Integrations

### **Advanced Analytics**
- [ ] Predictive Maintenance Alerts
- [ ] Cost Optimization Recommendations
- [ ] Performance Benchmarking
- [ ] Custom Report Builder
- [ ] Data Export/Import Tools

## 📞 Support & Maintenance

### **System Monitoring**
- Application performance monitoring
- Database health checks
- Security vulnerability scanning
- Regular backup verification

### **Maintenance Schedule**
- **Daily**: Automated backups
- **Weekly**: Log review and cleanup
- **Monthly**: Performance optimization
- **Quarterly**: Security updates
- **Annually**: System review and upgrades

## 📄 License & Compliance

This system is licensed for government use and complies with:
- Government IT security standards
- Data protection regulations
- Accessibility requirements (WCAG 2.1)
- Open source component licenses

## 🤝 Contributing

This project is maintained for government use. For feature requests or bug reports, please contact your system administrator or IT department.

---

**State Fleet Management System** - Empowering efficient government vehicle operations through technology.

*Built with precision for the modern state government.*