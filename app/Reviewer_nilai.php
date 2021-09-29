<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviewer_nilai extends Model
{
    protected $fillable = ['abstrak','isi','kesimpulan','id_reviewer','id_usulan','rekomendasi'];
    protected $table = 'reviewer_nilai';
    public $timestamps = false;
}
