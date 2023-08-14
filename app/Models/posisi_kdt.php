<?php

namespace App\Models;

use App\Http\Controllers\KandidatController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class posisi_kdt extends Model
{
    use HasFactory;
    public $table = "posisi_kdt";
    protected $guarded = ['id', 'timestamps'];
    public function kandidat()
    {
        return $this->belongsTo(kandidat::class);
    }
}
