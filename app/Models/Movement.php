<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;

    protected $table = 'movements';

    protected $fillable = [
        'user_id',
        'movement_type_id',
        'movement_id',
        'value'
    ];

    public function movement_type()
    {
        return $this->belongsTo(MovementType::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function movement()
    {
        return $this->belongsTo(Movement::class);
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

