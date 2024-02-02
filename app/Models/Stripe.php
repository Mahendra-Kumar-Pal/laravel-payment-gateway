<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stripe extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',	
        'customer_id',	
        'card_id',	
        'user_id',	
        'amount',	
        'message',	
        'status',	
        'response',	
        'payment_datetime',
        'collective_id',	
        'team_id'
    ];
}
