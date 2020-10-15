<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'contract_num','customer_id','plan_id','contract_date','contract_amount',
        'notes', 'active'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

}
