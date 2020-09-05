git checkout master
git reset --hard
git pull origin master
chmod -R 777 .
composer install
php artisan migrate --seed
