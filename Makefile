init:
	cd docker && docker-compose build --force-rm --no-cache
	make up

up:
	cd docker && docker-compose up