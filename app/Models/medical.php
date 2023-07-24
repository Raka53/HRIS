<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medical extends Model
{
    use HasFactory;
    public $table = "medical_claim";
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
    public function status_kry()
    {
        return $this->belongsTo(status_kry::class, 'status_id');
    }
}
