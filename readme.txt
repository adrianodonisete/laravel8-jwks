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


https://auth0.com/docs/quickstart/backend/laravel/01-authorization?download=true#validate-access-tokens

https://manage.auth0.com/dashboard/us/dev-4-6mu9a8/apis/605f77f81e2a0d003eb1b7d4/quickstart
https://manage.auth0.com/dashboard/us/dev-4-6mu9a8/apis/605f77f81e2a0d003eb1b7d4/test




"barryvdh/laravel-cors": "^0.11.0",