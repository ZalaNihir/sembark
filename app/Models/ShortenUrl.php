<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShortenUrl extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id','short_code','original_url','counts'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
