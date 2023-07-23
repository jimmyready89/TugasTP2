Proses Install Project Laravel

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
php artisan migrate
php artisan migrate --path database/migrations/*
```

```sh
# Run Seeder
php artisan db:seed --class=UserSeeder
```

```sh
# Run create passport keys
php artisan passport:keys
```

Sebelum Push ke repository mohon untuk jalanin comment berikut :

```sh
# unit test
php artisan test
```

```sh
# clean code
vendor\bin\phpcs -s
```
