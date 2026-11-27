<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;


class ItemQuestion extends Model
{
    use HasFactory;
    public $timestamps = false;
    // Mass assignment
    protected $fillable = ['item_id', 'order', 'question', 'option_a', 'option_b', 'option_c', 'correct_option'];

    protected $hidden = [
        'correct_option'
    ];

    // Relasi
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    } 

}
