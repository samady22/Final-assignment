# Use the official PHP image as the base image
FROM php:8.2

# Set the working directory in the container
WORKDIR /var/www

# Install dependencies inside the container
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
    && docker-php-ext-install zip pdo pdo_mysql bcmath

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# RUN docker run --name my-mysql-container -e MYSQL_ROOT_PASSWORD=my-secret-pw -e MYSQL_USER=my-username -e MYSQL_PASSWORD=my-password -e MYSQL_DATABASE=my-database -p 3306:3306 -d mysql

# Copy the Laravel project files to the container
COPY . .

# Expose port 8000 for the Laravel development server
ENV PORT=8000

# Start the Laravel development server
ENTRYPOINT [ "docker/enteryp.sh" ]