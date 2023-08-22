<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class medical extends Model
{
    use HasFactory, SoftDeletes;
    public $table = "medical_claim";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'hrd_id',
        'status_id',
        'patient',
        'date_claim',
        'date',
        'doctor_fee',
        'obat',
        'kacamata',
        'Total',
        'foto',
        'deleted_at',
    ];


    public function hrd()
    {
        return $this->belongsTo(hrd::class, 'hrd_id');
    }
    public function patients()
    {
        return $this->hasMany(medical::class, 'hrd_id'); // Replace 'medical' with the actual model name.
    }
    public function gaji()
    {
        return $this->belongsTo(medical::class, 'medical_id');
    }
}
