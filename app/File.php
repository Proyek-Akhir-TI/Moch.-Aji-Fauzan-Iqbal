<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class File extends Model
{
    protected $table = 'files';
    protected $fillable = [
        'file', 'id_usulan'
    ];

    public static function get_by_id($id){
        return DB::table('files')
                ->select('*')
                ->where('id_usulan',$id);
    }
}
