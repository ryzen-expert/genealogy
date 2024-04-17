<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'is_paid',
        'is_active',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'timestamp',
        'end_date' => 'timestamp',
    ];
}
