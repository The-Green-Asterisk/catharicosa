cd /usr/local/var/www/catharicosa/notes
git pull origin main
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader
php artisan migrate --force
npm run prod
