# Usa a imagem oficial do PHP com FPM
FROM php:8.1-fpm

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    zip unzip curl git libzip-dev libpq-dev libpng-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório padrão de trabalho
WORKDIR /var/www

# Copia os arquivos da aplicação
COPY . .

# Instala as dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Garante permissões corretas
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expõe a porta padrão do artisan serve
EXPOSE 8000

# Comando de inicialização
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
