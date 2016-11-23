<?php

/*
 * This file is part of Laravel Likeable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Likeable;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * @var string
     */
    protected $table = 'likes';

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

    /**
     * @param Model $likeable
     *
     * @return mixed
     */
    public static function count(Model $likeable)
    {
        return $likeable->likes()
                        ->count();
    }

    /**
     * @param Model $likeable
     * @param $from
     * @param null $to
     *
     * @return mixed
     */
    public static function countByDate(Model $likeable, $from, $to = null)
    {
        $query = $likeable->likes();

        if (! empty($to)) {
            $range = [new Carbon($from), new Carbon($to)];
        } else {
            $range = [
                (new Carbon($from))->startOfDay(),
                (new Carbon($to))->endOfDay(),
            ];
        }

        return $query->whereBetween('created_at', $range)
                     ->count();
    }

    /**
     * @param Model $likeable
     *
     * @return mixed
     */
    public static function like(Model $likeable)
    {
        return (new static())->cast($likeable, 1);
    }

    /**
     * @param Model $likeable
     *
     * @return mixed
     */
    public static function dislike(Model $likeable)
    {
        return (new static())->cast($likeable, -1);
    }

    /**
     * @param $value
     */
    public function setValueAttribute($value)
    {
        $this->attributes['value'] = ($value == -1) ? -1 : 1;
    }

    /**
     * @param Model $likeable
     * @param int   $value
     *
     * @return bool
     */
    protected function cast(Model $likeable, $value = 1)
    {
        if (! $likeable->exists) {
            return false;
        }

        $vote = new static();
        $vote->fill(compact('value'));

        return $vote->likeable()
                    ->associate($likeable)
                    ->save();
    }
}
