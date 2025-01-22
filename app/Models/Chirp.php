<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\ChirpCreated;

class Chirp extends Model
{
    protected $fillable = [
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $dispatchesEvents = [
        'created' => ChirpCreated::class,
    ];
}
