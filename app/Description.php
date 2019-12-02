<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description extends Model 
{

    protected $table = 'description';
    public $timestamps = false;
    protected $fillable = array('text');
    protected $visible = array('text');

}