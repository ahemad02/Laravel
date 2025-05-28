<?php
namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Allow all users to view their own tasks.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Allow users to view their own tasks or admins to view any.
     */
    public function view(User $user, Task $task): bool
    {
        return $user->id === $task->user_id || $user->role === 'admin';
    }

    /**
     * Allow all authenticated users to create tasks.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Allow users to update their own tasks or admins.
     */
    public function update(User $user, Task $task): bool
    {
        return $user->id === $task->user_id || $user->role === 'admin';
    }

    /**
     * Allow users to delete their own tasks or admins.
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->id === $task->user_id || $user->role === 'admin';
    }

    /**
     * Allow only admins to restore.
     */
    public function restore(User $user, Task $task): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Allow only admins to permanently delete.
     */
    public function forceDelete(User $user, Task $task): bool
    {
        return $user->role === 'admin';
    }
}
