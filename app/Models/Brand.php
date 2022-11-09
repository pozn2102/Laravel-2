<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps = false; //Default
    protected $fillable = [ // Name of table
        'brand_name', 'branch_desc', 'meta_keywords' ,'brand_status'
    ];
    protected $primaryKey = 'brand_id'; //Key of table
    protected $table = 'tbl_brand'; //Name of table


}
