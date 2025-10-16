<?php

namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserServiceInterface
{
    /**
     * Get all users with pagination.
     */
    public function getAllUsers(int $perPage = 15, ?string $role = null): LengthAwarePaginator;

    /**
     * Get user by ID.
     */
    public function getUserById(string $id): ?User;

    /**
     * Get user by email.
     */
    public function getUserByEmail(string $email): ?User;

    /**
     * Create a new user.
     */
    public function createUser(array $data): User;

    /**
     * Update a user.
     */
    public function updateUser(string $id, array $data): User;

    /**
     * Delete a user.
     */
    public function deleteUser(string $id): bool;

    /**
     * Get users by role.
     */
    public function getUsersByRole(string $role): \Illuminate\Database\Eloquent\Collection;

    /**
     * Get admin users.
     */
    public function getAdminUsers(): \Illuminate\Database\Eloquent\Collection;

    /**
     * Get customer users.
     */
    public function getCustomerUsers(): \Illuminate\Database\Eloquent\Collection;
}
