<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    private $roles = [
        [
            'name' => 'admin',
            'permissions' => [
                'checks.list',
                'checks.accept',
            ],
        ],
        [
            'name' => 'customer',
            'permissions' => [
                'balance.view',
                'purchase.view',
                'purchase.create',
                'checks.view',
                'checks.create',
            ],
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->roles as $role) {
            $roleModel = Role::create(['name' => $role['name']]);

            foreach ($role["permissions"] as $permission) {
                $roleModel->givePermissionTo($permission);
            }
        }
    }
}
