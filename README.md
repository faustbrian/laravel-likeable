# Laravel Likeable

[![Build Status](https://img.shields.io/travis/faustbrian/Laravel-Likeable/master.svg?style=flat-square)](https://travis-ci.org/faustbrian/Laravel-Likeable)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/faustbrian/laravel-likeable.svg?style=flat-square)]()
[![Latest Version](https://img.shields.io/github/release/faustbrian/Laravel-Likeable.svg?style=flat-square)](https://github.com/faustbrian/Laravel-Likeable/releases)
[![License](https://img.shields.io/packagist/l/faustbrian/Laravel-Likeable.svg?style=flat-square)](https://packagist.org/packages/faustbrian/Laravel-Likeable)

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

``` bash
$ composer require faustbrian/laravel-likeable
```

To get started, you'll need to publish the vendor assets and migrate:

```
php artisan vendor:publish --provider="BrianFaust\Likeable\LikeableServiceProvider" && php artisan migrate
```

## Usage

### Setup a Model
``` php
<?php

namespace App;

use BrianFaust\Likeable\HasLikesTrait;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasLikesTrait;
}

```

### Post Model gets liked by User Model
``` php
$post->like($user);
```

### Post Model gets disliked by User Model
``` php
$post->dislike($user);
```

### Count all likes
``` php
$post->likeCount;
```

### Collection of all likes
``` php
$post->likes;
```

### Check if the Post Model is currently liked by the User Model
``` php
$post->liked($user);
```

### Load posts that are currently liked by the User Model
``` php
Post::whereLiked($user)->get();
```

### Count likes the Post Model has
``` php
$post->getLikeCount();
```

### Count likes the Post Model has for a specific date
``` php
$post->getLikeCountByDate('2015-06-30');
```

### Count likes the Post Model has between two dates
``` php
$post->getLikeCountByDate('2015-06-30', '2015-06-31');
```

## Testing

``` bash
$ phpunit
```

## Security

If you discover a security vulnerability within this package, please send an e-mail to hello@brianfaust.me. All security vulnerabilities will be promptly addressed.

## Credits

- [Brian Faust](https://github.com/faustbrian)
- [All Contributors](../../contributors)

## License

[MIT](LICENSE) © [Brian Faust](https://brianfaust.me)
