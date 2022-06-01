<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'del',
        'img_id',
        'user_id',
    ];
    protected $with = ['img','tasks'];
    public function img()
    {
    return $this->hasOne(Img::class, 'id', 'img_id');
    }
    public function tasks(){
        return $this->hasMany(Task::class, 'plan_id', 'id');
    }
}
