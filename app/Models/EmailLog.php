<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipient',
        'subject',
        'content',
        'sent',
        'error',
        'emailable_id',
        'emailable_type'
    ];

    public function emailable()
    {
        return $this->morphTo();
    }
}
