<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table="suppliers";
    protected $primaryKey="SUPP_ID";

    
    public $timestamps=false;
    public function stockin(){
        return $this->hasMany(Stockin::class, 'SUPP_ID','SUPP_ID');
    }
}