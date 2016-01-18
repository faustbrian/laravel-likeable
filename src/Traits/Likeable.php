<?php

namespace DraperStudio\Likeable\Traits;

use DraperStudio\Likeable\Models\Counter;
use DraperStudio\Likeable\Models\Like;
use Illuminate\Database\Eloquent\Model;

trait Likeable
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function likeCounter()
    {
        return $this->morphOne(Counter::class, 'likeable');
    }

    public function getLikeCount()
    {
        return $this->likeCount;
    }

    public function getLikeCountByDate($from, $to = null)
    {
        return Like::countByDate($this, $from, $to);
    }

    public function getLikeCountAttribute()
    {
        return $this->likeCounter ? $this->likeCounter->count : 0;
    }

    public function like(Model $likedBy)
    {
        if ($this->getLikedRecord($likedBy)) {
            return false;
        }

        $like = new Like();
        $like->liked_by_id = $likedBy->id;
        $like->liked_by_type = get_class($likedBy);
        $this->likes()->save($like);

        $this->incrementCounter();
    }

    public function dislike(Model $likedBy)
    {
        if (!$like = $this->getLikedRecord($likedBy)) {
            return false;
        }

        $like->delete();

        $this->decrementCounter();
    }

    public function scopeWhereLiked($query, Model $model)
    {
        return $query->whereHas('likes', function ($query) use ($model) {
            $query->where('liked_by_id', $model->id);
            $query->where('liked_by_type', get_class($model));
        });
    }

    private function incrementCounter()
    {
        if ($counter = $this->likeCounter()->first()) {
            $counter->increment('count', 1);
            $counter->save();
        } else {
            $counter = new Counter();
            $counter->fill(['count' => 1]);

            $this->likeCounter()->save($counter);
        }

        return $counter;
    }

    private function decrementCounter()
    {
        if ($counter = $this->likeCounter()->first()) {
            $counter->decrement('count', 1);
            $counter->count ? $counter->save() : $counter->delete();
        }

        return $counter;
    }

    public function getLikedRecord(Model $model)
    {
        return $this->likes()
                    ->where('liked_by_id', $model->id)
                    ->where('liked_by_type', get_class($model))
                    ->first();
    }

    public function liked(Model $model)
    {
        return (bool) $this->likes()
                           ->where('liked_by_id', $model->id)
                           ->where('liked_by_type', get_class($model))
                           ->count();
    }
}
