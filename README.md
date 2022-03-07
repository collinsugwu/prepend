## Pokemon

Since the 90s [Pokémon](https://en.wikipedia.org/wiki/Pokémon) enjoy worldwide popularity. These little monsters are not only cute but led to many games and phenomena like [Pokémon Go](https://pokemongolive.com/).

As more than 900 Pokemon’s exist it’s very hard to have a clear understanding or even overview about each. Therefore we’d like to provide a solution that lets user discover and browse through all Pokemon’s.

Additionally we’d like to enable third party applications to retrieve the data through a JSON based API.


## Technologies Used

- **[PHP >= 7.2](https://www.php.net/)**
- **[Laravel 8](https://laravel.com)**
- **[Composer](https://getcomposer.org/download/)**
- **[MySQL](https://www.mysql.com/)**
- **[Laravel Excel](https://laravel-excel.com/)**
- **[PHPUnit](https://phpunit.de/)**

## Project Setup
```
# set up your .env
cp .env.example .env

# then modify the infos in your .env

composer install

# generate app key (laravel specific)
php artisan key:generate

# Migrate all the database
php artisan migrate

# Import Pokemon CSV data
php artisan import:pokemons
```
## Test
```
php artisan test
```

## API AUTH

For third party applications
```
    email = test@test.com
    password = password
```
## API ROUTE
Bearer Token should have a prefix ''
```
/api/pokemons
/api/pokemons/{id}
```
## TODO
- Views for Pokemon Crud
- More Test Cases

