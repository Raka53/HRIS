<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hrd extends Model
{
    use HasFactory;
    public $table = "hrd";
    protected $guarded = ['id', 'timestamps'];
}
