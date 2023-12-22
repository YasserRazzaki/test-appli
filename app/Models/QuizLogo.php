<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizLogo extends Model
{
    use HasFactory;

    protected $cast = [
        'proposition' => 'array'
    ];
protected $hidden = [
    "propositions"
];
    
}
