<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table="products";
    protected $primaryKey="PRO_ID";
    public $timestamps=false;

    public function category(){
        return $this->belongsTo(Category::class,'CATE_ID','CATE_ID');
    }
    
}