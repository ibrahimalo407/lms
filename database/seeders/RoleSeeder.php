<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            // ['id' => 1, 'title' => 'Administrator (can create other users)',],
            // ['id' => 2, 'title' => 'Teacher',],
            // ['id' => 3, 'title' => 'Student',],

            // $permissions = Permission::all();
            // $adminRole->permissions()->sync($permissions->pluck('id'));
        ];

        foreach($items as $item){
            Role::create($item);
        }

         // Assign permissions to roles
         $adminRole = Role::find(1);
         $teacherRole = Role::find(2);
 
         $permissions = Permission::all();
         $adminRole->permissions()->sync($permissions->pluck('id'));
 
         $teacherPermissions = Permission::whereIn('title', [
             'pedagogical_path_access',
             'pedagogical_path_create',
             'pedagogical_path_edit',
             'pedagogical_path_view',
             'pedagogical_path_delete'
         ])->get();
         $teacherRole->permissions()->sync($teacherPermissions->pluck('id'));
    }
}
