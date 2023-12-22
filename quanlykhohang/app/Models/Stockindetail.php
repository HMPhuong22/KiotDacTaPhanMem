<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stockindetail extends Model
{
    use HasFactory;

    protected $table = 'stockindetails';
    protected $primaryKey="IND_ID";
    public $timestamps=false;

    public function stockin(){
        return $this->belongsTo(Stockin::class,'STIN_ID','STIN_ID');
    }
    public function product(){
        return $this->belongsTo(Product::class,'PRO_ID','PRO_ID');
    }
}