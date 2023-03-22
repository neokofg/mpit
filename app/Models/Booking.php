<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'date',
        'peoples',
        'tourbase_id',
        'status'
    ];
    protected $table = 'booking';
}
