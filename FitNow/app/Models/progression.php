<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class progression extends Model
{
    use HasFactory;
    protected $fillable = [
        'userId',
        'poids',
        'mensurations',
        'performanceSportive',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class,'userId');
    }
}
