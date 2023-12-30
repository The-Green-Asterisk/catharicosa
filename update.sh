date > public/update.txt
cd /usr/local/var/www/catharicosa/notes
git pull origin main >> public/update.txt
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader >> public/update.txt
php artisan migrate --force >> public/update.txt
npm run prod >> public/update.txt
php artisan cache:clear >> public/update.txt
php artisan route:cache >> public/update.txt
date >> public/update.txt