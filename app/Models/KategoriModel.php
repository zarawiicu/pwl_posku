<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriModel extends Model
{
    use HasFactory;

    protected $table = 'm_kategori';
    protected $primarykey = 'kategori_id';

    protected $fillable = ['kategori_id','kategori_kode', 'kategori_nama'];

    public function getIdAttribute()
    {
        return strtoupper($this->attributes['id']);
    }

}
