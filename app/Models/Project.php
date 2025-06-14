<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'title',
        'abstract',
        'leader',
        'organisation',
        'address',
        'email',
        'phone',
        'member1',
        'member2',
        'member3',
        'member4',
        'publication',
        'link',
        'award',
        'receipt',
        'status',
        'user_id',
        'category_id',
        'event_id'
    ];
}
