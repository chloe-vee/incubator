BUILD_DIR=build
DIST_DIR=releases

VENDOR=ra
EXTENSION=incubator
VERSION=0.1.0

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
	@mv $(BUILD_DIR)/$(ZIPFILE) $(DIST_DIR)

clean:
	@rm -r $(BUILD_DIR)

.DEFAULT_GOAL := build
