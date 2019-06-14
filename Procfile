web: vendor/bin/heroku-php-apache2 -i user.ini public/
if (env('APP_ENV') === 'prod') {
    \URL::forceScheme('https');
}