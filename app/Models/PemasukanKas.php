<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemasukanKas extends Model
{
    use HasFactory;
    protected $table = 'pemasukan_kas';
    protected $guarded = ["id"];
}
