<?php

/*
 * This file is part of Laravel Likeable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

/*
 * This file is part of Laravel Likeable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Likeable\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface HasLikes
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
