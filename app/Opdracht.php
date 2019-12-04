<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opdracht extends Model
{

    protected $table = 'opdracht';
    public $timestamps = true;
    protected $fillable = array('title', 'description_id', 'start_date', 'end_date', 'klant_id');
    protected $visible = array('id','title', 'description_id', 'start_date', 'end_date', 'klant_id');

    public function Description()
    {
        return $this->belongsTo('App\Description');
    }

    public function Users()
    {
        return $this->belongsToMany('App\Users', 'user-opdracht');
    }

}
