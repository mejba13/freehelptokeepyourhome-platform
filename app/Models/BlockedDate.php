<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BlockedDate extends Model
{
    protected $fillable = [
        'date',
        'reason',
        'is_recurring',
    ];

    protected $casts = [
        'date' => 'date',
        'is_recurring' => 'boolean',
    ];

    public static function isBlocked(Carbon $date): bool
    {
        // Check exact date
        $blocked = self::where('date', $date->format('Y-m-d'))->exists();

        if ($blocked) {
            return true;
        }

        // Check recurring dates (same month and day, any year)
        return self::where('is_recurring', true)
            ->whereMonth('date', $date->month)
            ->whereDay('date', $date->day)
            ->exists();
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('date', '>=', Carbon::today())->orderBy('date');
    }

    public function scopePast(Builder $query): Builder
    {
        return $query->where('date', '<', Carbon::today())->orderByDesc('date');
    }
}
