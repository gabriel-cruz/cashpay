<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'sender',
        'receiver',
        'amount',
    ];

    public function sender(){
        return $this->belongsTo(Wallet::class, 'sender');
    }

    public function receiver(){
        return $this->belongsTo(Wallet::class, 'receiver');
    }
}
