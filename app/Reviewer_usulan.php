<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviewer_usulan extends Model
{
    protected $fillable = ['id_reviewer','id_usulan'];
    protected $table = 'reviewer_usulan';
    public $timestamps = false;
}
