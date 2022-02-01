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

    //relasi antar table
    //berfungsi merelasikan table penyakit dan riwayat
    public function penyakit()
    {
        return $this->hasMany(Riwayat::class, 'id_penyakit');
    }
    public function gejala()
    {
        return $this->belongsToMany(Gejala::class)->withPivot('nilai_pakar');
    }
}
