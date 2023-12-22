<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categorys";
    protected $primaryKey = "CATE_ID";

    public $timestamps = false;

    public function product()
    {
        return $this->hasMany(Product::class, 'CATE_ID', 'CATE_ID');
    }
}