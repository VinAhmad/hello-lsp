<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Input\Input;

class Aspirasi extends Model
{
    use HasFactory;

    protected $guarded=['id'];
    protected $fillable=['IdLaporan','IdKategori'];



    public function input_aspirasi()
    {
        return $this->belongsTo(Input_Aspirasi::class,'IdLaporan');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class,'IdKategori');
    }
    
}
