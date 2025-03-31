# Utiliser une image PHP officielle avec Apache
FROM php:8.2-apache

# Installer les dépendances nécessaires pour PHP, Composer, Node.js et npm
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installer Node.js et npm
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# Configurer le répertoire de travail dans le conteneur
WORKDIR /var/www/html

# Copier les fichiers du projet dans le conteneur
COPY . /var/www/html

# Installer les dépendances PHP via Composer
RUN composer install --no-dev --optimize-autoloader

# Installer les dépendances Node.js via npm
RUN npm install

# Exposer le port 8000 pour php artisan serve
EXPOSE 8000

# Commande pour démarrer les deux services (php artisan et npm)
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 & npm run dev"]
