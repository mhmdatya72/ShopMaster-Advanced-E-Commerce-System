<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    /**
     * Get all users with pagination.
     */
    public function getAllUsers(int $perPage = 15, ?string $role = null): LengthAwarePaginator
    {
        $query = User::query();

        if ($role) {
            $query->where('role', $role);
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    /**
     * Get user by ID.
     */
    public function getUserById(string $id): ?User
    {
        return User::find($id);
    }

    /**
     * Get user by email.
     */
    public function getUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    /**
     * Create a new user.
     */
    public function createUser(array $data): User
    {
        // Hash password if provided
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Set default role if not provided
        if (!isset($data['role'])) {
            $data['role'] = 'customer';
        }

        return User::create($data);
    }

    /**
     * Update a user.
     */
    public function updateUser(string $id, array $data): User
    {
        $user = User::findOrFail($id);

        // Hash password if provided
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return $user->fresh();
    }

    /**
     * Delete a user.
     */
    public function deleteUser(string $id): bool
    {
        $user = User::findOrFail($id);
        
        // Check if user has orders
        if ($user->orders()->count() > 0) {
            throw new \Exception('Cannot delete user that has orders');
        }

        // Check if user has cart items
        if ($user->cart && $user->cart->items()->count() > 0) {
            throw new \Exception('Cannot delete user that has cart items');
        }

        return $user->delete();
    }

    /**
     * Get users by role.
     */
    public function getUsersByRole(string $role): \Illuminate\Database\Eloquent\Collection
    {
        return User::where('role', $role)->orderBy('name')->get();
    }

    /**
     * Get admin users.
     */
    public function getAdminUsers(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->getUsersByRole('admin');
    }

    /**
     * Get customer users.
     */
    public function getCustomerUsers(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->getUsersByRole('customer');
    }
}
