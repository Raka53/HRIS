<?php

namespace App\Models;
use App\Models\hrd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gaji extends Model
{
    use HasFactory;
    public $table = "gaji";
    protected $guarded = ['id', 'timestamps'];
    public function hrd()
    {
        return $this->belongsTo(hrd::class,'hrd_id');
    }
    public function status_kry()
    {
        return $this->belongsTo(status_kry::class, 'hrd_id');
    }
   
    public function medical()
    {
        return $this->belongsTo(medical::class, 'hrd_id');
    }
   
    public function sewa()
    {
        return $this->belongsTo(sewaKendaraan::class, 'hrd_id');
    }
   
}
