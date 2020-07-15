<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'user-create', 'user-delete', 'user-update',
            'post-create', 'post-delete', 'post-update',
            'category-create', 'category-delete', 'category-update',
        ];

        foreach ($permissions as $key => $permission) {
            Permission::Create([
                'name' => $permission
            ]);
        }
    }
}
