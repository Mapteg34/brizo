SHELL := /bin/bash

%:
	@:

test:
	docker-compose exec -u www-data php bash -c './vendor/phpunit/phpunit/phpunit --coverage-html=./public/phpunit-coverage';

test_unit:
	docker-compose exec -u www-data php bash -c './vendor/phpunit/phpunit/phpunit --coverage-html=./public/phpunit-coverage tests/Unit';

test_feature:
	docker-compose exec -u www-data php bash -c './vendor/phpunit/phpunit/phpunit --coverage-html=./public/phpunit-coverage tests/Feature';
