docker documentation
https://docs.docker.com/compose/reference/down/


start docker
docker-compose up -d

finish docker
docker-compose down

- access the docker
docker exec -it 83ad4ef2b5dc bash

- get code container
docker ps

install laravel
curl -s https://laravel.build/graphql-laravel8-app | bash

- install laravel packages
composer install

- generate key
php artisan key:generate

- permissons storage diretories
chmod 0777 -R /var/www/html/storage/logs/
chmod 0777 -R /var/www/html/storage/framework/sessions/
chmod 0777 -R /var/www/html/storage/framework/views/


auth0 configurations:
https://manage.auth0.com