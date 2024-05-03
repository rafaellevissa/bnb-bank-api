<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    private $permissions = [
        [
            'name' => 'transactions.view',
        ],
        [
            'name' => 'purchase.view',
        ],
        [
            'name' => 'purchase.create',
        ],
        [
            'name' => 'checks.view',
        ],
        [
            'name' => 'checks.create',
        ],
        [
            'name' => 'checks.list',
        ],
        [
            'name' => 'checks.update',
        ],
        [
            'name' => 'users.update',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->permissions as $permission) {
            Permission::create($permission);
        }
    }
}
