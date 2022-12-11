DC := docker-compose
D := docker

up:
	$(DC) up -d

down:
	$(DC) down

shell:
	$(D) exec -it $(c) sh

list:
	$(D) ps

logs:
	$(D) logs -f $(c)
