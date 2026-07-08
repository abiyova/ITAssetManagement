# AGENTS.md — ITAssets (AssetInsight)

## Quick Start

```bash
composer setup   # install + migrate + npm + build (one-shot)
composer dev     # concurrent: artisan serve, queue:listen, pail, vite
```

Default DB is **SQLite** — no MySQL needed. `.env.example` has sensible defaults.

## Login Credentials

| Email | Password | Role |
|---|---|---|
| admin@assetinsight.com | password | super-admin |
| itstaff@assetinsight.com | password | it-staff |
| manager@assetinsight.com | password | manager |
| auditor@assetinsight.com | password | auditor |

15 total users seeded via `DummyDataSeeder`. All use `password`.

## Architecture

- **Laravel 12** — no `app/Http/Kernel.php`, config in `bootstrap/app.php`
- **Spatie Permission** v6 — 4 roles, 15 permissions. Middleware aliases registered but **NOT applied on routes** — role enforcement is UI-only (sidebar `@hasanyrole`)
- **Bootstrap 5.3.3** via CDN + **Tailwind CSS** via Vite — both loaded. Bootstrap is primary UI.
- **Alpine.js** — minor interactivity only
- **Indonesian locale** — all UI text in Bahasa Indonesia (`lang="id"`)

## Key Gotchas

1. **Roles are cosmetic**: Any authenticated user can access any route. No middleware enforcement.
2. **DummyDataSeeder has a bug**: `seedUsers()` assigns role only if user already has it (inverted logic). Seeded users end up with no roles.
3. **Sluggable models**: Category, Brand, Vendor, Department, Location auto-generate slugs in `booted()`. Don't pass `slug` manually.
4. **Asset statuses**: `draft`, `available`, `assigned`, `maintenance`, `damaged`, `lost`, `retired`, `disposed`
5. **No API routes** — web only (`routes/web.php`)
6. **Tests**: Only Breeze defaults exist — no app-specific tests

## Commands

```bash
php artisan migrate:fresh --seed          # Reset DB + seed
php artisan db:seed --class=DummyDataSeeder  # Seed dummy data only
php artisan serve                         # Start dev server
```

## Structure

- `app/Models/` — 14 Eloquent models (Asset is central)
- `app/Http/Controllers/` — 17 controllers, inline validation (no Form Requests)
- `resources/views/` — 81 Blade views, Bootstrap-based
- `database/seeders/` — RolePermissionSeeder + DummyDataSeeder
- `routes/web.php` — all routes behind `auth` + `verified` middleware
