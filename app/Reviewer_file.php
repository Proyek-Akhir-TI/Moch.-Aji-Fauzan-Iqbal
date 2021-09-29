<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reviewer_file extends Model
{
    protected $table = 'reviewer_files';
    protected $fillable = [
        'file', 'id_usulan', 'id_user'
    ];

    public static function get_by_id($id){
        return DB::table('files')
                ->select('*')
                ->where('id_usulan',$id);
    }
}
