<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Team;

class Users extends Model
{
    protected $table = 'users';



    public function Team()
    {
        return $this->belongsToMany(Team::class, 'team-user');
    }
}
