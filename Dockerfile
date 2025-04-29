FROM php:8.2-fpm

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim \
    optipng \
    pngquant \
    git \
    curl \
    unzip \
    libzip-dev \
    && curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Configura e instala extensões PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_mysql \
    zip \
    exif \
    pcntl \
    bcmath \
    gd

# Instala extensão PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo_pgsql pgsql

# Instala Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Cria diretório de trabalho
WORKDIR /var/www

# Cria usuário não-root
RUN groupadd -g 1000 www && useradd -u 1000 -g www -m www

# Copia arquivos do projeto
COPY --chown=www:www . /var/www

# Define permissões corretas
RUN mkdir -p /var/www/storage/framework/{sessions,views,cache} \
    && mkdir -p /var/www/storage/logs \
    && chown -R www:www /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Instala dependências do PHP como usuário www
USER www
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Instala dependências do Node.js
RUN npm install && npm run build || true

EXPOSE 9000
CMD ["php-fpm"]
