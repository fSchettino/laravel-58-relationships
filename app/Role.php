<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users() {
        // withPivot method tells Laravel about all additional data included in the pivot table and which can be retrieved
        return $this->belongsToMany(User::class)->withPivot(['name'])->withTimestamps();
    }
}
