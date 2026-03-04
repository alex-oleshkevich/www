set shell := ["bash", "-eu", "-o", "pipefail", "-c"]

image := "beginner-legacy"
container := "beginner-legacy"
port := "8085"

build:
    docker build -t {{image}} .

run: build
    docker run --rm -p {{port}}:80 {{image}}

run-bg: build
    docker rm -f {{container}} >/dev/null 2>&1 || true
    docker run -d --name {{container}} -p {{port}}:80 {{image}}

stop:
    docker rm -f {{container}}
