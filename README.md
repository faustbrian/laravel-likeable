# Laravel Likeable

## Installation

First, pull in the package through Composer.

```js
composer require draperstudio/laravel-likeable:1.0.*@dev
```

And then include the service provider within `app/config/app.php`.

```php
'providers' => [
    DraperStudio\Likeable\ServiceProvider::class
];
```

At last you need to publish and run the migration.

```
php artisan vendor:publish --provider="DraperStudio\Likeable\ServiceProvider" && php artisan migrate
```

-----

### Setup a Model
```php
<?php

namespace App;

use DraperStudio\Likeable\Contracts\Likeable;
use DraperStudio\Likeable\Traits\Likeable as LikeableTrait;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements Likeable
{
    use LikeableTrait;
}

```

### Post Model gets liked by User Model
```php
$post->like($user);
```

### Post Model gets disliked by User Model
```php
$post->dislike($user);
```

### Count all likes
```php
$post->likeCount;
```

### Collection of all likes
```php
$post->likes;
```

### Check if the Post Model is currently liked by the User Model
```php
$post->liked($user);
```

### Load posts that are currently liked by the User Model
```php
Post::whereLiked($user)->get();
```

### Count likes the Post Model has
```php
$post->getLikeCount();
```

### Count likes the Post Model has for a specific date
```php
$post->getLikeCountByDate('2015-06-30');
```

### Count likes the Post Model has between two dates
```php
$post->getLikeCountByDate('2015-06-30', '2015-06-31');
```
