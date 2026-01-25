<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koin extends Model
{

    use HasFactory;

    protected $table = 'koins';

    public function outlet()
    {
        return $this->belongsTo(SerbuUser::class, 'outlet_id', 'outlet_id');
    }

    protected $primaryKey = 'outlet_id';
    public $incrementing = false;

    protected $fillable = [
        'brand',
        'koin'
    ];

}
