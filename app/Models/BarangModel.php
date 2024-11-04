<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BarangModel extends Model
{
    use HasFactory;

    protected $table = 'm_barang';
    protected $primaryKey = 'barang_id';

    protected $fillable = ['kategori_id','barang_kode', 'barang_nama', 'harga_beli', 'harga_jual'];

    public function kategori(): BelongsTo {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'id');
    }

    public function stok() :HasMany
    {
        return $this->hasMany(UserModel::class);

    }
}
