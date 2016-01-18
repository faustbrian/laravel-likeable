<?php

namespace DraperStudio\Likeable\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function likeable()
    {
        return $this->morphTo();
    }

    public static function count(Model $likeable)
    {
        return $likeable->likes()
                        ->count();
    }

    public static function countByDate(Model $likeable, $from, $to = null)
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

    public static function like(Model $likeable)
    {
        return (new static())->cast($likeable, 1);
    }

    public static function dislike(Model $likeable)
    {
        return (new static())->cast($likeable, -1);
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = ($value == -1) ? -1 : 1;
    }

    protected function cast(Model $likeable, $value = 1)
    {
        if (!$likeable->exists) {
            return false;
        }

        $vote = new static();
        $vote->fill(compact('value'));

        return $vote->likeable()
                    ->associate($likeable)
                    ->save();
    }
}
