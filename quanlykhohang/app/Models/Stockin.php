<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stockin extends Model
{
    use HasFactory;
    protected $table ="stockins";
    protected $primaryKey="STIN_ID";
    public $timestamps=false;

    public function supplier(){
        return $this->belongsTo(Supplier::class,'SUPP_ID','SUPP_ID');
    }
    public function stockindetail(){
        return $this->hasMany(Stockindetail::class,'STIN_ID','STIN_ID');
    }
    public function employee(){
        return $this->belongsTo(Employee::class,'EMP_ID','EMP_ID');
    }
}