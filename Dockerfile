# Start with a base image
FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    libzip-dev \
    unzip \
    unoconv \
    poppler-utils \
    vim \
    python3 \
    python3-pip \
    python3-venv  # Install python3-venv package

# Install Python packages in a virtual environment
RUN python3 -m venv /opt/venv
ENV PATH="/opt/venv/bin:$PATH"

# Upgrade pip and install spacy
RUN pip install -U pip setuptools wheel
RUN pip install -U spacy
RUN python -m spacy download en_core_web_sm

# Install PHP extensions and other dependencies
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip pdo_mysql mbstring exif pcntl bcmath gd sockets

# Install wrk
RUN git clone https://github.com/wg/wrk.git /wrk \
    && cd /wrk \
    && make \
    && cp wrk /usr/local/bin \
    && rm -rf /wrk

# Install Swoole extension via PECL if needed
# RUN pecl install swoole && docker-php-ext-enable swoole

# Copy Composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create a system user to run Composer and Artisan Commands
ARG user
ARG uid
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

# Switch to the user
USER $user
