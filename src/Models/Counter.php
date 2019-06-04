<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Likeable.
 *
 * (c) Brian Faust <hello@basecode.sh>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Artisanry\Likeable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Counter extends Model
{
    /**
     * @var string
     */
    protected $table = 'likes_counter';

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function likeable(): MorphTo
    {
        return $this->morphTo();
    }
}
