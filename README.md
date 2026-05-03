# LabSeat Live Study Map (`labseat-phase03`)

Starter repo for **CSE 412 — Phase 03**. This app connects a simple HTML/CSS/JS frontend to PHP API scripts backed by PostgreSQL.

## Project overview

**LabSeat Live Study Map** helps students see study-space availability at a glance. Phase 03 focuses on wiring the UI to a PostgreSQL database through PHP endpoints for reading and updating reports.

## Tech stack

| Layer    | Technology   |
|---------|---------------|
| Frontend | HTML, CSS, JavaScript |
| Backend  | PHP (PDO + PostgreSQL) |
| Database | PostgreSQL, database name: `labseat` |

Project layout:

- `frontend/` — static pages and client logic served from PHP’s built-in server (see below).
- `backend/` — JSON API scripts (`get_reports.php`, CRUD helpers).
- `database/` — SQL you run in `psql` (schema from Phase 2, seeds, reference queries).

## Database setup

1. **Install PostgreSQL** (local or Docker) if you don’t already have it.
2. **Create the database** (name must match **`labseat`** unless you update `backend/config.example.php`):

   ```bash
   createdb labseat
   ```

   Or in `psql`:

   ```sql
   CREATE DATABASE labseat;
   ```

3. **Load your schema** from Phase 02 into `database/Phase2.sql`, then apply:

   ```bash
   psql -U your_username -d labseat -f database/Phase2.sql
   ```

4. **Seed data** (optional for demos):

   ```bash
   psql -U your_username -d labseat -f database/labseat_seed_data.sql
   ```

5. **Configure PHP** — copy secrets locally (never commit passwords):

   ```bash
   cp backend/config.example.php backend/config.php
   ```

   Edit `backend/config.php` with your PostgreSQL user and password.

## How to run the PHP server

From the **`labseat-phase03`** project root (not inside `frontend/`):

```bash
cd labseat-phase03
php -S localhost:8000
```

- Open **`http://localhost:8000/frontend/`** — the starter page loads `frontend/index.html`; API URLs use `/backend/…`.
- Smoke-test the API: **`http://localhost:8000/backend/get_reports.php`**  
  If you get JSON errors about `config.php`, complete the copy step above.

## GitHub branch workflow

1. **`main`** — integration branch; keeps the baseline that builds and runs after each merge.
2. Each teammate opens **pull requests** from their branch into `main` (small, reviewable changes).
3. Before PRs: `git checkout main`, `git pull origin main`, then `git checkout your-branch` and `git merge main` (or rebase if your instructor prefers).
4. Commit messages: short, imperative (“Add report form POST body”).

## Team task split

| Person | Primary ownership |
|--------|-------------------|
| **Person 1** | `frontend/index.html` and **live availability** display (zones, counts, map/list). |
| **Person 2** | Frontend **forms**, **buttons**, `frontend/style.css`, and `frontend/app.js` **user actions** (fetch/payload wiring). |
| **Person 3** | `backend/db.php`, `backend/get_reports.php`, and PostgreSQL **read/query** correctness. |
| **Person 4** | `backend/add_report.php`, `backend/update_report.php`, `backend/delete_report.php` (**create / update / delete**). |

Coordinate on shared assumptions: JSON field names, table names, and CORS/port so front and back agree.
