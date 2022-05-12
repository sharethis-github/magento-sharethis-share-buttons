# @sputhyapurayil https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
.DEFAULT_GOAL = help

bash:	## Magento Bash.
	@bash ./bin/bash.sh

build:	## Build Magento.
	@docker compose build

cache-delete:	## Cache delete.
	@bash ./bin/bash.sh -c "rm -rf var/cache/* var/page_cache/* var/generation/* generated/*"

destroy:	## Destroy.
	@docker compose down --remove-orphans -v

.PHONY: help
help:	## Show this help.
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

init:		## Init.
	@bash ./bin/script/init.sh

populate:	## Populate Magento with sample data.
	# Go to https://marketplace.magento.com/customer/accessKeys/ and copy the Public and Private Key
	# Run sampledata:deploy...
	@bash ./bin/script/populate.sh

start:	## Start Magento.
	@docker compose up -d

stop:	## Stop Magento.
	@docker compose down

