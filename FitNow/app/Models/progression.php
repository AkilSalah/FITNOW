<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progression extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'poids',
        'Mollet',
        'Bras',
        'TempsDeCourse',
        'PoidsLeve',
        'Hauteur',
        'Poitrine',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
