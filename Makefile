firstTime:dev composer files alias

local: dev alias

dev:
	docker-compose \
		-f .infrastructure/docker-compose/docker-compose.common.yml \
		-f .infrastructure/docker-compose/docker-compose.yml \
		 --env-file .env up -d --build --remove-orphans
common:
	docker-compose -f .infrastructure/docker-compose/docker-compose.common.yml --env-file .env up -d --build

main:
	docker-compose -f .infrastructure/docker-compose/docker-compose.yml --env-file .env up -d --build

composer:
	docker exec -t php-fpm bash -c 'COMPOSER_MEMORY_LIMIT=-1 composer install  --no-interaction'

php:
	docker exec -it php-fpm bash
files:
	docker exec php-fpm chmod -R 777 /application/storage/logs
	docker exec php-fpm chmod -R 777 /application/storage/framework
	mkdir -p .infrastructure/docker-compose/.db
	sudo chmod -R 777 .infrastructure/docker-compose/.db

alias:
	docker exec -u root php-fpm sh -c "echo 'alias ll=\"ls -l\"' >> /root/.bashrc && echo 'alias art=\"php artisan \"' >> /root/.bashrc"

art:
	docker exec -t php-fpm bash -c 'php artisan $(filter-out $@,$(MAKECMDGOALS))'
