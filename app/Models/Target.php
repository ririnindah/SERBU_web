<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    use HasFactory;

    protected $table = 'target'; // opsional

    public function LowStock()
    {
        return $this->hasMany(LowStock::class, 'uuid', 'uuid');
    }

    public function HighProductivity()
    {
        return $this->hasMany(HighProductivity::class, 'uuid', 'uuid');
    }

    public function LowProductivity()
    {
        return $this->hasMany(LowProductivity::class, 'uuid', 'uuid');
    }

    public function Ono()
    {
        return $this->hasMany(Ono::class, 'uuid', 'uuid');
    }

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $fillable = [
        'program',
        'brand',
        'target1',
        'incentive1',
        'target2',
        'incentive2',
        'target3',
        'incentive3',
        'target4',
        'incentive4',
        'target5',
        'incentive5',
        'target6',
        'incentive6',
        'target7',
        'incentive7'
    ];
}
