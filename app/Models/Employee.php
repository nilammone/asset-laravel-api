<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    // set timestamps
    public $timestamps = false;

    // set name primary key id
    protected $primaryKey = 'emp_id';
}
