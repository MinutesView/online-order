<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productOrder extends Model
{
    use HasFactory;
    
    protected $primaryKey = "orderNo";
    
    public function orderDetails(){
        return $this->hasMany(tblOrderDetails::class);
    }
}
