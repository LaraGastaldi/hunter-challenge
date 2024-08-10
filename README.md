# Challenge Hunter

Esse é um desafio de PHP com Laravel, Rest API.

# Stacks
- Laravel 11
- PHP 8.3

# Como rodar

Esse app está usando docker-compose, para rodá-lo basta executar o comando abaixo:
```
docker-compose up -d
```

Para funcionar, é necessário rodar as migrações como abaixo:
```
docker-compose run laravel.test php artisan migrate
```
Ou entrar dentro do container e rodar `php artisan migrate`

# Código

O código foi feito baseado em MVC com Services para lógica de negócio, Repository para contato isolado com o banco, e Resources para mostrar o conteúdo para o cliente da forma desejada. Para saber mais, leia [Movendo a Lógica de Sua Aplicação Para Services e Repositories](https://dev.to/tadeubdev/movendo-a-logica-de-sua-aplicacao-para-services-e-repositories-4lee) e [Eloquent: API Resources](https://laravel.com/docs/11.x/eloquent-resources).

Foram criadas diversas classes abstratas para futuros manejos do conteúdo no banco, como get, update, delete, etc. A classe abstrata mais relevante é a `BaseController`, onde todos os métodos são propositalmente privados para que o método __call seja chamado e envolver a resposta em um Resource.

Não foram removidas a lógica para a tabela de Users (model e migrations), para possível uso futuro para autenticação. Dito isso, o código ainda não possui autenticação fora das rotas fictícias.
