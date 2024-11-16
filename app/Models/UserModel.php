<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
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

    protected $fillable = ['username', 'nama', 'password', 'level_id'];

    public function level(): BelongsTo {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    public function stok(): HasMany{
        return $this->hasMany(StokModel::class);
    }

    public function penjualan(): HasMany {
        return $this->hasMany(PenjualanModel::class);
    }


}
