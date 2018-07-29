<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{


    protected $fillable = [
        'amount',
        'user_id',
        'loan_intrest',
        'type',
        'duration',
        'status'

        ];

    public function users (){

        return $this->belongsTo(User::class, 'user_id');
    }
}
