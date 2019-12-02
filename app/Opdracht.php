<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opdracht extends Model
{

    protected $table = 'opdracht';
    public $timestamps = false;
    protected $fillable = array('title', 'start-date', 'klant-id');
    protected $visible = array('title', 'start-date', 'klant-id');

    public function Description()
    {
        return $this->belongsTo('App\Description');
    }

    public function Users()
    {
        return $this->belongsToMany('App\Users', 'user-opdracht');
    }

}
