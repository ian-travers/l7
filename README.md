[![StyleCI](https://github.styleci.io/repos/255331761/shield?branch=master)](https://github.styleci.io/repos/255331761) [![Build Status](https://travis-ci.com/ian-travers/l7.svg?branch=master)](https://travis-ci.com/ian-travers/l7)

### About L7

L7 is web application for NFSU Cup.

### Application test deployment

1. Clone the application
2. Run <code>composer install</code> to update vendor dependencies
3. Run <code>make up</code> to start docker containers
4. Run <code>docker-compose exec node yarn</code> to update node dependencies
5. Run <code>make assets-dev</code> to build assets (css & js)
6. Run <code>php artisan migrate</code> to create database tables (You must create database 'l7' before)
7. Run <code>php artisan db:seed</code> to persist primary database data
