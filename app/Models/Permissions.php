<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Permissions extends Model
{
    use HasFactory;
    use HasRoles;


    protected $table = 'permissions';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'guard_name',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [];

    
    public function permissions_has_role()
    {
        return $this->belongsToMany(Role::class, 'role_has_permissions', 'permission_id');
    }
  

}
