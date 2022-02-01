<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    use HasFactory;

    //variable $table untuk set ke table yg d tuju
    protected $table = 'gejala';

    //berfungsi agar hanya field "id" saja yg tidak bsa di rubah
    protected $guarded = ['id'];

    //berfungsi untuk enabling timestamps created_at & updated_at
    public $timestamps = false;

    //berfungsi untuk memberitahu laravel bahwa field check itu boolean
    protected $casts = [
        'check' => 'boolean',
    ];

    public function penyakit()
    {
        return $this->belongsToMany(Penyakit::class)->withPivot('nilai_pakar');
    }
}
