# Cargo Calculator @ Klaidas

## Development

Project uses [Docker](https://docs.docker.com/install) to run development environment.

Available services:
- [PHP 8.2](https://www.php.net/docs.php)
- [MySQL 8.0.32](https://dev.mysql.com/doc/)
- [Laravel 10](https://laravel.com/docs/10.x)

## Starting project locally

1. Initialize configurations and start docker services
```shell
./scipts/init.sh && ./scripts/start.sh
```

2. Run this command to install PHP dependencies (composer install, migrations, seeders)
```shell
./scripts/install.sh
```

3. To access backend run:
```shell
./scripts/backend.sh
```

Run project on browser: [https://localhost:8080](http://localhost:8080)

To stop docker services run:
```shell
./scripts/stop.sh
```