# Installation

* #### Clone Project

```
cd /var/www
sudo mkdir exchange_office
sudo chown {{YOUR_USER}}:{{YOUR_USER}} exchange_office

git clone git@github.com:justEugene94/Exchange-Office-API.git
```

```bash
cp .env.example .env
```

* #### Open and configure `.env` file

```bash
composer install

php artisan key:generate

php artisan migrate
php artisan db:seed
php artisan passport:install
```

* #### Copy Password Grant Credentials
    * `Client ID` to env `AUTH_PASSPORT_PG_CLIENT_ID`
    * `Client Secret` to env `AUTH_PASSPORT_PG_CLIENT_SECRET`
