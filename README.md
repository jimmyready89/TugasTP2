Cara Install Project Laravel

```sh
# download vendor
composer install
```

```sh
# copy env
cp .env.example .env
```

```sh
# generate key
php artisan key:generate
```

```sh
# migration
php artisan migrate --path database/migrations/*
```

```sh
# unit test
php artisan test
```

```sh
# clean code
vendor\bin\phpcs 
```

```sh
# Run Seeder
php artisan db:seed --class=UserSeeder
```
