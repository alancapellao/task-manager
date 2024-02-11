FROM php:8.2-apache

# variáveis de ambiente do Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
ENV APACHE_LOG_DIR /var/log/apache2

# ativa o mod_rewrite do Apache
RUN a2enmod rewrite

#atualiza os pacotes da imagem
RUN apt-get update -y && apt-get upgrade -y

#instala extensão zip
RUN apt-get install -y \
        libzip-dev \
        cron \
        nano \
        zip \
  && docker-php-ext-install zip

#instala extensão PDO
RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql

# instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
--install-dir=/usr/bin --filename=composer && chmod +x /usr/bin/composer 
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php -r "unlink('composer-setup.php');"

# seta o document root configurado anteriormente nas variáveis de ambiente
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# informa o diretório raiz do Docker
WORKDIR /var/www/html

# expõe a porta 80 do container
EXPOSE 80