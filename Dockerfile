# ====== Stage 1: build de Tailwind (sin Node) ======
FROM debian:bookworm-slim AS tailwind-build

RUN apt-get update && apt-get install -y --no-install-recommends \
    ca-certificates curl \
 && rm -rf /var/lib/apt/lists/*

# Binario Tailwind para Linux ARM64 (v4)
RUN curl -sL https://github.com/tailwindlabs/tailwindcss/releases/latest/download/tailwindcss-linux-arm64 \
  -o /usr/local/bin/tailwindcss && \
  chmod +x /usr/local/bin/tailwindcss

WORKDIR /app

# Copiamos sólo lo necesario para compilar
# (ajusta rutas si tus archivos están en otro lugar)
COPY tailwind.config.js postcss.config.js ./ 
COPY assets/css/app.css ./assets/css/app.css

# Compila a /app/public/css/app.css
RUN /usr/local/bin/tailwindcss \
  -i ./assets/css/app.css \
  -o ./public/css/app.css \
  --minify

# ====== Stage 2: imagen final PHP + Apache (ARM64) ======
FROM arm64v8/php:8.2-apache

# Instalar dependencias del sistema y extensiones de PHP
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install pdo pdo_mysql mysqli gd iconv zip

# Instalar Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

# Configurar el directorio de trabajo
WORKDIR /var/www/html

# Copiar el código fuente de la aplicación al contenedor
COPY . /var/www/html

# Copia el CSS ya compilado por el stage anterior
COPY --from=tailwind-build /app/public/css/app.css /var/www/html/public/css/app.css

# Establecer permisos (opcional, dependiendo de las necesidades de la aplicación)
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80
EXPOSE 80

# Iniciar Apache
CMD ["apache2-foreground"]
