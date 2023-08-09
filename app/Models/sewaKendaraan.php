<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class sewaKendaraan extends Model
{
    use HasFactory, SoftDeletes;
    public $table = "sewa_kendaraan";
    protected $guarded = ['id', 'timestamps'];
    protected $dates = ['deleted_at'];
    public function hrd()
    {
        return $this->belongsTo(hrd::class);
    }
    public function gaji(){
        return $this->belongsTo(gaji::class,'hrd_id');
    }
}
