<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'slug', 'permissions',
    ];

    protected $cats = [
        'permissions'=> 'array'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_users');
    }

    public function hasAccess(array $permission) : bool
    {
        foreach ($permissions as $permission) {
            if($this->hasPermission($permission))
                return true;
        }

        return false;
    }

    private function hasPermission(String $permission) : bool
    {
        return $this->permission[$permission] ?? false;
    }
}
