<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'nim',
        'email',
        'phone',
        'role',
        'password',
        'banned_at',
        // 'email_verified_at',
        // 'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'banned_at' => 'datetime',

        ];
    }
    
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    } 
    public function claims(): HasMany
    {
        return $this->hasMany(Claim::class);
    } 
    public function isAdmin(): bool
    {
        return $this->role=== 'admin';
    } 
    public function isBanned(): bool
    {
        return ! is_null($this->banned_at);
    } 
}
