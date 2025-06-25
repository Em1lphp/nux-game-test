.EXPORT_ALL_VARIABLES:

PROJECT_NAME=nux-game-test
COMPOSE_DEV_FILE="${PWD}/docker/dev/compose.yaml"

run:
	docker-compose -p ${PROJECT_NAME} -f ${COMPOSE_DEV_FILE} up -d --build

stop:
	docker-compose -p ${PROJECT_NAME} -f ${COMPOSE_DEV_FILE} stop -t0

rm: stop
	docker-compose -p ${PROJECT_NAME} -f ${COMPOSE_DEV_FILE} rm -fv

down:
	docker-compose -p ${PROJECT_NAME} -f ${COMPOSE_DEV_FILE} down --remove-orphans

ssh:
	docker exec -it ${PROJECT_NAME}_fpm bash
