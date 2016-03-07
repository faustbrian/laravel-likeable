<?php

/*
 * This file is part of Laravel Likeable.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Likeable\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Counter.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
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
    public function likeable()
    {
        return $this->morphTo();
    }
}
