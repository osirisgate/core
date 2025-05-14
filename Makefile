FILES ?= src tests

.SILENT:

.DEFAULT_GOAL := help

help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

##
## This console application is made to manage project.

##
## LINT
php-cs: ## Run PHP CS Lint
	@echo "Executing PHP CS lint... on $(FILES)"
	@composer phpcs-fix

php-stan: ## Run PHP Stan analyse
	@echo "Executing PHP Stan analyze... on $(FILES)"
	@composer phpstan

check-code-quality: php-cs php-stan  ## Check Code Quality
