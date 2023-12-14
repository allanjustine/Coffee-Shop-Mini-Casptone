<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminPermission = Permission::create(['name' => 'manage-all']);

        $adminCreate = Permission::create(['name' => 'admin-create']);
        $adminEdit = Permission::create(['name' => 'admin-edit']);
        $adminView = Permission::create(['name' => 'admin-view']);
        $adminDelete = Permission::create(['name' => 'admin-delete']);
        $adminIndex = Permission::create(['name' => 'admin-index']);

        $adminPermission->givePermissionTo(
            [
                $adminCreate, $adminEdit, $adminView, $adminDelete, $adminIndex
            ]
        );

        $userPermission = Permission::create(['name' => 'customer']);

        $userCreate = Permission::create(['name' => 'customer-create']);
        $userEdit = Permission::create(['name' => 'customer-edit']);
        $userView = Permission::create(['name' => 'customer-view']);
        $userDelete = Permission::create(['name' => 'customer-delete']);
        $userIndex = Permission::create(['name' => 'customer-index']);

        $userPermission->givePermissionTo(
            [
                $userCreate, $userEdit, $userView, $userDelete, $userIndex
            ]
        );

    }
}
