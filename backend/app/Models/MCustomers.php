<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MCustomers extends Model
{
    use HasFactory;

    protected $table = 'm_customers';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    protected $guarded = ['id'];
    
    public $modelNotFoundMessage = "The user was not found";
}
