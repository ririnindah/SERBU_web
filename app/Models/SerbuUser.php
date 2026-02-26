<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class SerbuUser extends Authenticatable
{
    protected $table = 'serbu_users';

    public function LowStock()
    {
        return $this->hasMany(LowStock::class, 'outlet_id', 'outlet_id');
    }

    public function HighProductivity()
    {
        return $this->hasMany(HighProductivity::class, 'outlet_id', 'outlet_id');
    }

    public function LowProductivity()
    {
        return $this->hasMany(LowProductivity::class, 'outlet_id', 'outlet_id');
    }

    public function Koin()
    {
        return $this->hasMany(Koin::class, 'outlet_id', 'outlet_id');
    }

    public function Incentive()
    {
        return $this->hasMany(Incentive::class, 'outlet_id', 'outlet_id');
    }

    public function RedeemKoin()
    {
        return $this->hasMany(RedeemKoin::class, 'outlet_id', 'outlet_id');
    }

    public function WhitelistedKoin()
    {
        return $this->hasMany(WhitelistedKoin::class, 'outlet_id', 'outlet_id');
    }

    protected $primaryKey = 'outlet_id';
    public $incrementing = false;

    protected $fillable = [
        'outlet_name',
        'brand',
        'hit'
        // ,
        // 'region',
        // 'area',
        // 'branch'
    ];
}
