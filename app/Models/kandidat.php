<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class kandidat extends Model
{
    use HasFactory, SoftDeletes;
    public $table = "kandidat";
    protected $guarded = ['id', 'timestamps'];
    public function posisiKdt()
    {
        return $this->hasOne(posisi_kdt::class);
    }
    public function statuskdt()
    {
        return $this->hasOne(status_kdt::class);
    }
}
