<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Users;

class Team extends Model
{

    protected $table = 'team';
    public $timestamps = false;
    protected $fillable = array('name', 'point');
    protected $visible = array('id', 'name', 'point');

    public function Users()
    {
        return $this->belongsToMany(Users::class, 'team-user');
    }


    public function OpdrachtTeam()
    {
        return $this->belongsToMany(Opdracht::class, 'team-opdracht');
    }

    public function OpdrachtGesprek()
    {
        return $this->belongsToMany(Opdracht::class, 'gesprek');
    }

    public function Offerte()
    {
        return $this->belongsToMany(Opdracht::class, 'offerte');
    }

}
