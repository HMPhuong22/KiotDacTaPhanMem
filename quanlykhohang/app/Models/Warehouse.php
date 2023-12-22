<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $table = "warehouses";
    protected $primaryKey = "WAR_ID";
    public $timestamps = false;
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'WAR_ID', 'WAR_ID');
    }
}
