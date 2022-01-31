<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblCustomer extends Model
{
    use HasFactory;
    protected $primaryKey = "customerCode";


    public function pso(){
        return $this->belongsTo(tblPso::class);
    }
}
