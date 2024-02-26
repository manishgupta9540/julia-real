<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorye extends Model
{
    use HasFactory,SoftDeletes;

    protected $guard = 'categoryes';

    protected $dates = ['deleted_at'];
}
