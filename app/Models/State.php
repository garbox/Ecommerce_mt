<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //
    public static function getAbb(){
        return State::all('abbreviation');
    }
}
