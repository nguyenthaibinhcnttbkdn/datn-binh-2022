git checkout dev-be
git reset --hard
git pull origin dev-be
chmod -R 777 .
composer install
php artisan migrate --seed
