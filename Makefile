# @sputhyapurayil https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
.DEFAULT_GOAL = help

.PHONY: bash
bash:	## Magento Bash.
	@bash ./bin/bash.sh

.PHONY: build
build:	## Build Magento.
	@docker compose build

.PHONY: cache-delete
cache-delete:	## Cache delete.
	@bash ./bin/bash.sh -c "rm -rf var/cache/* var/page_cache/* var/generation/* generated/*"

.PHONY: destroy
destroy:	## Destroy.
	@docker compose down --remove-orphans -v

.PHONY: help
help:	## Show this help.
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

.PHONY: init
init:		## Init.
	@bash ./bin/script/init.sh

.PHONY: mode-developer
mode-developer:
	@bash ./bin/magento.sh deploy:mode:set developer

.PHONY: mode-production
mode-production:
	@bash ./bin/magento.sh deploy:mode:set production

.PHONY: populate
populate:	## Populate Magento with sample data.
	@docker exec -it st_magento install-sampledata
	@bash ./bin/script/populate.sh

.PHONY: prepare
prepare:	## Prepare.
	@docker compose up -d --build

.PHONY: restart
restart:	## Restart Magento.
	@docker compose restart

.PHONY: start
start:	## Start Magento.
	@docker compose up -d

.PHONY: stop
stop:	## Stop Magento.
	@docker compose down

.PHONY: tail
tail:	## Tail Magento.
	@docker compose logs -t -f web
