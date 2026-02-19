<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedeemKoin extends Model
{
    protected $table = 'redeem_koins';

    public function outlet()
    {
        return $this->belongsTo(SerbuUser::class, 'outlet_id', 'outlet_id');
    }

    public function Koin()
    {
        return $this->hasMany(Koin::class, 'outlet_id', 'outlet_id');
    }

    protected $primaryKey = 'outlet_id';
    public $incrementing = false;

    protected $fillable = ['outlet_id', 'brand', 'msisdn', 'redeem_koin'];

}
