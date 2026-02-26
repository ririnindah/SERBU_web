<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incentive extends Model
{
    protected $table = 'icentives';

    public function outlet()
    {
        return $this->belongsTo(SerbuUser::class, 'outlet_id', 'outlet_id');
    }
}
