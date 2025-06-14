<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'description', 
        'date_register_start',
        'date_register_end',
        'date_submission',
        'date_evaluate_start',
        'date_evaluate_end',
        'date_announcement',
        'date_ceremony'
    ];
}
