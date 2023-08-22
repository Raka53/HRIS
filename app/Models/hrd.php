<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class hrd extends Model
{
    use HasFactory, SoftDeletes;
    public $table = "hrd";
    protected $guarded = ['id', 'timestamps'];
    protected $dates = ['deleted_at'];
    public function gaji()
    {
        return $this->hasOne(gaji::class);
    }
    public function sewa()
    {
        return $this->hasOne(sewaKendaraan::class, 'hrd_id');
    }
    public function medical()
    {
        return $this->hasMany(medical::class, 'hrd_id', 'id');
    }

}
