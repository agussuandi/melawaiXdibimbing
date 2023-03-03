<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MMaterial extends Model
{
    use HasFactory;

    protected $table = 'm_materials';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    protected $guarded = ['id'];
}
