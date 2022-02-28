<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buildingtype extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    protected $primaryKey = 'bdt_id';
}
