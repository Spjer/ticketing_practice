<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comm',
        'ticket_id',
    ];
    protected $casts = [
        'created_at' => 'datetime',
    ];

    // poveznica s ticket 1 ticket many comments
    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }

}

