<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MCustomer extends Model
{
    use HasFactory;

    protected $table = 'm_customers';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    protected $guarded = ['id'];

    public function customerReceipts(): HasMany
    {
        return $this->hasMany(MCustomerReceipt::class, 'customer_id', 'id');
    }
}
