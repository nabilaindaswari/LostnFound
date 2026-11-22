<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;

    // Mass assignment
    protected $fillable = ['code', 'name'];
    
    
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    } 
}
