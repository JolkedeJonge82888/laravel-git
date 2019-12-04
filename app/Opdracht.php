<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opdracht extends Model
{

    protected $table = 'opdracht';
    public $timestamps = false;
    protected $fillable = array('title', 'description_id', 'start-date', 'end-date', 'klant-id');
    protected $visible = array('title', 'description_id', 'start-date', 'end-date', 'klant-id');

    public function Description()
    {
        return $this->belongsTo('App\Description');
    }

    public function Users()
    {
        return $this->belongsToMany('App\Users', 'user-opdracht');
    }

}
