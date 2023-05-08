<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    // poveznica s ticket 1 ticket many comments
    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }

}

