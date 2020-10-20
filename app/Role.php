<?php

namespace App;
use Silber\Bouncer\Database\Role as BouncerRole;
use Illuminate\Database\Eloquent\Model;

class Role extends BouncerRole
{
    protected $fillable = ['name', 'title', 'level', 'description'];
}
