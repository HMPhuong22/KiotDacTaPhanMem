<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stockoutdetail extends Model
{
    use HasFactory;
    protected $table ="stockoutdetails";
    protected $primaryKey="OUTD_ID";
    public $timestamps=false;

    public function product(){
        return $this->belongsTo(Product::class,'PRO_ID','PRO_ID');
    }
    public function stockout(){
        return $this->belongsTo(Stockout::class,'STOUT_ID','STOUT_ID');
    }
}