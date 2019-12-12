<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Team;
use App\Opdracht;

class Users extends Model
{
    protected $table = 'users';

    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at',
    ];

    public function Team()
    {
        return $this->belongsToMany(Team::class, 'team-user');
    }

    public function Opdracht()
    {
        return $this->belongsToMany(Opdracht::class, 'user-opdracht');
    }
}
