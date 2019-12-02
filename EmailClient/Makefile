TEMPLATE_FILES=$(shell find . -name "*.tpl.html")
TARGET_FILES=$(subst dev/,prod/,$(subst .tpl.html,.html, $(TEMPLATE_FILES)))
PREPROCESSOR_SCRIPT=/usr/bin/python3 # This is boilerplate code, in the future cat will be replaced with a more meaningful Unix Tool
PREPROCESSOR_SUPPORT_FILES=dev/html_generation_support.py

all: $(TARGET_FILES)

prod/%.html: dev/%.tpl.html
	cat $(PREPROCESSOR_SUPPORT_FILES) $< | $(PREPROCESSOR_SCRIPT) > $@

clean:
	rm $(TARGET_FILES)
