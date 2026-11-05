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

    public function users(){
        return $this->belongsTo(User::class);
    }
}
