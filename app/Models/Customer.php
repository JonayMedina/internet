<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'name','email','dni','phone','birthdate',
        'billing_date', 'active'
    ];

    protected $appends = ['last_pay'];

    public function contract()
    {
        return $this->hasOne(Contract::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    protected function getLastPayAttribute()
    {
        return $this->payment()->select('created_at')->orderBy('created_at','desc')->first();
    }

    
}
