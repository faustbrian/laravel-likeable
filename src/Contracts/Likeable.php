<?php

/*
 * This file is part of Laravel Likeable.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Likeable\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface Likeable.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
interface Likeable
{
    /**
     * @return mixed
     */
    public function likes();

    /**
     * @return mixed
     */
    public function likeCounter();

    /**
     * @return mixed
     */
    public function getLikeCount();

    /**
     * @param $from
     * @param null $to
     *
     * @return mixed
     */
    public function getLikeCountByDate($from, $to = null);

    /**
     * @return mixed
     */
    public function getLikeCountAttribute();

    /**
     * @param Model $likedBy
     *
     * @return mixed
     */
    public function like(Model $likedBy);

    /**
     * @param Model $likedBy
     *
     * @return mixed
     */
    public function dislike(Model $likedBy);

    /**
     * @param $query
     * @param Model $model
     *
     * @return mixed
     */
    public function scopeWhereLiked($query, Model $model);
}
