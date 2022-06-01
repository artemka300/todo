<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'done',
        'del',
        'create_date',
        'end_date',
        'plan_id',
    ];
}
