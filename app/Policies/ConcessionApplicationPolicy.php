<?php

namespace App\Policies;

use App\Models\ConcessionApplication;
use App\Models\User;

class ConcessionApplicationPolicy
{
    public function view(User $user, ConcessionApplication $application): bool
    {
        return $application->user_id === $user->id
            || $user->hasPermission('concessions.view_all')
            || $user->hasRole('admin');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('concessions.apply')
            || $user->hasRole('public')
            || $user->hasRole('staff');
    }

    public function update(User $user, ConcessionApplication $application): bool
    {
        $statusCode = $application->status?->code;

        return (($application->user_id === $user->id) && in_array($statusCode, ['pending', 'submitted'], true))
            || $user->hasPermission('concessions.review')
            || $user->hasRole('reviewer');
    }

    public function submit(User $user, ConcessionApplication $application): bool
    {
        return $application->user_id === $user->id && ($application->status?->code === 'pending');
    }

    public function approve(User $user, ConcessionApplication $application): bool
    {
        return $user->hasPermission('concessions.approve') || $user->hasRole('approver');
    }

    public function reject(User $user, ConcessionApplication $application): bool
    {
        return $this->approve($user, $application);
    }
}
