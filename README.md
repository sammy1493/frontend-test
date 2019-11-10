Used Symphony4, doctrine, mysql, Xampp
# frontend-test
PHP app used to evaluate potential front-end candidates.
#installed depencies
composer install
# Edit the env file and created a virtual host and also add DB params

#to create the db and add data
php bin/console doctrine:migrations:diff

php bin/console doctrine:migrations:migrate



