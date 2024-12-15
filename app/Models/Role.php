<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    // A role can belong to many users
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
