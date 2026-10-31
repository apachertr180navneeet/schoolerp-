# Shiksha Mitra School ERP — Deployment & Operations Guide

**Application:** Shiksha Mitra (Single-School ERP)  
**Framework:** Laravel 11.x  
**PHP Support:** PHP 8.2 or PHP 8.3 (Tested on 8.3.33)  
**Database:** MySQL 8.0+ / MariaDB 10.6+ (Tested on MySQL 8.4)  

---

## 1. System Requirements

- **PHP Extensions:** `pdo_mysql`, `mbstring`, `openssl`, `bcmath`, `xml`, `curl`, `gd`, `zip`
- **Web Server:** Apache / Nginx
- **Database Engine:** MySQL 8.x with `STRICT_TRANS_TABLES` support

---

## 2. Environment Configuration (`.env`)

Ensure the following variables are defined:

```env
APP_NAME="Shiksha Mitra"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost:8000

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=school_erp
DB_USERNAME=root
DB_PASSWORD=
```

---

## 3. Fresh Installation / Database Migration Steps

```bash
# 1. Install Composer dependencies
composer install --optimize-autoloader --no-dev

# 2. Generate application encryption key (if not present)
php artisan key:generate

# 3. Execute all 21 database migrations
php artisan migrate --force

# 4. Seed all 25 modules with realistic demo records
php artisan db:seed --force

# 5. Clear and cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 4. Default Login Credentials

| Role | Username / Email | Password | Access Scope |
| :--- | :--- | :--- | :--- |
| **System Administrator** | `admin@mail.com` | `123456` | Full ERP Superadmin permissions across all 55 modules |
| **Operator** | `operator@mail.com` | `123456` | Daily transactions, admissions, and student fees |
| **Teacher** | `teacher1@mail.com` | `123456` | Homework management, marks entry, class attendance |
| **Student / Parent** | `student1@mail.com` | `123456` | Student/Parent dashboard, timetable, fee invoices, circulars |

---

## 5. Verification & Health Check

Run the automated test suite to verify 100% operational readiness:

```bash
php artisan test
```
All 18 test suites will pass with 66 assertions verified.

