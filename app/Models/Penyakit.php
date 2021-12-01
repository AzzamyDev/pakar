<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    use HasFactory;
    //variable $table untuk set ke table yg d tuju
    protected $table = 'penyakit';

    protected $guarded = ['id'];

    public $timestamps = false;
}
