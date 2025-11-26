# Free Help To Keep Your Home Platform

> A Laravel 12 + Livewire Volt application that powers the "Free Help To Keep Your Home" marketing site, contact pipeline, and admin content studio.

This repo delivers a modern publishing workflow for housing counselors: the public site is fueled by dynamic content entities (pages, hero sections, testimonials, banners, CTAs) managed through a role-based Flux UI admin experience. Contact form submissions are stored, routed through queues, and surfaced to staff while Fortify secures authentication with optional MFA.

## Highlights
- **Marketing site powered by Volt** – public routes (`/`, `/about`, `/services`, `/testimonials`, `/contact`, and dynamic `/{page:slug}`) render Single-File Volt components with Livewire data hydration and Flux UI sections.
- **Role-aware admin** – `/admin` exposes dashboards for admins and editors; Spatie Permission assigns abilities such as managing users, site-wide settings, and content modules.
- **Content modeling** – Spatie Media Library + Sluggable back Page, Testimonial, HeroSection, Banner, CallToAction, and SiteSetting models (with caching) so that marketing editors can publish and schedule assets.
- **Lead intake + notifications** – submissions persist to `contact_submissions`, trigger queued `ContactSubmissionNotification` mail, and can be triaged in the admin (status filters, pagination, detail view).
- **Authentication & security** – Laravel Fortify handles registration, login, password reset, email verification, password confirmation, and two-factor enforcement; settings views live under `/settings/*`.
- **Modern UI toolkit** – Flux UI components, Tailwind CSS v4 theming (`resources/css/app.css`), dark mode, and Vite-powered builds keep the frontend cohesive.
- **SEO friendly** – Static + dynamic URLs get indexed via `php artisan sitemap:generate`, canonical metadata fields, and OG image support on pages.
- **Tested & formatted** – Pest v4 feature tests cover routing, settings, and contact flow, while Laravel Pint enforces coding standards.

## Tech Stack
- **Backend:** PHP 8.3, Laravel 12, Laravel Fortify, Laravel Boost, Spatie packages (Permission, Media Library, Sluggable, Sitemap).
- **Frontend:** Livewire 3, Livewire Volt (class + functional SFCs), Flux UI components, Tailwind CSS v4, Vite 7, Axios.
- **Tooling:** Composer scripts for setup/dev/test, Laravel Pail for log streaming, Pest v4 for tests, Laravel Pint for formatting, database queue + session drivers by default, SQLite (default) or any Laravel-supported database.

## Directory Tour
- `app/Models` – Core entities such as `Page`, `HeroSection`, `Banner`, `CallToAction`, `Testimonial`, `ContactSubmission`, and `SiteSetting` (cached key/value store) with scopes and media collections.
- `resources/views/livewire/public` – Volt-driven public pages (home, about, services, testimonials, contact, dynamic page) composed with Flux components.
- `resources/views/livewire/admin` – Admin dashboards for pages, hero, banners, CTAs, testimonials, submissions, site settings, and users. Each section usually ships with `index/create/edit` Volt files.
- `resources/views/livewire/settings` – Authenticated user profile/password/appearance/two-factor pages built with Volt + Flux.
- `resources/views/components/layouts` – Shared layouts (`public`, `auth`, `admin`, `app`) that wrap Volt pages and register navigation/branding.
- `resources/css/app.css` – Tailwind v4 `@import` entrypoint plus Flux UI styles, theme tokens, and dark-mode variants.
- `database/seeders` – Seeds roles/permissions, sample hero/testimonials/pages/calls-to-action, site settings, banners, and default users.
- `app/Console/Commands/GenerateSitemap.php` – Generates `public/sitemap.xml` via Spatie Sitemap (run manually or via cron).
- `tests/Feature` – Pest specs that cover authentication, admin authorization gates, contact flows, dashboard rendering, and Volt-powered pages.

## Getting Started
### Prerequisites
- PHP 8.3+ with required Laravel extensions (BCMath, Ctype, Mbstring, OpenSSL, PDO, Tokenizer, XML, Fileinfo).
- Composer 2.7+
- Node.js 20+ and npm 10+
- SQLite (default), MySQL, or PostgreSQL plus a queue-compatible driver (database queue driver is preconfigured).
- Redis is optional if you want to switch cache/session/queue drivers.

### Installation
1. **Clone & install dependencies**
   ```bash
   git clone <repo-url>
   cd freehelptokeepyourhome-platform
   composer install
   npm install
   ```
2. **Environment** – copy the example file and update database/mail/storage variables.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   - The default `.env` ships with SQLite (`DB_CONNECTION=sqlite`). Create `database/database.sqlite` or switch to MySQL/PostgreSQL.
3. **Database & storage**
   ```bash
   php artisan migrate --seed
   php artisan storage:link
   ```
   Seeding creates admin/editor/test users, base content blocks, site settings, and roles/permissions.
4. **One-command bootstrap (optional)** – after cloning you may run `composer run setup` to perform install, key generation, migrations, npm install, and asset build in one shot.

### Running the application
- **Full dev environment** (serves app, queue listener, log viewer, and Vite in parallel):
  ```bash
  composer run dev
  ```
- **Manual workflow** if you prefer separate panes:
  ```bash
  php artisan serve
  php artisan queue:work
  npm run dev
  php artisan pail --timeout=0
  ```
- Visit `http://localhost:8000` for the public site and `http://localhost:8000/admin` for the admin once logged in.

### Default accounts & roles
Seeder credentials:
- Admin: `admin@example.com` / `password`
- Editor: `editor@example.com` / `password`
- Test (no special role): `test@example.com` / `password`

Roles come from Spatie Permission:
- `admin` – full access, including user and role management.
- `editor` – manage content modules, submissions, and settings but not user administration.

### Content management modules
- **Pages** – Build SEO-friendly pages with slugs, meta tags, OG images, and content blocks (Leverages Spatie Sluggable & Media Library). Public routing uses the `/{page:slug}` fallback.
- **Hero sections** – Manage hero title/subtitle/primary & secondary CTAs along with background media.
- **Banners** – Time-bound announcements with start/end scheduling and positional targeting (e.g., home page ribbons).
- **Calls to Action** – Reusable CTA blocks with icons/styles shown on the homepage.
- **Testimonials** – Author info, ratings, featured flag, and ordering for the success stories grid.
- **Site settings** – Contact info, address, disclosure text, footer copy, social links, GA ID. Values are cached via `SiteSetting::get`; manual DB edits require `php artisan cache:clear` or calling `SiteSetting::clearCache()`.
- **Contact submissions** – Each contact form save includes request metadata; statuses (`new`, `read`, `responded`) are tracked in admin screens.
- **Users** – Admin-only listing & edit views to assign roles and update accounts.

### Notifications, queues, and mail
- `ContactSubmissionObserver` queues `ContactSubmissionNotification` emails to the address set in the site settings (`email` key). Configure `MAIL_*` in `.env`.
- Queue driver defaults to `database`. Run a worker (`php artisan queue:work`) in production (Supervisor/systemd) so submissions trigger emails.
- Sessions and cache also default to the database; ensure migrations ran and prune tables periodically if needed.

### Frontend workflow
- Assets are managed through Vite. Entry points live in `resources/css/app.css` (Tailwind + Flux styles) and `resources/js/app.js`.
- Tailwind CSS v4 uses `@import "tailwindcss";` with the theme defined inside CSS. Run `npm run dev` for hot module reloading and `npm run build` for production bundles (emitted to `public/build`).
- Flux UI templates are in `resources/views/flux`. Update icons or navigation lists there to propagate across Volt components.
- If UI changes don’t appear, restart `npm run dev` or run `npm run build` to refresh the Vite manifest.

### SEO & sitemap
- Generate or refresh the sitemap anytime content changes:
  ```bash
  php artisan sitemap:generate
  ```
  The command crawls static routes plus every published page and saves to `public/sitemap.xml`. Expose it publicly at `/sitemap.xml` (already routed in `routes/web.php`).

### Testing
- Pest v4 is configured (`tests/Feature` + `tests/Feature/Settings`, etc.). Run either the whole suite or the smallest meaningful subset:
  ```bash
  php artisan test                      # entire suite
  php artisan test tests/Feature/ContactFormTest.php
  php artisan test --filter=admin-can-access-dashboard
  ```
- Livewire/Volt components can be tested via `Volt::test()` helpers; follow existing patterns in the repo.
- Database factories exist for all major models; use them for creating test data.

### Code style & quality gates
- Format PHP before committing:
  ```bash
  vendor/bin/pint --dirty
  ```
- Clear caches when tweaking config/routes:
  ```bash
  php artisan optimize:clear
  ```
- Watch the database queue and log output via `php artisan queue:listen` and `php artisan pail` while developing.

### Deployment checklist
- Set production `.env` (APP_URL, database credentials, mail, queue driver, cache driver, filesystem disk for Media Library).
- `composer install --no-dev --optimize-autoloader`
- `php artisan migrate --force`
- `npm run build`
- `php artisan storage:link`
- `php artisan optimize`
- `php artisan sitemap:generate`
- Ensure a queue worker is supervised (`php artisan queue:work --max-time=3600 --stop-when-empty` under Supervisor/systemd).
- Optionally warm caches: `php artisan config:cache && php artisan route:cache`.

### Troubleshooting tips
- **Missing media on the site** – confirm `FILESYSTEM_DISK=public`, run `php artisan storage:link`, and ensure the queue processed media conversions.
- **Contact emails not sending** – verify `SiteSetting::get('email')` is populated via the admin, `MAIL_MAILER` is configured, and a queue worker is running.
- **Settings not updating** – these values are cached; flush via `php artisan cache:clear` or call `SiteSetting::clearCache()`.
- **UI not updating** – restart `npm run dev` or delete `public/build` then run `npm run build`.
- **Authorization failures** – make sure seeded roles exist; rerun `php artisan db:seed --class=RolesAndPermissionsSeeder` if needed.

---
* @author     Engr Mejba Ahmed
* @role       AI Developer • Software Engineer • Cloud DevOps
* @website    https://www.mejba.me
