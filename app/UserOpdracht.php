<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOpdracht extends Model 
{

    protected $table = 'user-opdracht';
    public $timestamps = false;
    protected $fillable = array('user-id', 'opdracht-id');
    protected $hidden = array('user-id', 'opdracht-id');

}