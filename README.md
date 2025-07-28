# AI Category Semantic Search

## Setup Instructions

1. Clone the repo:
```bash
git clone https://github.com/alpeshkothari123/ai-category-search.git
cd ai-category-search


Database Connection
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ai_category_search
DB_USERNAME=root
DB_PASSWORD=

composer install
php artisan key:generate


php artisan migrate

Import categories:
Place categories.xlsx in storage/app
php artisan import:categories

php artisan serve
