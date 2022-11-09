<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    public $timestamps = false; //Default
    protected $fillable = [ // Name of table
        'admin_email', 'admin_pass', 'admin_name', 'admin_phone'
    ];
    protected $primaryKey = 'admin_id'; //Key of table
    protected $table = 'tbl_admin'; //Name of table

    public static function check_login($admin_email, $admin_pass){
        $result = Login::where('admin_email', $admin_email)->where('admin_pass', $admin_pass)->first();
        return $result;
    }
}
