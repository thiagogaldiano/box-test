<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'name',
        'birthday',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function register($request)
    {
        
        $this->email = $request->email;
        $this->name = $request->name;
        $this->birthday = $request->birthday;
        $this->password = Hash::make($request->password);
        
        return $this->save();

    }

    public function deleteUser($userId)
    {
        return $this->find($userId)->delete();
    }

    public function movements()
    {
        return $this->belongsToMany(Movement::class);
    }

    public function editBalance($request)
    {
        
        $user = $this->find($request->user_id);
        $user->balance = $request->balance;
        $result = $user->save();
        
        return $result;

    }
    
}
