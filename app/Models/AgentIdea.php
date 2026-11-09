<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentIdea extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'author',
        'nrp',
        'title',
        'category',
        'architecture',
        'target_user',
        'priority',
        'description',
        'tech_stack',
        'status',
    ];

    protected $casts = [
        'tech_stack' => 'array',
    ];
}
