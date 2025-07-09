<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'email',
        'due_date',
        'email_sent'
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'email_sent' => 'boolean'
    ];

    public function emailLogs()
    {
        return $this->morphMany(EmailLog::class, 'emailable');
    }
}
