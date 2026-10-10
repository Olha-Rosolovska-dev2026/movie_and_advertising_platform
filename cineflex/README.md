# CineFlex — Cinematic Movie Streaming & Advertising Marketplace

A full-featured movie streaming platform + advertising marketplace + CMS built with **Laravel 13** (PHP 8.2+), Blade and Tailwind CSS.

**Developer: Olha Rosolovska**

---

## Features

### 🎬 Movie Streaming Portal
- Cinematic homepage with featured hero section
- Movie & series catalog with search, genre filter and type filter
- Movie detail pages with backdrop, rating, genres, related titles and view counter
- HTML5 video playback page (rent / buy / free model with per-title pricing)
- Embedded YouTube trailers per movie

### 📢 Advertising Marketplace
- **Ad Placements** (homepage hero, pre-roll, sidebar) with weekly pricing
- **Ad Campaigns** with advertiser, media, target URL, budget, schedule, status
- Impression & click tracking with a tracked redirect endpoint
- Live ad serving: active campaigns rotate into homepage hero and pre-roll slots

### 📝 Full CMS
- Blog posts with author, excerpt, cover image, draft/publish workflow
- Static CMS pages (About, Advertise, Terms, Privacy pre-seeded)

### 🛠 Admin Panel (`/admin`)
- Dashboard with KPI stats (movies, posts, campaigns, users, revenue, impressions, clicks)
- Full CRUD: Movies (with genres), Genres, Trailers, Ad Placements, Ad Campaigns, Blog Posts, CMS Pages, Users
- Role-based access: `admin` middleware protects the entire panel

### 👤 Auth
- Register / Login / Logout (Laravel session auth)
- Seeded admin account: **admin@cineflex.com / password**
- Seeded viewer account: **viewer@cineflex.com / password**

---

## Requirements

- PHP >= 8.2 with extensions: `mbstring`, `xml`, `sqlite3`, `curl`, `zip`
- Composer 2
- (Optional) Node.js + NPM for asset building

## All Dependencies

All dependencies are already included in `vendor/` (installed via `composer install`).
Key packages (see `composer.json`):
- `laravel/framework` ^13.0
- `laravel/tinker`
- `laravel/pint` (dev)
- `laravel/sail` (dev)
- `phpunit/phpunit` (dev)
- `fakerphp/faker` (dev)

The app uses **SQLite** by default (zero-config, `database/database.sqlite` is included).
To use MySQL, edit the `DB_*` values in `.env` and run `php artisan migrate --seed`.

---

## Installation

```bash
# 1. Install dependencies (skip if vendor/ is present)
composer install

# 2. Copy environment file (already included)
cp .env.example .env   # if .env is missing
php artisan key:generate

# 3. Create & seed the SQLite database
touch database/database.sqlite
php artisan migrate --seed

# 4. Start the dev server
php artisan serve
```

Open http://127.0.0.1:8000

- Front site: `/`
- Admin panel: `/admin` (login as admin@cineflex.com / password)
- Blog: `/blog` · Advertise page: `/pages/advertise`

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/            # Dashboard + 8 CRUD controllers
│   │   ├── Auth/             # Login / Register / Logout
│   │   ├── HomeController.php
│   │   ├── MovieController.php
│   │   ├── PostController.php
│   │   ├── PageController.php
│   │   └── AdClickController.php
│   └── Middleware/EnsureAdmin.php
├── Models/                   # User, Movie, Genre, Trailer, AdPlacement,
│                             # AdCampaign, Post, Page, Purchase
database/
├── migrations/               # 9 custom migrations
└── seeders/                  # Full demo content seeder
resources/views/
├── layouts/                  # Public + admin layouts
├── movies/  posts/  pages/  auth/
└── admin/                    # Dashboard + all CRUD views
routes/web.php               # All public, auth & admin routes
```

---

© CineFlex. Developer: Olha Rosolovska.
