<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bmi extends Model
{
    use HasFactory;
    protected $table = "bmi";
    protected $fillable = ['tinggi_badan', 'berat_badan', 'hasil_bmi', 'index_bmi'];
}
