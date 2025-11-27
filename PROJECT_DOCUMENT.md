# Free Help To Keep Your Home Platform

## Project Documentation

---

## Project Overview

**Free Help To Keep Your Home** is a modern, production-ready web platform designed to connect homeowners facing foreclosure with certified housing counseling services. The platform serves as both a marketing website for public visitors and a comprehensive content management system for administrators.

The application features a beautifully designed public-facing website with dynamic content capabilities, a premium admin dashboard for content management, and a secure contact submission system that helps streamline lead generation and client communication.

---

## Developer Information

| | |
|---|---|
| **Developer** | Engr Mejba Ahmed |
| **Role** | AI Developer, Software Engineer, Cloud DevOps |
| **Website** | [https://www.mejba.me](https://www.mejba.me) |

---

## Technology Stack

### Back-End Technologies

| Technology | Version | Purpose |
|------------|---------|---------|
| **PHP** | 8.2+ | Server-side programming language |
| **Laravel** | 12.x | PHP web application framework |
| **Laravel Fortify** | 1.30+ | Authentication backend (login, registration, 2FA) |
| **Livewire** | 3.x | Full-stack framework for dynamic interfaces |
| **Livewire Volt** | 1.7+ | Single-file component architecture |
| **Spatie Permission** | Latest | Role-based access control (RBAC) |
| **Spatie Media Library** | Latest | Media file management and conversions |
| **Spatie Sluggable** | Latest | Automatic URL slug generation |
| **Spatie Sitemap** | Latest | SEO sitemap generation |

### Front-End Technologies

| Technology | Version | Purpose |
|------------|---------|---------|
| **Tailwind CSS** | 4.x | Utility-first CSS framework |
| **Flux UI** | 2.1+ | Premium UI component library |
| **Alpine.js** | 3.x | Lightweight JavaScript framework |
| **Vite** | 7.x | Next-generation frontend build tool |
| **Axios** | 1.7+ | HTTP client for API requests |

### Database & Storage

| Technology | Purpose |
|------------|---------|
| **SQLite** | Default database (MySQL/PostgreSQL supported) |
| **Database Queue** | Background job processing |
| **File Storage** | Media and document storage |

### Development & Testing Tools

| Tool | Purpose |
|------|---------|
| **Pest** | PHP testing framework |
| **Laravel Pint** | Code style fixer |
| **Laravel Pail** | Real-time log viewer |
| **Composer** | PHP dependency management |
| **NPM** | JavaScript dependency management |

---

## Key Features

### Public Website
- **Home Page** - Dynamic hero sections, service highlights, testimonials carousel
- **About Page** - Company information and mission statement
- **Services Page** - Detailed service offerings with CTAs
- **Testimonials Page** - Client success stories and reviews
- **Contact Page** - Lead capture form with email notifications
- **Dynamic Pages** - SEO-friendly custom pages with unique URLs

### Admin Dashboard
- **Premium UI Design** - Modern, responsive interface with dark mode support
- **Content Management** - Pages, hero sections, banners, CTAs, testimonials
- **Lead Management** - Contact form submissions with status tracking
- **User Management** - Role-based user administration
- **Site Settings** - Global configuration (contact info, social links, SEO)

### Security Features
- **Authentication** - Secure login with optional two-factor authentication
- **Role-Based Access** - Admin and Editor permission levels
- **Password Security** - Reset, confirmation, and update flows
- **Email Verification** - Optional email verification for new accounts

### SEO & Performance
- **Sitemap Generation** - Automatic XML sitemap for search engines
- **Meta Tags** - Customizable title, description, and OG images
- **Optimized Assets** - Vite-powered production builds
- **Caching** - Database-backed caching for performance

---

## Content Modules

| Module | Description |
|--------|-------------|
| **Pages** | Create unlimited pages with custom URLs, content, and SEO settings |
| **Hero Sections** | Manage homepage hero banners with titles, CTAs, and media |
| **Banners** | Promotional announcements with scheduling options |
| **Call to Actions** | Reusable CTA blocks with customizable styles |
| **Testimonials** | Client reviews with ratings and featured flags |
| **Site Settings** | Global configuration for contact info, social media, and more |

---

## User Roles & Permissions

| Role | Access Level |
|------|--------------|
| **Admin** | Full system access including user management |
| **Editor** | Content management without user administration |

---

## System Requirements

### Server Requirements
- PHP 8.2 or higher
- Composer 2.7+
- Node.js 20+ and NPM 10+
- SQLite, MySQL, or PostgreSQL database
- Web server (Apache/Nginx)

### Recommended Hosting
- Laravel Forge, Ploi, or similar Laravel-optimized hosting
- Shared hosting with SSH access and PHP 8.2+ support
- Cloud platforms (AWS, DigitalOcean, Linode)

---

## Project Structure

```
freehelptokeepyourhome-platform/
├── app/
│   ├── Models/           # Database models (Page, User, Testimonial, etc.)
│   ├── Notifications/    # Email notification classes
│   └── Console/          # Artisan commands (sitemap generation)
├── resources/
│   ├── views/
│   │   ├── livewire/
│   │   │   ├── public/   # Public website pages
│   │   │   ├── admin/    # Admin dashboard views
│   │   │   └── auth/     # Authentication pages
│   │   └── components/   # Reusable Blade components
│   ├── css/              # Tailwind CSS styles
│   └── js/               # JavaScript assets
├── database/
│   ├── migrations/       # Database schema
│   └── seeders/          # Sample data seeders
├── routes/               # Application routes
└── tests/                # Automated tests
```

---

## Deployment Information

The application is ready for production deployment with:

- Optimized autoloader configuration
- Production asset compilation
- Database migration system
- Queue worker support for background jobs
- Storage linking for media files
- Cache optimization commands

---

## Support & Maintenance

For technical support, feature requests, or maintenance inquiries, please contact the developer:

* @author     Engr Mejba Ahmed
* @role       AI Developer • Software Engineer • Cloud DevOps
* @website    https://www.mejba.me
* @company   **Ramlit Limited**: [ramlit.com](https://www.ramlit.com)


