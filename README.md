# Skautský informačný systém

## Local setup

### Preconditions

1. Install [Laravel] (https://laravel.com/docs/9.x/installation#getting-started-on-windows/)
2. Make sure Docker Desktop is running

### Setup steps

1. Open ubuntu console
2. Create .env file from .env.example if it does not exist \
   `cp -n .env.example .env`
3. Install composer \
   `docker run --rm -v "$(pwd)":/opt -w /opt laravelsail/php81-composer:latest bash -c "composer install"`
4. Create required files and directories \
   `echo {} > package-lock.json`
5. Start containers \
   `./vendor/bin/sail up -d`
6. Generate app key and install dependencies via npm \
   `docker exec -it sis_laravel.test_1 bash -c "php artisan key:generate && php artisan migrate:fresh && php artisan db:seed && npm install && npm run dev"`
7. Create database and fill it \
   `php artisan migrate && php artisan db:seed`

The web should be available at [localhost](http://localhost/)

## Running after the setup

1. Open ubuntu console and navigate to the project home directory (_sis_v2_)
2. Run docker containers
   `./vendor/bin/sail up -d`
3. Connect to laravel container \
   `docker exec -it sis-v2_laravel.test_1 bash`

## Gmail smtp setup

1. Allow less secure apps from https://myaccount.google.com/lesssecureapps?pli=1&rapt=AEjHL4M_eeeQecbbJkBgzEBVzMZbSCSELZjDFYqcAB2XNixLBisyeMAckm01zBxdkM06FZQkJ6fkYLYMpIV1QFBKPcWZbSpRYQ
2. Unlock Captcha from https://accounts.google.com/b/0/DisplayUnlockCaptcha
