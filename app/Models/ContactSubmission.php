<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    /** @use HasFactory<\Database\Factories\ContactSubmissionFactory> */
    use HasFactory;

    protected $fillable = [
        'form_type',
        'name',
        'email',
        'phone',
        'message',
        'data',
        'ip_address',
        'user_agent',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }

    public function scopeNew(Builder $query): Builder
    {
        return $query->where('status', 'new');
    }

    public function scopeFormType(Builder $query, string $type): Builder
    {
        return $query->where('form_type', $type);
    }

    public function markAsRead(): void
    {
        $this->update(['status' => 'read']);
    }

    public function markAsResponded(): void
    {
        $this->update(['status' => 'responded']);
    }
}
