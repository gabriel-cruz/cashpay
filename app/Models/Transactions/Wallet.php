<?php

namespace App\Models\Transactions;

use App\Models\User;
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
}
