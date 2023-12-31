<?php

namespace App\Models;

use App\Traits\HasUuids;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, HasUuids, Notifiable, SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'id' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'hashed'
    ];

    public function token() {
        return $this->hasOne(RequestToken::class, 'user_id');
    }

    public function profile() {
        return $this->hasOne(Profile::class, 'user_id');
    }

    public function roles() {
        return $this->belongsToMany(Role::class, 'roles_and_users')->orderBy('roles.name')->withPivot(['expired_at']);
    }

    public function hasRole($id) {
        if (!is_array($id)) { $id = [$id]; }
        return $this->roles()->whereIn('role_id', $id)->exists();
    }

    public function menu() {
        return $this->hasManyThrough(Role::class, Menu::class);
    }

    public function hasMenu($id) {
        if (!is_array($id)) { $id = [$id]; }
        return $this->menu()->whereIn('menu_id', $id)->exists();
    }

    /*
    public function sendEmailVerificationNotification() {
        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $this->getKey(),
                'hash' => sha1($this->getEmailForVerification())
            ],
            false
        );
        SendVerification::dispatch($this, $url);
    }
    */
}
