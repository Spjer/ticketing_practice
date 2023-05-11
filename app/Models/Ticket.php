<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    //poveznica s client - > 1 client 1 tickets
    public function client(){
        return $this->hasOne(Client::class);
    }

    //poveznica s user -> 1 user many tickets       mozda nepotrebno posto user_id nije foreign key -> jos provjerit
    public function user(){
        return $this->belongsTo(User::class);
    }

    //poveznica s comment -> 1 ticket many comments
    public function comments(){
        return $this->hasMany(comment::class);
    }

    //poveznica s status -> 1 status many ticket
    //public function status(){
    //    return $this->belongsTo(Status::class);
    //}
}
