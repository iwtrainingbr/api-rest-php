# API REST

API REST criada com PHP puro durante as aulas do curso de PHP 8.1 na iwtraining

## Instalação

> Precisar instalar o composer
Caso ainda não possua, instale através do site https://getcomposer.org

Após baixar a aplicação, entre no diretório da mesma e execute:
`php composer.phar install` 
ou 
`composer install`

## Banco de Dados
Crie um banco de dados chamado `db_iw_api` e modifique o arquivo `src/Connection/DatabaseConnection.php`

> Para criar as tabelas do banco de dados execute:
`php vendor/bin/doctrine orm:schema-tool:update --force`

## Execução
Para executar, acesse o diretório da aplicação e execute:
`php -S localhost:8000 -t public`