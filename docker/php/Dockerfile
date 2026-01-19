FROM php:8.3-fpm-alpine

# Instalar dependências do sistema
RUN apk add --no-cache \
    libzip-dev \
    icu-dev \
    oniguruma-dev \
    libxml2-dev \
    curl-dev

# Instalar extensões PHP obrigatórias para CodeIgniter 4.6
RUN docker-php-ext-install -j$(nproc) \
    intl \
    mbstring \
    mysqli \
    pdo_mysql \
    zip \
    curl \
    xml

# Instalar Composer 2
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ÚNICA configuração obrigatória
RUN echo "date.timezone = America/Sao_Paulo" >> "$PHP_INI_DIR/php.ini"

WORKDIR /var/www/html

EXPOSE 9000

CMD ["php-fpm"]