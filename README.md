# Simple flag a model as approve or deny 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/adamhut/approvable.svg?style=flat-square)](https://packagist.org/packages/adamhut/approvable)
[![Build Status](https://img.shields.io/travis/adamhut/approvable/master.svg?style=flat-square)](https://travis-ci.org/adamhut/approvable)
[![Quality Score](https://img.shields.io/scrutinizer/g/adamhut/approvable.svg?style=flat-square)](https://scrutinizer-ci.com/g/adamhut/approvable)
[![Total Downloads](https://img.shields.io/packagist/dt/adamhut/approvable.svg?style=flat-square)](https://packagist.org/packages/adamhut/approvable)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require adamhut/approvable
```

## Usage

``` php

php artisan vendor:publish --provider="Adamhut\Approvable\ApprovableServiceProvider" --tag="migrations"

php artisan migrate

```

First, add the Adamhut\Approvable\Traits\Approvable trait to your User model(s):

```php

use Illuminate\Foundation\Auth\User as Authenticatable;
use Adamhut\Approvable\Traits\Approvable;

class User extends Authenticatable
{
    use Approvable;

    // ...
}

$user->isPending(); //true
$user->isApproved() //false
$user->isDenied();  //false

$user->approve();

$user->isApproved() //true
$user->isPending(); //false
$user->isDenied(); //false

$user->deny();
$user->isDenied()   //true
$user->isApproved() //false
$user->isPending(); //false


```

### Command
We alse provide a summery command

```php 
php artisan approval:summary

```


### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email adamhut@gmail.com instead of using the issue tracker.

## Credits

- [Adam Huang](https://github.com/adamhut)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
