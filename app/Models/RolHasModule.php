<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolHasModule extends Model
{

    protected $table = "roles_has_modules";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_rol',
        'id_module'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
