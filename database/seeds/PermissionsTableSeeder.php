<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
      $keys = [
            'browse_admin',
            'browse_database',
            'browse_media',
            'browse_compass',
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key'        => $key,
                'table_name' => null,
            ]);
        }

        Permission::generateFor('menus');

        Permission::generateFor('pages');

        Permission::generateFor('roles');

        Permission::generateFor('users');

        Permission::generateFor('posts');

        Permission::generateFor('categories');

        Permission::generateFor('settings');

        $role = Role::where('name', 'admin')->firstOrFail();

        $permissions = Permission::all();
        $permissionsFiltered = $permissions->filter(function ($permission, $key) {
            return !in_array($permission->key, [
                'browse_database',
                'browse_media',
                'browse_compass',
                'delete_menus',
                'delete_pages',
                'browse_roles',
                'read_roles',
                'edit_roles',
                'add_roles',
                'delete_roles',
                'browse_users',
                'edit_users',
                'add_users',
                'delete_users',
                'delete_posts',
                'delete_categories',
                'delete_settings',
                'delete_products',
                'delete_products',
                'delete_coupons',
                'delete_category',
                'delete_category-product',
            ]);
        });

        $role->permissions()->sync(
            $permissionsFiltered->pluck('id')->all()
        );
    }
}