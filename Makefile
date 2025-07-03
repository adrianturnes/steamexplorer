SHELL:=/bin/bash

PHP_CONTAINER_NAME=steam-php
#TODO: comando make, listar opciones disponibles
build:
	@docker compose build
install:
	@docker compose up -d
down:
	@docker compose down
shell:
	@docker compose exec ${PHP_CONTAINER_NAME} bash -l
phpunit:
	@docker compose exec ${PHP_CONTAINER_NAME} bash -l -c './vendor/bin/phpunit'
test-unit:
	@docker compose exec ${PHP_CONTAINER_NAME} bash -l -c './vendor/bin/phpunit --testsuite Unit'
test-integration:
	@docker compose exec ${PHP_CONTAINER_NAME} bash -l -c './vendor/bin/phpunit --testsuite Integration'
test-acceptance:
	@docker compose exec ${PHP_CONTAINER_NAME} bash -l -c './vendor/bin/phpunit --testsuite Acceptance'
coverage:
	@docker compose exec ${PHP_CONTAINER_NAME} bash -l -c 'export XDEBUG_MODE=coverage; ./vendor/bin/phpunit --coverage-html coverage'
coverage-report:
	@docker compose exec ${PHP_CONTAINER_NAME} bash -l -c 'export XDEBUG_MODE=coverage; ./vendor/bin/phpunit --coverage-clover ./coverage.xml'
#CODE analysis
phpstan:
	@docker compose exec ${PHP_CONTAINER_NAME} bash -l -c './vendor/vendor/bin/phpstan analyse --memory-limit=-1'
phpmd:
	@docker compose exec ${PHP_CONTAINER_NAME} bash -l -c './vendor/vendor/bin/phpmd app text phpmd.xml --suffixes php'
