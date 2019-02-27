<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_unit';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    public function getAllUnit(){
        $listArr=array();
        $modelObj = Unit::where('status','=','1')->get();
        foreach ($modelObj as $obj) {
            $listArr[$obj->id]=$obj->name;
        }
        return $listArr;
    }
    
}
