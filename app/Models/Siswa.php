<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    
    public function penduduk()
    {
        return $this->hasMany(Input_Aspirasi::class);
    }
}
