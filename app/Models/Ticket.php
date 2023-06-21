<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'tic_name',
        'details',
        'user_id',
        'status_id',
        
    ];
    protected $casts = [
        'created_at' => 'datetime',
    ];

    //poveznica s client - > 1 client many tickets
    public function client(){
        return $this->belongsTo(Client::class);
    }

    //poveznica s user -> 1 user many tickets       
    public function user(){
        return $this->belongsTo(User::class);
    }

    //poveznica s comment -> 1 ticket many comments
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }
}
