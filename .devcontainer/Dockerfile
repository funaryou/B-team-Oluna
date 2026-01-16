FROM mcr.microsoft.com/devcontainers/php:1-8.4-bookworm

RUN apt-get update && apt-get upgrade -y &&\
    apt-get install -y vim &&\
    apt-get clean -y && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pcntl

RUN su vscode -c "source /usr/local/share/nvm/nvm.sh && nvm install v24"
