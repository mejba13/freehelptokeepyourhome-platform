# Free Help To Keep Your Home Platform

A modern Laravel 12 housing counseling CMS platform connecting homeowners facing foreclosure with certified housing counseling services.

![frehome-landing-page](https://github.com/user-attachments/assets/0b114bb6-b74f-48f3-a35b-17c46cd442be)

## Overview

**Free Help To Keep Your Home** is a production-ready web platform that serves as both a marketing website for public visitors and a comprehensive content management system for administrators. The application features a beautifully designed public-facing website with dynamic content capabilities, a premium admin dashboard, and a secure contact submission system.

## Tech Stack

- **Backend:** PHP 8.2+, Laravel 12, Livewire 3, Volt
- **Frontend:** Tailwind CSS v4, Flux UI, Alpine.js, Vite
- **Database:** SQLite (MySQL/PostgreSQL supported)
- **Packages:** Spatie Permission, Media Library, Sluggable, Sitemap

## Features

### Public Website
- Dynamic hero sections and service highlights
- Testimonials carousel with client reviews
- Contact form with email notifications
- SEO-friendly dynamic pages with custom URLs

### Admin Dashboard
- Modern responsive interface with dark mode
- Content management (pages, banners, CTAs, testimonials)
- Lead management with status tracking
- User management with role-based access (Admin/Editor)
- Global site settings configuration

## Quick Start

### Requirements
- PHP 8.2+
- Composer 2.7+
- Node.js 20+ / NPM 10+
- SQLite, MySQL, or PostgreSQL

### Installation

```bash
# Clone the repository
git clone https://github.com/your-username/freehelptokeepyourhome-platform.git
cd freehelptokeepyourhome-platform

# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database setup
php artisan migrate --seed

# Link storage
php artisan storage:link

# Build assets
npm run build
```

### Development

```bash
# Start all services (server, queue, logs, vite)
composer run dev

# Run tests
composer run test

# Format code
vendor/bin/pint --dirty

# Generate sitemap
php artisan sitemap:generate
```

## Project Structure

```
├── app/
│   ├── Models/              # Page, User, Testimonial, etc.
│   ├── Notifications/       # Email notifications
│   └── Console/             # Artisan commands
├── resources/views/
│   ├── livewire/public/     # Public website pages
│   ├── livewire/admin/      # Admin dashboard views
│   └── components/layouts/  # App layouts (public, admin, auth)
├── database/
│   ├── migrations/          # Database schema
│   └── seeders/             # Sample data
└── tests/                   # Pest test suite
```

## Documentation

For comprehensive documentation including architecture details, content modules, and deployment information, see [PROJECT_DOCUMENT.md](PROJECT_DOCUMENT.md).

## Author

**Engr Mejba Ahmed**
AI Developer • Software Engineer • Cloud DevOps
[mejba.me](https://www.mejba.me) • [Ramlit Limited](https://www.ramlit.com)

## License

This project is proprietary software. All rights reserved.

