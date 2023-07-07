<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status_kry extends Model
{
    use HasFactory;
    public $table = "status_kry";
    protected $guarded = ['id', 'timestamps'];
    public function hrd()
    {
        return $this->hasMany(hrd::class);
    }
}
