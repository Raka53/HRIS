<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sewaKendaraan extends Model
{
    use HasFactory;
    public $table = "sewa_kendaraan";
    protected $guarded = ['id', 'timestamps'];
    public function hrd()
    {
        return $this->belongsTo(hrd::class);
    }
}
