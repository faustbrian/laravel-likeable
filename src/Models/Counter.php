<?php

namespace DraperStudio\Likeable\Models;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $table = 'likes_counter';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function likeable()
    {
        return $this->morphTo();
    }
}
