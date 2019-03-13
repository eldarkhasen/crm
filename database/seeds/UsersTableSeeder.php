<?php

use Illuminate\Database\Seeder;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'admin', 'alias'=>'Admin']);
        Permission::create(['name' => 'employees', 'alias'=>'Сотрудники']);
        Permission::create(['name' => 'positions','alias'=>'Должности']);
        Permission::create(['name' => 'finance','alias'=>'Финансы']);
        Permission::create(['name' => 'schedule','alias'=>'График']);
        Permission::create(['name' => 'permissions','alias'=>'Доступы']);
        Permission::create(['name' => 'patients','alias'=>'Пациенты']);
        Permission::create(['name' => 'services','alias'=>'Услуги']);

//        $role = factory(Role::class,'role',1)->create();
//        $permission_users = factory(Permission::class,'permission_users',1)->create();
//        $permission_roles = factory(Permission::class,'permission_roles',1)->create();

        $role = Role::create(['name'=>'admin']);

        $role->givePermissionTo(Permission::all());
        Role::create(['name' => 'staff']);

        $admin = User::create(['name'=>'admin','email'=>'admin@crm.com','password'=>'123456']);
        $admin->assignRole($role);


    }
}
