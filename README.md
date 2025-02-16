```markdown
# Laravel Inertia + Vue Project

## Features

- Laravel 11.x
- Vue 3 with Composition API
- Inertia.js for seamless SPA
- Vite for rapid development
- Tailwind CSS
- Authentication scaffolding
- Form handling with validation
- Basic CRUD examples
- PHPUnit

## Prerequisites

- PHP >= 8.1
- Node.js >= 16.x
- Composer
- MySQL

```
## Installation

1. Clone the repository:
```bash
git clone https://github.com/sandipGit2023/cms.git
cd cms
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install Node.js dependencies:
```bash
npm install
```

4. Create environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Configure database in `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. Run migrations:
```bash
php artisan migrate
```

8. Run seeding:
```bash
php artisan db:seed
```

## Development

Start Laravel server:
```bash
php artisan serve
```

Start Vite server:
```bash
npm run dev
```

Visit `http://localhost:8000`

## Login cred

email : test@example.com |
password : password


## Commands

- `npm run dev` - Start Vite server
- `npm run build` - Build for production
- `php artisan test` - Backend tests
- `php artisan migrate:fresh --seed` - Reset database
- `php artisan route:list` - List routes

## Project Demo
[Watch the demo video](https://www.dropbox.com/scl/fi/nb64sf7ajccmvodp05q77/screen-capture-4.webm?rlkey=3mpmkndsj4k8c3smi28otwp7o&st=oiqpqi7y&dl=0)
