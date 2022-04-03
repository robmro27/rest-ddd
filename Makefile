init:
	cd docker && docker-compose build --force-rm --no-cache
	make up

up:
	cd docker && docker-compose up

schema-update:
	docker exec -ti rest-ddd_php /usr/share/nginx/html/bin/console doctrine:database:create --if-not-exists
	docker exec -ti rest-ddd_php /usr/share/nginx/html/bin/console doctrine:schema:update --force

load-fixtures:
	docker exec -ti rest-ddd_php /usr/share/nginx/html/bin/console doctrine:fixtures:load