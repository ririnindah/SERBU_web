<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LowProductivity extends Model
{
    use HasFactory;

    protected $table = 'low_productivity';

    public function outlet()
    {
        return $this->belongsTo(SerbuUser::class, 'outlet_id', 'outlet_id');
    }

        public function Target()
    {
        return $this->belongsTo(Target::class, 'uuid', 'uuid');
    }

    protected $primaryKey = 'outlet_id';
    public $incrementing = false;

    protected $fillable = [
        'outlet_name',
        'brand',
        'actual',
        'flag_mission',
        'mission_status'
    ];
}
