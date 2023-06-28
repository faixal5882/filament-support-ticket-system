<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'comment',
        'user_id',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
