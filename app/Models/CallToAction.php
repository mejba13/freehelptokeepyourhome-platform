<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallToAction extends Model
{
    /** @use HasFactory<\Database\Factories\CallToActionFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'description',
        'button_text',
        'button_url',
        'style',
        'icon',
        'status',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }
}
