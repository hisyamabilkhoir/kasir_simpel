<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
