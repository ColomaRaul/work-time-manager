.PHONY: up bash init stop down bash-consumers composer-install unit
up:
	cd docker && docker-compose up

bash:
	cd docker && docker-compose exec php sh

bash-consumers:
	cd docker && docker-compose exec php-consumers sh

stop:
	cd docker && docker-compose stop

down:
	cd docker && docker-compose down

composer-install:
	cd docker && docker-compose run --rm php composer install

unit:
	cd docker && docker-compose exec php vendor/phpunit/phpunit/phpunit -c phpunit.xml.dist

init:
	@docker network create app || true
	@docker network create message_queue || true
	@docker network create database || true
	$(MAKE) up
	$(MAKE) composer-install
