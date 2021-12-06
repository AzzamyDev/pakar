<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;
    //variable $table untuk set ke table yg d tuju
    protected $table = 'riwayat';

    protected $guarded = ['id'];

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'id_penyakit')->withDefault();
    }
}
