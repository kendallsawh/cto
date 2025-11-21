<?php

namespace App\Support\Auth;

use Illuminate\Support\Collection;

trait HasRolesCompat
{
    protected ?Collection $cachedRoleNames = null;

    protected ?Collection $cachedPermissionNames = null;

    /**
     * Determine if the user has a given role.
     */
    public function hasRole(string $role): bool
    {
        return $this->resolveRoleNames()->contains(fn ($name) => $name === $role);
    }

    /**
     * Determine if the user has any of the provided roles.
     *
     * @param array<int, string>|string $roles
     */
    public function hasAnyRole(array|string $roles): bool
    {
        $roles = is_array($roles) ? $roles : [$roles];

        return $this->resolveRoleNames()->intersect($roles)->isNotEmpty();
    }

    /**
     * Determine if the user has a given permission.
     */
    public function hasPermission(string $permission): bool
    {
        if (method_exists($this, 'hasPermissionTo')) {
            try {
                return (bool) $this->hasPermissionTo($permission);
            } catch (\Throwable $e) {
                // Fall back to collection-based evaluation below.
            }
        }

        return $this->resolvePermissionNames()->contains(fn ($name) => $name === $permission);
    }

    /**
     * Determine if the user can perform an action by permission or role.
     */
    public function canDo(string $permissionOrRole): bool
    {
        return $this->hasPermission($permissionOrRole) || $this->hasRole($permissionOrRole);
    }

    /**
     * Get role names using available relationships or helpers, cached per request.
     */
    protected function resolveRoleNames(): Collection
    {
        if ($this->cachedRoleNames !== null) {
            return $this->cachedRoleNames;
        }

        if ($this->hasExternalMethod('getRoleNames')) {
            try {
                $names = collect($this->getRoleNames()->toArray());
                return $this->cachedRoleNames = $names->filter()->values();
            } catch (\Throwable $e) {
                // Fall back to relationship-based resolution.
            }
        }

        return $this->cachedRoleNames = $this->collectNamesFromRelation('roles');
    }

    /**
     * Get permission names using available relationships or helpers, cached per request.
     */
    protected function resolvePermissionNames(): Collection
    {
        if ($this->cachedPermissionNames !== null) {
            return $this->cachedPermissionNames;
        }

        if ($this->hasExternalMethod('getPermissionNames')) {
            try {
                $names = collect($this->getPermissionNames()->toArray());
                return $this->cachedPermissionNames = $names->filter()->values();
            } catch (\Throwable $e) {
                // Fall back to relationship-based resolution.
            }
        }

        return $this->cachedPermissionNames = $this->collectNamesFromRelation('permissions');
    }

    /**
     * Collect `name` attributes from a relationship if available.
     */
    protected function collectNamesFromRelation(string $relation): Collection
    {
        try {
            if ($this->relationLoaded($relation)) {
                $related = $this->getRelation($relation);
            } elseif (method_exists($this, $relation)) {
                $related = $this->{$relation}()->get();
            } else {
                return collect();
            }
        } catch (\Throwable $e) {
            return collect();
        }

        return collect($related)->map(fn ($model) => $model->name ?? null)->filter()->values();
    }

    /**
     * Check if a method exists externally to this trait.
     */
    protected function hasExternalMethod(string $method): bool
    {
        if (! method_exists($this, $method)) {
            return false;
        }

        $reflection = new \ReflectionMethod($this, $method);

        return $reflection->getDeclaringClass()->getName() !== __TRAIT__;
    }
}
