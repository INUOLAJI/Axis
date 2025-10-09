# Use an official PHP image with Apache preinstalled
FROM php:8.2-apache

# Set working directory inside container
WORKDIR /var/www/html

# Copy your project files into the container
COPY . /var/www/html

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql

# Enable Apache mod_rewrite for pretty URLs (optional)
RUN a2enmod rewrite

# Expose port 80 (default for web apps)
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
