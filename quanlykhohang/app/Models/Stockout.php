<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stockout extends Model
{
    use HasFactory;

    protected $table ="stockouts";
    protected $primaryKey="STOUT_ID";
    public $timestamps=false;

    public function customer(){
        return $this->belongsTo(Customer::class,'CUS_ID','CUS_ID');
    }
    public function warehouse(){
        return $this->belongsTo(Warehouse::class,'WAR_ID','WAR_ID');
    }
    public function stockoutdetail(){
    return $this->hasMany(StockoutDetail::class,'STOUT_ID','STOUT_ID');
    }
    public function employee(){
        return $this->belongsTo(Employee::class,'EMP_ID','EMP_ID');
    }
}