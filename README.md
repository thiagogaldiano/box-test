## Primeiro passo

Para iniciar o projeto executar o clone no repositório no GIT:

    https://github.com/thiagogaldiano/box-test.git

## Docker

Caso não tenha instalado

   Instalar o docker e o docker-compose no seu sistema operacional

## Efetuar as seguintes intalações utilizando a docker

    cd box-test

Configurar .env

    cp .env.example .env
    
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=box
    DB_USERNAME=box
    DB_PASSWORD=12345678

Subir os containers do docker utilizando docker-compose

    docker-compose up -d

Executar o composer para fazer download das dependências

    docker-compose exec app composer install
    

Gerar a chave:

    docker-compose exec app php artisan key:generate
    
Executar as migrações para criar as tabelas:

    docker-compose exec app php artisan migrate

Executar os seeders para popular algumas tabelas:

    docker-compose exec app php artisan db:seed --class=UserSeeder
    docker-compose exec app php artisan db:seed --class=MovementTypeSeeder

## Tocken de acesso - Passport 

  Criar o tocken de acesso:

    docker-compose exec app php artisan passport:install

## Documentação das APIs

Para acessar a documentação, clique [aqui](https://documenter.getpostman.com/view/4845658/TzJx9cMo)

## Demo:

Este é o link da demo, que está no ar para teste das APIs
http://ec2-3-21-163-190.us-east-2.compute.amazonaws.com:8000