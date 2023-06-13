# Currency APP

This app shows latest currency rates from EUR to USD daily basis.

The app was developed with Symfony as REST API and with Nuxt.js as front-end interface!

___

## Installation

Before running this app, you must have:
- Docker
- Docker Compose v2
- Node.js (v18+)
- PNPM
- Make

To run this app:
1. Copy and configure .env and .env.test variables `cp .env.example .env`
2. Run `make start` (for API `make start-api`, front `make start-front`)
3. Run doctrine migrations `docker compose exec php bin/console doctrine:migrations:migrate`
4. If you want to check PHPUnit tests:
   - Run `docker compose exec php bin/console --env=test doctrine:database:create`
   - Run `docker compose exec php bin/console --env=test doctrine:schema:create`
   - Run `docker compose exec php bin/console --env=test doctrine:fixtures:load`
