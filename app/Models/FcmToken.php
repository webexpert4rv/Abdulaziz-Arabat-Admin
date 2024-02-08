<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FcmToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'token_type'
    ];

    public function tokenable()
    {
        return $this->morphTo();
    }
}
