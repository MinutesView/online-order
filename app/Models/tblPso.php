<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblPso extends Model
{
    use HasFactory;
    protected $primaryKey = "psocode";


    public function customers(){
        return $this->hasMany(tblCustomer::class);
    }

    
}
