<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Billing extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'invoice_num', 'customer_id', 'plan_id',
        'invoice_amount', 'cutt_off','date_payment','active'
    ];

    protected $dates =['deleted_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
