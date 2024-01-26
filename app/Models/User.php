<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'user';

    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'login',
        'password',
        'telephone',
        'photo_file',
        'role_id',
    ];

    public function login(){
        $this->api_token = Hash::make(Str::random());
        $this->save();

        return $this->api_token;
    }

    public function logout() {
        $this->api_token = null;
        $this->save();
    }

    public function hasRole($roles) {
        return in_array($this->role->code, $roles);
    }

    public function role() {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
