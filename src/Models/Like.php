<?php

/*
 * This file is part of Laravel Likeable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Likeable\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

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
    public function likeable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return MorphTo
     */
    public function likedBy(): MorphTo
    {
        return $this->morphTo('liked_by');
    }

    /**
     * @param Model $likeable
     *
     * @return mixed
     */
    public static function count(Model $likeable): int
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
    public static function countByDate(Model $likeable, $from, $to = null): int
    {
        $query = $likeable->likes();

        if (!empty($to)) {
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
    public static function like(Model $likeable): bool
    {
        return (bool) (new static())->cast($likeable, 1);
    }

    /**
     * @param Model $likeable
     *
     * @return mixed
     */
    public static function dislike(Model $likeable): bool
    {
        return (bool) (new static())->cast($likeable, -1);
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
    protected function cast(Model $likeable, $value = 1): bool
    {
        if (!$likeable->exists) {
            return false;
        }

        $vote = new static();
        $vote->fill(compact('value'));

        return (bool) $vote->likeable()
            ->associate($likeable)
            ->save();
    }
}
