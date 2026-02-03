composer install
tạo env:ni .env
nội dung file .env:
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=webnc
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync




php artisan key:generate
npm install
npm run dev
php artisan storage:link
php artisan migrate
php artisan serve
tk admin :admin@gmail.com mk:12345678
