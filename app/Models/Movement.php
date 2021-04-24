<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;

    protected $table = 'movements';

    protected $fillable = [
        'type'
    ];

    public function movementType()
    {
        return $this->hasOne(MovementType::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function movement()
    {
        return $this->hasOne(Movement::class);
    }

    public function register($request)
    {
        
        $this->user_id = $request->user_id;
        $this->movement_type_id = $request->movement_type_id;        
        if($request->movement_id)
        {
            $this->movement_id = $request->movement_id;
        } 
        $this->value = $request->value;
                
        return $this->save();

    }

}

