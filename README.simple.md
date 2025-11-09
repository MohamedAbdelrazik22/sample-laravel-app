# Notes API — Quick start

A tiny Laravel app exposing a simple JSON API for a Note resource.

Quick start (PowerShell, project root: `C:\xampp\htdocs\sample-laravel-app`)

1. Create `.env` and generate app key

```powershell
copy .env.example .env
php artisan key:generate
```

2. Quick DB with SQLite

```powershell
New-Item -Path database\database.sqlite -ItemType File
# In .env set DB_CONNECTION=sqlite and DB_DATABASE=database/database.sqlite
php artisan migrate
```

3. Serve the app

```powershell
php -S 127.0.0.1:8000 -t public
# or
php artisan serve
```

4. API endpoints

- GET    /api/notes
- POST   /api/notes
- GET    /api/notes/{id}
- PUT    /api/notes/{id}
- DELETE /api/notes/{id}

Example (create):

```powershell
curl -X POST http://127.0.0.1:8000/api/notes -H "Content-Type: application/json" -d '{"title":"Hello","content":"World"}'
```

5. Run tests (feature tests exist for the notes API)

```powershell
php vendor\bin\phpunit --filter NoteApiTest
```

Files to check when editing

- `routes/api.php` — API routes
- `app/Http/Controllers/Api/NoteController.php` — controller (simple JSON responses)
- `app/Models/Note.php` — model
- `database/migrations/*_create_notes_table.php` — migration

If you'd like this content copied to `README.md` instead, tell me and I will replace it.
