<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medical extends Model
{
    use HasFactory;
    public $table = "medical_claim";
    protected $guarded = ['id', 'timestamps'];
    public function hrd()
    {
        return $this->belongsTo(hrd::class, 'hrd_id');
    }
    public function patients()
    {
        return $this->hasMany(medical::class, 'hrd_id'); // Replace 'medical' with the actual model name.
    }
}
