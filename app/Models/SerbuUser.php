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

    public function Ono()
    {
        return $this->hasMany(Ono::class, 'outlet_id', 'outlet_id');
    }

    public function Koin()
    {
        return $this->hasMany(Koin::class, 'outlet_id', 'outlet_id');
    }

    protected $primaryKey = 'outlet_id';
    public $incrementing = false;

    protected $fillable = [
        'outlet_name',
        'brand',
        'hit'
    ];
}
