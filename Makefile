# Nama project
PROJECT_NAME = codeigniter3-app

# Command docker-compose
DC = docker-compose

# Build infra (build image PHP)
build:
	$(DC) build

# Run infra (start containers)
up:
	$(DC) up -d

# Stop infra
down:
	$(DC) down

# Restart infra
restart: down up

# Lihat status container
ps:
	$(DC) ps

# Akses bash container PHP
bash:
	$(DC) exec app bash

# Remove container & volume (fresh start)
clean:
	$(DC) down -v

# Logs container
logs:
	$(DC) logs -f

# # Export database ke file dump.sql
# db-dump:
# 	$(DC) exec db mysqldump -uroot -proot ci3db > dump.sql

# # Import database dari dump.sql
# db-import:
# 	$(DC) exec -i db mysql -uroot -proot ci3db < dump.sql

