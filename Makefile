# HELP
# This will output the help for each task
# thanks to https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
.PHONY: help

help: ## This help.
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

.DEFAULT_GOAL := help

# DOCKER TASKS

# Build the container
setup: ## Build the release and develoment container. The development
	docker-compose build --build-arg APP_ENV=prod php
	docker-compose run --rm php composer install
	docker-compose run --rm php bin/console doctrine:schema:create --env=test

start:
	docker-compose up -d db adminer php web 

down:
	docker-compose down --remove-orphans 

cli:
	docker-compose exec php sh  

migrate: 
	docker-compose run --rm php bin/console doctrine:migrations:migrate -n

unit-tests:
	docker-compose run --rm php vendor/bin/simple-phpunit

bdd-tests:
	docker-compose run --rm php vendor/bin/behat

test: unit-tests bdd-tests

back20: ## Clean everything.
	docker-compose down --rmi all -v --remove-orphans
	rm -rf apps/zett/var
	rm -rf apps/zett/vendor

