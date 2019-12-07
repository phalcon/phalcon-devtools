#!/usr/bin/make -f

.PHONY: image

# ---------------------------------------------------------------------

image:
	docker build -t phalcon -f build/BuildPharDockerfile .
