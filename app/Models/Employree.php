<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employree extends Model
{
    use HasFactory;
    protected $table = "employ";

    protected $fillable = ['name','email','address','image'];
}
