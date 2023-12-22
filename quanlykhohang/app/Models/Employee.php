<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = "employees";
    protected $primaryKey = "EMP_ID";
    public $timestamps = false;
    // protected $fillable = [
    //     'EMP_ID',
    //     'WAR_ID',
    //     'LASTNAME',
    //     'FIRSTNAME',
    //     'BIRTHDAY',
    //     'PHONE',
    //     'ADDRESS',
    //     'CCCD',
    //     'POSITIONS',
    //     // Thêm trường 'username' vào danh sách fillable
    // ];
    public function user()
    {
        return $this->hasMany(User::class, 'EMP_ID', 'EMP_ID');
    }
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'WAR_ID', 'WAR_ID');
    }
    public function stockin(){
        return $this->hasMany(Stockin::class, 'EMP_ID','EMP_ID');
    }
    public function stockout(){
        return $this->hasMany(Stockin::class, 'EMP_ID','EMP_ID');
    }
}