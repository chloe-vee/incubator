BUILD_DIR=build
DIST_DIR=releases
INSTALL_DIR=$(HOME)/projects/phpbb/forum/ext

VENDOR=ra
EXTENSION=incubator
VERSION=0.1.2

EXT_ROOT=$(BUILD_DIR)/$(VENDOR)/$(EXTENSION)
ZIPFILE=$(VENDOR)-$(EXTENSION)-$(VERSION).zip

SRCS=license.txt README.md
SRCS+=acp adm config cron event language migrations

.PHONY: build
build: clean                   ## remove the build directory
	@mkdir -p $(EXT_ROOT)
	@mkdir -p $(DIST_DIR)
	@cp -r $(SRCS) $(EXT_ROOT)
	@cp .composer-dev.json $(EXT_ROOT)/composer.json
	@cd $(BUILD_DIR) && zip -r $(ZIPFILE) $(VENDOR) && cd -

.PHONY: release
release: build                  ## create a zipfile and update version numbers to $VERSION
	@echo
	@echo "Preparing release for v $(VERSION)"
	@echo "(Don't forget to edit the CHANGELOG.md)"
	@mv $(BUILD_DIR)/$(ZIPFILE) $(DIST_DIR)
	@sed -i'' -Ee "/^\[latest-release\]/ s/ra-incubator.*.zip\s*/ra-incubator.$(VERSION).zip/" README.md
	@sed -i'' -Ee '/^\s*"version":/ s/"[0-9]+\.[0-9]+\.[0-9]+"/"$(VERSION)"/' .composer-test.json
	@sed -i'' -Ee '/^\s*"version":/ s/"[0-9]+\.[0-9]+\.[0-9]+"/"$(VERSION)"/' .composer-dev.json

.PHONY: install
install: build                  ## install locally to $INSTALL_DIR
	cp $(BUILD_DIR)/$(ZIPFILE) $(INSTALL_DIR)
	cd $(BUILD_DIR) && unzip -fo $(ZIPFILE)
	rm $(BUILD_DIR)/$(ZIPFILE)

.PHONY: install
help:                            ## list targets
	@echo
	@echo incubator Makefile
	@echo
	@sed -ne '/^[a-z%-]\+:.*##/ s/:.*##/\t/p' $(word 1, $(MAKEFILE_LIST)) \
		| awk -F $$'\t' '{printf("\033[36m%s\033[0m \t%s\n", $$1, $$2)}' \
		| column -ts $$'\t'
	@echo

.PHONY: clean
clean:
	@rm -rf $(BUILD_DIR)

.DEFAULT_GOAL := help
