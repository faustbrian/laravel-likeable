<?php

namespace DraperStudio\Likeable\Contracts;

use Illuminate\Database\Eloquent\Model;

interface Likeable
{
    public function likes();

    public function likeCounter();

    public function getLikeCount();

    public function getLikeCountByDate($from, $to = null);

    public function getLikeCountAttribute();

    public function like(Model $likedBy);

    public function dislike(Model $likedBy);

    public function scopeWhereLiked($query, Model $model);
}
