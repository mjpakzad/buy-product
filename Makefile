up:
	docker compose up -d

build:
	docker compose up -d --build

setup:
	cp .env.example .env \
	&& docker compose up -d \
	&& docker exec -it app composer install \
	&& docker exec -it app php artisan key:genrate \
	&& docker exec -it app php artisan storage:link \
	&& docker exec -it app php artisan migrate --seed

test:
	docker exec -it app php artisan test

down:
	docker compose down
