.PHONY: help install test server watch migration migrate seeder seed cover sniff cbf
.DEFAULT_GOAL=help

VERSION=7.1
PHP=php$(VERSION)
PORT?=8000
HOST?=0.0.0.0
CURRENT_DIR=$(shell pwd)

help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-10s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

vendor: composer.json
	composer install

composer.lock: composer.json
	composer update

install: vendor composer.lock ## Install php dependencies

test: install ## Launch unit tests
	$(PHP) ./vendor/bin/phpunit --color

cover: install ## Launch unit tests with test coverage
	$(PHP) ./vendor/bin/phpunit --stop-on-failure --color --coverage-html tmp/coverage/
	echo -e "Lancement du serveur sur http://$(HOST):8010"
	$(PHP) -S $(HOST):8010 -t tmp/coverage/

server: install ## Launch internal php server
	echo -e "Lancement du serveur sur http://$(HOST):$(PORT)"
	ENV=dev $(PHP) -S $(HOST):$(PORT) -t public/ -d display_errors=1

sniff: ## Search errors in source code
	~/.config/composer/vendor/bin/phpcs -s src/ tests/ public/index.php

cbf: ## Fix errors in source code
	~/.config/composer/vendor/bin/phpcbf src/ tests/ public/index.php

browsersync:
	echo -e "Lancement du serveur de synchronisation"
	browser-sync start --port 3000 --proxy $(HOST):$(PORT) --files 'src/**/*.php' --files 'src/**/*.twig'

watch: server browsersync ## Watch changed files and refresh the browser

migration: ## Create a migration, use with a name as argument
	php vendor/bin/phinx create $(filter-out $@,$(MAKECMDGOALS))

migrate: ## Migrate all migrations
	php vendor/bin/phinx migrate

seeder: ## Create a seeder, use with a name as argument
	php vendor/bin/phinx seed:create $(filter-out $@,$(MAKECMDGOALS))

seed: migrate ## Run all seeders
	php vendor/bin/phinx seed:run
