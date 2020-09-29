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

    public function contract()
    {
        return $this->hasOne(Contract::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
