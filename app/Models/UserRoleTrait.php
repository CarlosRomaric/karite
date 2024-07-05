<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait UserRoleTrait
{
    /**
     * User roles
     *
     * @return BelongsToMany
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Check if user as role
     *
     * @param array $roles
     * @return bool
     */
    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            $user = $this ?: auth()->user();
            if (in_array($role, $user->roles()->pluck('name')->toArray())) {
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the user may perform the given permission.
     *
     * @param  Permission $permission
     * @return boolean
     */
    public function hasPermissionTo(Permission $permission)
    {
        return $this->hasPermissionThroughRole($permission);
    }

    /**
     * @param $permission
     * @return bool
     */
    protected function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role) {
            if (in_array($role->id, $this->roles()->pluck('id')->toArray())) {
                return true;
            }
        }
        return false;
    }

    /**
     * User has permission
     *
     * @param $permission
     * @return bool
     */
    protected function hasPermission($permission)
    {
        return (bool) $this->permissions()->where('name', $permission->name)->count();
    }

    /**
     * User permissions
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    /**
     * @return bool
     */
    public function isTraceAgriAdmin()
    {
        return self::hasRole('ADMINISTRATEUR TRACEAGRI');
    }

    /**
     * @return bool
     */
    public function isAgribusinessAdmin()
    {
        return self::hasRole('ADMINISTRATEUR COOPERATIVE');
    }

    /**
     * @return bool
     */
    public function isPlateformAdmin()
    {
        return self::hasRole('ADMINISTRATEUR PLATEFORME');
    }

    /**
     * @return bool
     */
    public function isMobile()
    {
        return self::hasRole('MOBILE');
    }

    public function isSupervisorAgribusiness()
    {
        return self::hasRole('SUPERVISEUR COOPERATIVE');
    }

    /**
     * @param Builder $builder
     */
    public function scopeRetrievingUsersByRoles(Builder $builder)
    {
        if (!$this->isTraceAgriAdmin() || !$this->isPlateformAdmin()) {
            $builder->where('agribusiness_id', '=', auth()->user()->agribusiness_id);
        }
    }

}
