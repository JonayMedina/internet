<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'name','slug','category_id','download','upload',
        'unit_dw','unit_up','cost', 'description',
        'promotion','active'
    ];

    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function contract()
    {
        return $this->hasMany(Contract::class);
    }
}
