O projeto foi desenvilvido em Laravel em um ambiente windows, caso necessário rodar em linux ou MAC verifique os comandos compativeis com os mencionados abaixo:

## Build e Subir o Projeto no Docker (na raiz do projeto):
docker-compose up --build

## Acessar o Container do Laravel:
docker exec -it laravel_app bash

## Instalar Dependências (se necessário):
composer install

## Rodar as Migrations:
php artisan migrate

## Rodar os Testes:
php artisan test

## Configurar Permissões de Pastas: Caso ocorra algum erro de permissão, você pode ajustar as permissões com os seguintes comandos:
chmod -R 775 storage
chmod -R 775 bootstrap/cache
