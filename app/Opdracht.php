<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opdracht extends Model
{

    protected $table = 'opdracht';
    public $timestamps = true;
    protected $fillable = array('title', 'description_id', 'start_date', 'end_date');
    protected $visible = array('id','title', 'description_id', 'start_date', 'end_date');

    public function Description()
    {
        return $this->belongsTo(Description::class);
    }

    public function Users()
    {
        return $this->belongsToMany(Users::class, 'user-opdracht');
    }

    public function TeamOpdracht()
    {
        return $this->belongsToMany(Team::class, 'team-opdracht')->withPivot('id');
    }

    public function TeamGesprek()
    {
        return $this->belongsToMany(Team::class, 'gesprek')->withPivot('id');
    }

}
