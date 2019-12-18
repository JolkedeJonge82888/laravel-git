<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gesprek extends Model
{

    protected $table = 'gesprek';
    public $timestamps = true;
    protected $fillable = array('team_id', 'opdracht_id', 'check');
    protected $visible = array('id','team_id', 'opdracht_id', 'check');

}
