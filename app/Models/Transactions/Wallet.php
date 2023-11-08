<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'amount',
        'user_id',
    ];

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function user(){
        $this->belongsTo(User::class);
    }

    public function subtract($value){
        $this->update(['balance' => $this->attributes['balance'] - $value]);
    }

    public function deposit($value){
        $this->update(['balance' => $this->attributes['balance'] + $value]);
    }
}
