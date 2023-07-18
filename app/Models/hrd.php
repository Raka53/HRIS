<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hrd extends Model
{
    use HasFactory;
    public $table = "hrd";
    protected $guarded = ['id', 'timestamps'];
    public function gaji()
    {
        return $this->hasOne(gaji::class);
    }
    public function status_kry()
    {
        return $this->belongsTo(status_kry::class, 'status_id');
    }
    public function sewa_kendaraan()
    {
        return $this->hasOne(sewaKendaraan::class, 'hrd_id');
    }
    public function medical()
    {
        return $this->hasMany(medical::class, 'hrd_id');
    }

}
