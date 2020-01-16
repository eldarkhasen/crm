<?php

use App\PaymentItem;
use App\PaymentType;
use App\Position;
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
        Permission::create(['name' => 'materials','alias'=>'Материалы']);
        PaymentType::create(['name'=>'Доход']);
        PaymentType::create(['name'=>'Расход']);

        PaymentItem::create(['name'=>'Перевод из кассы','payment_type_id'=>'2']);
        PaymentItem::create(['name'=>'Перевод в кассу','payment_type_id'=>'1']);
        PaymentItem::create(['name'=>'Снятие с депозите','payment_type_id'=>'2']);
        PaymentItem::create(['name'=>'Начисление в депозит','payment_type_id'=>'1']);
        PaymentItem::create(['name'=>'Возврат средств','payment_type_id'=>'2']);
        PaymentItem::create(['name'=>'Оказание услуг','payment_type_id'=>'1']);
        PaymentItem::create(['name'=>'Погашение долга','payment_type_id'=>'1']);
        PaymentItem::create(['name'=>'Закупка товаров','payment_type_id'=>'2']);
        PaymentItem::create(['name'=>'Зарплата персонала','payment_type_id'=>'2']);
        PaymentItem::create(['name'=>'Прочие доходы','payment_type_id'=>'1']);
        PaymentItem::create(['name'=>'Прочие расходы','payment_type_id'=>'2']);
        Position::create(['name'=>'Врач-терапевт','description'=>'Просто лечит людей']);
        Position::create(['name'=>'Хирург','description'=>'Умеет делать операции']);
        Position::create(['name'=>'Администратор','description'=>'Следит за порядком в клинике']);
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
