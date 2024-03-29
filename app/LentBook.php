<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LentBook extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'book_id', 'user_id'
    ];
}
