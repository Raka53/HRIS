<?php

namespace App\Models;
use App\Models\hrd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class gaji extends Model
{
    use HasFactory, SoftDeletes;
    public $table = "gaji";
    protected $guarded = ['id', 'timestamps'];
    protected $dates = ['deleted_at'];
    public function hrd()
    {
        return $this->belongsTo(hrd::class,'hrd_id');
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
