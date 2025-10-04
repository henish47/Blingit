<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'reply',
        'replied_at',
        'replied_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'replied_at' => 'datetime',
    ];

    /**
     * Check if the message has been replied to.
     */
    public function isReplied(): bool
    {
        return !is_null($this->reply);
    }

    /**
     * Mark the message as replied.
     */
    public function markAsReplied(string $reply, string $repliedBy): void
    {
        $this->update([
            'reply' => $reply,
            'replied_at' => now(),
            'replied_by' => $repliedBy,
        ]);
    }
}
