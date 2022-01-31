<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblProduct extends Model
{
    use HasFactory;
    protected $primaryKey = "productCode";
}
