all: build composer-install

build:
	@docker-compose build
	@docker-compose up -d
composer-install:
	@docker-compose exec -T service_php composer install
clean:
	@docker-compose down
	@docker system prune -af
	@docker volume prune -f

help:
	@docker-compose exec -T service_php phalcon --help
create-dummy:
	@docker-compose exec -T service_php phalcon create-project dummy --enable-webtools --force
