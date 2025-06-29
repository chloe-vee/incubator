BUILD_DIR=build
DIST_DIR=releases
INSTALL_DIR=$(HOME)/projects/phpbb/forum/ext

VENDOR=ra
EXTENSION=incubator
VERSION=0.1.1

EXT_ROOT=$(BUILD_DIR)/$(VENDOR)/$(EXTENSION)
ZIPFILE=$(VENDOR)-$(EXTENSION)-$(VERSION).zip

SRCS=license.txt README.md
SRCS+=acp adm config cron event language migrations

.PHONY: build
build: clean
	@mkdir -p $(EXT_ROOT)
	@mkdir -p $(DIST_DIR)
	@cp -r $(SRCS) $(EXT_ROOT)
	@cp .composer-dev.json $(EXT_ROOT)/composer.json
	@cd $(BUILD_DIR) && zip -r $(ZIPFILE) $(VENDOR) && cd -

.PHONY: release
release: build
	@mv $(BUILD_DIR)/$(ZIPFILE) $(DIST_DIR)

.PHONY: install
install: build
	cp $(BUILD_DIR)/$(ZIPFILE) $(INSTALL_DIR)
	cd $(BUILD_DIR) && unzip -fo $(ZIPFILE)

.PHONY: clean
clean:
	@rm -rf $(BUILD_DIR)

.DEFAULT_GOAL := build
