
### Relevant files
- App/Http/Controllers/
  - ShortUrlController
- App/Models/
    - UrlsInfo
    - UrlsCounter
- App/Service/
    - Bijective
    - NumsHelper

- config
  - app.php
  - database.php

- Migrations
   - database/migrations/2024_02_16_195942_create_urls_info_table.php
   - database/migrations/2024_02_18_184551_create_short_urls_counter_table.php

- resources/js 
- routes/web.php 
- tests/unit 
- vite.config.js 
---

### Install dependencies
- `composer install`
- `npm i` 

### DB SETUP
`mv .env.example .env`  (create `.env` file)   
`DB_CONNECTION=sqlite` (sqlite is chosen for easier setup. On production, mysql could be desired option)
`DB_DATABASE=/Users/x/PhpstormProjects/urls-shortener/database/urls_info.sqlite` (adjust path) (OR create a real environment variable)

config/database.php
'default' => env('DB_CONNECTION', 'sqlite'),

Hint: To view sqlite data:
- either use [DB Browser for SQLite](https://sqlitebrowser.org)
- or configure data source in PhpStorm


### SQL script
Db engine specific SQL script can be generated using `php artisan migrate --pretend` (we can rather simply run `php artisan migrate` to update schema)

### Run migrations
- `php artisan migrate`
- `php artisan migrate --env=testing` OR `php artisan migrate --database=sqlite_testing_db`


### Launch Web server
`php artisan serve` (terminal 1)
`npm run dev` (terminal 2)


Try some unsafe URLs from ShortUrlController::create method comment



