# Laravel 8.9 blog

This project is a fork of https://github.com/guillaumebriday/laravel-blog/

The purpose of this repository is to show good development practices on [Laravel](http://laravel.com/) as well as to present cases of use of the framework's features like:

- [Authentication](https://laravel.com/docs/8.x/authentication)
- API
  - Token authentication
  - [API Resources](https://laravel.com/docs/8.x/eloquent-resources)
  - Versioning
- [Blade](https://laravel.com/docs/8.x/blade)
- [Broadcasting](https://laravel.com/docs/8.x/broadcasting)
- [Cache](https://laravel.com/docs/8.x/cache)
- [Email Verification](https://laravel.com/docs/8.x/verification)
- [Filesystem](https://laravel.com/docs/8.x/filesystem)
- [Helpers](https://laravel.com/docs/8.x/helpers)
- [Horizon](https://laravel.com/docs/8.x/horizon)
- [Localization](https://laravel.com/docs/8.x/localization)
- [Mail](https://laravel.com/docs/8.x/mail)
- [Migrations](https://laravel.com/docs/8.x/migrations)
- [Policies](https://laravel.com/docs/8.x/authorization)
- [Providers](https://laravel.com/docs/8.x/providers)
- [Requests](https://laravel.com/docs/8.x/validation#form-request-validation)
- [Seeding & Factories](https://laravel.com/docs/8.x/seeding)
- [Testing](https://laravel.com/docs/8.x/testing)
- [Homestead](https://laravel.com/docs/8.x/homestead)

Beside Laravel, this project uses other tools like:

- [Bootstrap 4](https://getbootstrap.com/)
- [PHP-CS-Fixer](https://github.com/FriendsOfPhp/PHP-CS-Fixer)
- [Travis CI](https://travis-ci.org/)
- [Font Awesome](http://fontawesome.io/)
- [Vue.js](https://vuejs.org/)
- [axios](https://github.com/mzabriskie/axios)
- [Redis](https://redis.io/)
- [spatie/laravel-medialibrary](https://github.com/spatie/laravel-medialibrary)
- Many more to discover.

## Some screenshots

You can find some screenshots of the application on : [https://imgur.com/a/Jbnwj](https://imgur.com/a/Jbnwj)

## Installation

Development environment requirements :
- [VirtualBox](https://www.virtualbox.org/)
- [Vagrant](https://www.vagrantup.com/)

Setting up your development environment on your local machine :
```bash
$ git clone https://github.com/hmoodallahma/laravel-blog.git
$ cd laravel-blog (or the directory you mapped to in your VM)
$ cp .env.example .env
$ composer install
$ vagrant up
$ vagrant ssh
```

All following commands must be run inside the VM:
```bash
$ cd code
$ yarn install
$ artisan key:generate
$ artisan horizon:install
$ artisan telescope:install
$ artisan storage:link
```

Now you can access the application via [http://localhost:8000](http://localhost:8000).

**There is no need to run `php artisan serve`. PHP is already running in the dedicated virtual machine.**

## Before starting
You need to run the migrations with the seeds :
```bash
$ artisan migrate --seed
```

This will create a new user that you can use to sign in :
```yml
email: bob@bob.com
password: bobrules
```

And then, compile the assets :
```bash
$ yarn dev # or yarn watch
```

## Useful commands
Seeding the database :
```bash
$ artisan db:seed
```

Running tests :
```bash
$ ./vendor/bin/phpunit --cache-result --order-by=defects --stop-on-defect
```

Running php-cs-fixer :
```bash
$ ./vendor/bin/php-cs-fixer fix --config=.php_cs --verbose --dry-run --diff
```

Generating backup :
```bash
$ artisan vendor:publish --provider="Spatie\Backup\BackupServiceProvider"
$ artisan backup:run
```


Discover package
```bash
$ artisan package:discover
```

In development environnement, rebuild the database :
```bash
$ artisan migrate:fresh --seed
```

## Accessing the API

Clients can access to the REST API. API requests require authentication via token. You can create a new token in your user profile.

Then, you can use this token either as url parameter or in Authorization header :

```bash
# Url parameter
GET http://laravel-blog.app/api/v1/posts?api_token=your_private_token_here

# Authorization Header
curl --header "Authorization: Bearer your_private_token_here" http://laravel-blog.app/api/v1/posts
```

API are prefixed by `api` and the API version number like so `v1`.

Do not forget to set the `X-Requested-With` header to `XMLHttpRequest`. Otherwise, Laravel won't recognize the call as an AJAX request.

To list all the available routes for API :

```bash
$ artisan route:list --path=api
```

## Contributing

Do not hesitate to contribute to the project by adapting or adding features ! Bug reports or pull requests are welcome.

## License

This project is released under the [MIT](http://opensource.org/licenses/MIT) license.
