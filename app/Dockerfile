FROM yiisoftware/yii2-php:7.0-apache
ADD . /app
WORKDIR /app
RUN chmod -R 777 runtime & chmod -R 777 web
RUN composer dump-autoload -o

