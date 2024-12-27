up:
	docker-compose up --build -d 
down:
	docker-compose down
bash:
	docker exec -it php-test-api_app_1 bash
track:
	docker logs --follow php-test-api_app_1
test:
	docker-compose exec app ./vendor/bin/phpunit tests