E-Commerce Laravel API

A clean and fully working E-Commerce REST API built with Laravel.
The project supports:

Authentication (Laravel Sanctum)

Redis Caching for product listing

Requirements

PHP 8.2+

Composer

MySQL

Redis

Laravel CLI

Postman (for testing APIs)

Installation & Setup
1. Clone the repository
git clone <https://github.com/Abdelrahman435/E-Commerce>
cd <E-Commerce>

2. Install dependencies
composer install

3. Copy & configure .env
cp .env.example .env


Edit .env:

DB_DATABASE=your_db
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379

FILESYSTEM_DRIVER=public

4. Generate key
`php artisan key:generate`

5. Run migrations
php artisan migrate

6. (Optional) Seed database
php artisan db:seed

7. Storage link for product images
php artisan storage:link

9. Start server
php artisan serve


Default: http://localhost:8000


## ERD (Entity Relationship Diagram)

```mermaid
erDiagram

    USERS {
        int id PK
        string name
        string email
        string password
        timestamp created_at
        timestamp updated_at
    }

    PRODUCTS {
        int id PK
        int user_id FK
        string title
        text description
        decimal price
        int stock
        timestamp created_at
        timestamp updated_at
    }

    IMAGES {
        int id PK
        int product_id FK
        string path
        timestamp created_at
        timestamp updated_at
    }

    COMMENTS {
        int id PK
        int user_id FK
        int product_id FK
        text body
        timestamp created_at
        timestamp updated_at
    }

    USERS ||--o{ PRODUCTS : "owns"
    PRODUCTS ||--o{ IMAGES : "has"
    USERS ||--o{ COMMENTS : "writes"
    PRODUCTS ||--o{ COMMENTS : "receives"

