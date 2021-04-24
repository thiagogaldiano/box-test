<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovementType extends Model
{
    use HasFactory;

    protected $table = 'movement_types';

    protected $fillable = [
        'type'
    ];

    public function movements()
    {
        return $this->belongsToMany(Movements::class);
    }

}

