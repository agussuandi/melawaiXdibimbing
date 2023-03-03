<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrxHSalesOrder extends Model
{
    use HasFactory;

    protected $table = 'trx_h_sales_order';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    protected $guarded = ['id'];

    // ->orWhere('employment_status', 'like', "%" . $search . "%")

    public function salesOrderDetail(Type $var = null): HasMany
    {
        return $this->hasMany(TrxDSalesOrder::class, 'so_h_id', 'id');
    }
}
