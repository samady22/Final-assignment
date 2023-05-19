# Set the base image as PHP version 8.2
FROM php:8.2

# Set the working directory inside the container to /var/www
WORKDIR /var/www

# Update the package lists and install necessary packages
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
    && docker-php-ext-install zip pdo pdo_mysql bcmath

# Install Composer by downloading the installer and running it
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the current directory (including all files) to the working directory inside the container
COPY . .

# Set the environment variable PORT to 8000
ENV PORT=8000

# Set the entrypoint command to run the script "docker/enteryp.sh" when the container starts
ENTRYPOINT [ "docker/enteryp.sh" ]