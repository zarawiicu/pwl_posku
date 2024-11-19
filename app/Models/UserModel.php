<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\LevelModel; // {{ edit_1 }}
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\StokModel;
use App\Models\PenjualanModel;

class UserModel extends Authenticatable implements JWTSubject
{
    use HasFactory;

    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    protected $fillable = ['username', 'nama', 'password', 'level_id', 'image'];

    public function level(): BelongsTo {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    public function stok(): HasMany{
        return $this->hasMany(StokModel::class);
    }

    public function penjualan(): HasMany {
        return $this->hasMany(PenjualanModel::class);
    }

    public function image(): Attribute {
        return Attribute::make(
            get: fn ($image) => $image ? url('/storage/uploads/' . $image) : null,
        );
    }

}
