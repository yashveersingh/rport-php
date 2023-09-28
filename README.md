# RPort Helper For Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/yashveersingh/rport-php.svg?style=flat-square)](https://packagist.org/packages/yashveersingh/rport-php)

[![Total Downloads](https://img.shields.io/packagist/dt/yashveersingh/rport-php.svg?style=flat-square)](https://packagist.org/packages/yashveersingh/rport-php)

## What It Does

This package allows you to sync devices from [RPort](https://apidoc.rport.io) and save it in database.

Installation:

``` bash
composer require yashveersingh/rport-php
```

After installing package run:

``` bash
php artisan rport:install
```

This will generate `rport.php` file in `config` directory.

``` PHP
<?php
return [
    'url' => env('rport_url', ''),
    'username' => env('rport_username', ''),
    'token' => env('rport_token', ''),
];
```

You need to override `url` `username` `token`

**Note**:  You need to have cron setup every minute.

``` bash
php artisan schedule:run
```

#### or

Manually run these command in order to fetch api key and devices

``` bash
php artisan rport:sync
```

If u need to sync immediately, You can run this command manually.

### Testing

``` bash
composer test
```

### Security

If you discover any security-related issues, please
email [yashveersingh444444@gmail.com](mailto:yashveersingh444444@gmail.com) instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.