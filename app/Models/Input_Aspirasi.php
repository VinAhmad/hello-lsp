<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Input_Aspirasi extends Model
{
    use HasFactory;

    protected $guarded=['id'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class,'nis_f','nis');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class,'IdKategori');
    }
    
    public function aspirasi()
    {
        return $this->hasOne(Aspirasi::class);
    }
}
