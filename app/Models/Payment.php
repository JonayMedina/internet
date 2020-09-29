<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'amount','payment_num','payment_date','payment_date','customer_id',
        'bank_id','billing_id','active'
    ];

    protected $casts = [
        'created_at' => 'datetime:H:i:s d/m/Y', // Change format
        'updated_at' => 'datetime:H:i:s d/m/Y',
        'deleted_at' => 'datetime:H:i:s d/m/Y',
    ];

    protected $date = ['delete_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function billing()
    {
        return $this->belongsTo(Billing::class);
    }

}
