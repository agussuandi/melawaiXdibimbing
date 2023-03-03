<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MCustomerReceipt extends Model
{
    use HasFactory;

    protected $table = 'm_customer_receipts';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    protected $guarded = ['id'];

    public function customer(): HasOne
    {
        return $this->hasOne(MCustomer::class, 'id', 'customer_id');
    }
}
