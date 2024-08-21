# Use the official PHP Apache image as the base
FROM php:apache

# Install the mysqli extension
RUN docker-php-ext-install mysqli

# Verify installation of mysqli extension
RUN php -m | grep mysqli

# Copy the application code into the container
COPY . /var/www/html/

# Optional: Set appropriate permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html
