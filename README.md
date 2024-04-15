<p align="center">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">

<img src="https://filamentphp.com/build/assets/rocket-0d392ed0.webp" alt="Banner" style="width: 100%; max-width: 80px;" />
</p>
<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel & Filament

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and
creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in
many web projects, And Filament is A collection of beautiful full-stack components. The perfect starting point for your
next app.

### External & Plugin Links

* [https://github.com/filamentphp/filament](https://github.com/filamentphp/filament)
* [https://github.com/bezhanSalleh/filament-shield](https://github.com/bezhanSalleh/filament-shield)
* [https://github.com/hasnayeen/themes](https://github.com/hasnayeen/themes)
* [https://blade-ui-kit.com/blade-icons](https://blade-ui-kit.com/blade-icons)

### How to Install - Part 1 Migrate

```
composer dump && php artisan db:wipe && php artisan migrate && php artisan db:seed
```

### How to Install - Part 2 Make New User

```
php artisan make:filament-user
```

### How to Install - Part 3 Set Shield (Roles/Permission)

```
php artisan shield:install && php artisan shield:super-admin
```

## How to generate CRUD instant!

In order to generate new resource (crud) simply set migration and set model with

```
php artisan make:migration create_model_name_table
```

and then

```
php artisan make:model NewModelName
```

After migration and model setup succesfully, simply create your resource

```
php artisan make:filament-resource --simple --generate --soft-deletes
```

each option are :

* --simple : make your crud table in simple mode using form modal
* --generate : filament generate auto table field detect from created model before
* --soft-deletes : enable soft delete method

Refresh your cms page, and you good to go, for more setup information, please
use [filament version 3 documentation](https://filamentphp.com/docs/3.x/panels/installation)

#### Happy Coding :)
