<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Cashier\Billable;
class User extends Authenticatable
{
    use Billable;
    //
    public static function create(Request $request){
        $this->insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => ucwords($request->city),
            'address' => ucwords($request->address),
            'zip' => $request->zip,
            'state' => $request->state 
        ]);
    }
    

    // A user can have many roles
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // Optionally, you can check if a user has a specific role
    public function hasRole($role)
    {
        return $this->roles->pluck('name')->contains($role);
    }
}
