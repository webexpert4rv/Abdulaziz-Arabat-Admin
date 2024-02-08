<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id', 
        'receiver_id', 
        'action_id',
        'title',
        'title_arabic', 
        'type', 
        'isRead',
        'description',
        'description_arabic'
    ];

    protected $casts=[

        'created_at' => 'datetime:d/m/Y H:00',
    ];



}

