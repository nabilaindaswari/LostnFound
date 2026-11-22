<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    // Mass assignment
    protected $fillable = ['type', 'user_id', 'category_id', 'location_id', 'name', 'description', 'location_detail', 'event_date', 'kept_by', 'photo', 'status',];
    protected $hidden = ['deleted_at'];
    // casts, untuk konversi tipe data 
    protected function casts(): array
    {
        return [
            'event_date' => 'date',
        ];
    }

    // Relasi
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function questions(): HasMany
    {
        return $this->hasMany(ItemQuestion::class);
    }

    public function claims(): HasMany
    {
        return $this->hasMany(Claim::class);
    }

}