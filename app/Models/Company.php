<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    protected $table = "companies";

    protected $fillable = [
        'name','description','address','phone','email','user_id','database_name'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function subUsers()
    {
        return $this->hasMany(User::class, 'parent_id', 'user_id');
    }


    public function urls()
    {
        return $this->hasManyThrough(
            ShortenUrl::class,
            User::class,
            'id',
            'user_id',
            'user_id',
            'id'
        );
    }

}
