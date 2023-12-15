# Buy product

## How to use
Install Using `make` command or `docker` command directly.
### 1. Make command
#### Setup
```bash
make setup
```
#### Down
```bash
make down
```
#### Up
```bash
make up
```
#### Rebuild
```bash
make build
```
#### Test
```bash
make test
```

### 2. Docker command
#### Create .env from .env.example
```bash
cp .env.example .env
```
#### Up project
```bash
docker compose up -d
```
#### Run composer install command
```bash
docker exec -it app composer install
```
#### Generate app key
```bash
docker exec -it app php artisan key:generate
```
#### Create a symlink from *public/storage* to *storage/app/public*
```bash
docker exec -it app php artisan storage:link
```
#### Migrate and seed database
```bash
docker exec -it app php artisan migrate --seed
```
#### Test project
```bash
docker exec -it app php artisan test
```

## Postman
A postman collection file included in the root of source code.
