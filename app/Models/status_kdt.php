<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status_kdt extends Model
{
    use HasFactory;
    public $table = "status_kdt";
    protected $guarded = ['id', 'timestamps'];
    public function kandidat()
    {
        return $this->belongsTo(kandidat::class);
    }
}
