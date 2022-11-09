<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Login;

class Social extends Model
{
    public $timestamps = false; //Default
    protected $fillable = [ // Name of table
        'provider_user_id', 'provider', 'user' 
    ];
    protected $primaryKey = 'user_id'; //Key of table
    protected $table = 'tbl_social'; //Name of table
    
    public function login(){
        return $this->belongsTo('App\Models\Login', 'user');
    }
}

