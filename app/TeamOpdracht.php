<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamOpdracht extends Model
{

    protected $table = 'team-opdracht';
    public $timestamps = true;
    protected $fillable = array('team_id', 'opdracht_id', 'start_date', 'end_date', 'point');
    protected $visible = array('team_id', 'opdracht_id', 'start_date', 'end_date', 'point');

}
