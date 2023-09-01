# Utilisez l'image officielle de PHP avec Apache
FROM php:apache
# Définir le répertoire de travail dans l'image
WORKDIR /var/www/html/vehicule

# Copier les fichiers du projet dans l'image
COPY . .
# Installer les dépendances avec Composer
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install
RUN php artisan route:cache
RUN php artisan route:clear
RUN php artisan config:cache
RUN php artisan config:cache
RUN php artisan optimize
# Exposer le port 80 pour Apache
EXPOSE 8900
# Commande pour démarrer le serveur Apache
#CMD ["php artisan serve --port=8000 --host=0.0.0.0"]
CMD ["php", "artisan", "serve", "--port=8900", "--host=0.0.0.0"]

