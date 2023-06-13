start: start-api start-front

start-api:
	docker compose up -d --force-recreate
	docker compose exec php composer install

start-front:
	cd nuxt && pnpm install && pnpm dev -o

clear:
	docker compose exec php bin/console cache:clear

require:
	docker compose exec php composer require $(PACKAGE)

require-dev:
	docker compose exec php composer require --dev $(PACKAGE)

bash:
	docker compose exec php bash
