<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offerte extends Model
{

    protected $table = 'offerte';
    public $timestamps = false;
    protected $fillable = array('team_id', 'opdracht_id', 'name');
    protected $visible = array('team_id', 'opdracht_id', 'name');

}
