<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhonePe extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'order_id',
        'amount',
        'status'
    ];
}
