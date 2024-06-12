FROM php:8.3-cli

RUN pecl docker-php-ext-install
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

RUN apt update && \
    apt install -y \
    supervisor && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

RUN mkdir -p /etc/supervisor/conf.d
RUN mkdir -p /var/log/supervisor
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

COPY php.ini "${PHP_INI_DIR}/conf.d"

RUN useradd -ms /bin/bash --no-user-group -u 1337 bot

EXPOSE 8000

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
