<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
        );
    //Newsモデルに関連付ける    
    public function hostories(){
        return $this->hasMany('App/History');
    }
}
