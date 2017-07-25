# fitW3

Single Page App to log your workout progress.
* [Live demo](https://fit.vytautasns.me)

### Caution

This web app is still in development.


### Installing

Run theese command to install the project

``` bash
# clone repository
git clone https://github.com/Vytautasns/tracker.git

# get to the folder
cd tracker

# install php dependencies
composer install

# Rename env file
mv .env.example .env

# generate app key
php artisan key:generate

# create sqlite database file
touch database/database.sqlite

# create database tables and fill exercises data
php artisan migrate --seed

# install front-end dependencies
npm install

# build javascript
npm run dev

# serve to local host now you can visit app at http://127.0.0.1:8000
php artisan serve
```


## Built With

* [Laravel](https://laravel.com/) - PHP framework
* [VueJS](https://vuejs.org/) - JavaScript Framework
* [UIkit](https://getuikit.com/docs/introduction) - Nice and clean CSS framework


