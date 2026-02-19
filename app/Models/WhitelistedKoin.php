<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhitelistedKoin extends Model
{
    protected $table = 'whitelisted_koins';

    public function outlet()
    {
        return $this->belongsTo(SerbuUser::class, 'outlet_id', 'outlet_id');
    }
}
