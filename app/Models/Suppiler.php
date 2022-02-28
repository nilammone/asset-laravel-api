<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppiler extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    protected $primaryKey = 'sp_id';
}
