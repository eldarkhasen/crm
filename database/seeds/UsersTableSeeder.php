<?php

use App\CashBox;
use App\PaymentItem;
use App\PaymentType;
use App\Position;
use App\Service;
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
        PaymentItem::create(['name'=>'Снятие с депозита','payment_type_id'=>'2']);
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
        CashBox::create(['name'=>'Основная касса','initial_balance'=>'0']);
        Service::create(['name'=>'Консультация','description'=>'Консультация (осмотр и прием пациента без лечения)','duration'=>'30','category'=>'Общие виды работ','price'=>'500','max_price'=>'1000']);
        Service::create(['name'=>'Анестезия инфильтрационная','description'=>'Анестезия инфильтрационная','duration'=>'30','category'=>'Общие виды работ','price'=>'1000','max_price'=>'2000']);
        Service::create(['name'=>'Анестезия проводниковая','description'=>'Анестезия проводниковая','duration'=>'30','category'=>'Общие виды работ','price'=>'1000','max_price'=>'2000']);
        Service::create(['name'=>'Прицельный рентген-снимок зуба','description'=>'Прицельный рентген-снимок зуба','duration'=>'30','category'=>'Общие виды работ','price'=>'1000','max_price'=>'2000']);
        Service::create(['name'=>'Профессиональная чистка зубов','description'=>'Профессиональная чистка зубов (в зависимости от сложности) профилактическое покрытие','duration'=>'30','category'=>'Профилактика заболеваний полости рта','price'=>'9000','max_price'=>'12000']);
        Service::create(['name'=>'Фторирование зуба','description'=>'Фторирование зуба (-ов) в зависимости от количества','duration'=>'30','category'=>'Профилактика заболеваний полости рта','price'=>'1000','max_price'=>'3500']);
        Service::create(['name'=>'Иньекции Линкомицина','description'=>'Иньекции Линкомицина','duration'=>'30','category'=>'Профилактика заболеваний полости рта','price'=>'1200','max_price'=>'1200']);
        Service::create(['name'=>'Процедура Plasmolifting','description'=>'Процедура Plasmolifting (забор крови+центрифугирование+иньекции)','duration'=>'30','category'=>'Профилактика заболеваний полости рта','price'=>'15000','max_price'=>'15000']);
        Service::create(['name'=>'Фототерапия (курс 5 дней)','description'=>'Фототерапия (курс 5 дней)','duration'=>'30','category'=>'Профилактика заболеваний полости рта','price'=>'3000','max_price'=>'3000']);
        Service::create(['name'=>'Лечение среднего кариеса (пломба хим. отверждения)','description'=>'Лечение среднего кариеса (пломба химического отверждения)','duration'=>'30','category'=>'Терапевтическая стоматология','price'=>'3500','max_price'=>'3500']);
        Service::create(['name'=>'Лечение среднего кариеса (пломба свет. отверждения)','description'=>'Лечение среднего кариеса (пломба светового отверждения)','duration'=>'30','category'=>'Терапевтическая стоматология','price'=>'4500','max_price'=>'4500']);
        Service::create(['name'=>'Лечение глубокого кариеса (пломба хим. отверждения)','description'=>'Лечение глубокого кариеса (пломба химического отверждения)','duration'=>'30','category'=>'Терапевтическая стоматология','price'=>'4000','max_price'=>'4000']);
        Service::create(['name'=>'Лечение глубокого кариеса (пломба свет. отверждения)','description'=>'Лечение глубокого кариеса (пломба светового отверждения)','duration'=>'30','category'=>'Терапевтическая стоматология','price'=>'5000','max_price'=>'5000']);
        Service::create(['name'=>'Лечение глубокого кариеса (пломба хим. отверждения)','description'=>'Лечение глубокого кариеса (пломба химического отверждения)','duration'=>'30','category'=>'Терапевтическая стоматология','price'=>'4000','max_price'=>'4000']);
        Service::create(['name'=>'Аппаратное лечение каналов','description'=>'Аппаратное лечение каналов','duration'=>'30','category'=>'Терапевтическая стоматология','price'=>'15000','max_price'=>'15000']);
        Service::create(['name'=>'Лечение пульпита МТА','description'=>'Лечение пульпита МТА','duration'=>'30','category'=>'Терапевтическая стоматология','price'=>'7000','max_price'=>'7000']);
        Service::create(['name'=>'Лечение пульпита 1-корневого зуба (пломба хим. отверждения)','description'=>'Лечение пульпита 1-корневого зуба (пломба химического отверждения)','duration'=>'30','category'=>'Терапевтическая стоматология','price'=>'5500','max_price'=>'5500']);
        Service::create(['name'=>'Лечение пульпита 1-корневого зуба (пломба свет. отверждения)','description'=>'Лечение пульпита 1-корневого зуба (пломба светового отверждения)','duration'=>'30','category'=>'Терапевтическая стоматология','price'=>'6500','max_price'=>'6500']);
        Service::create(['name'=>'Лечение пульпита многокорневого зуба (пломба хим. отверждения)','description'=>'Лечение пульпита многокорневого зуба (пломба химического отверждения)','duration'=>'30','category'=>'Терапевтическая стоматология','price'=>'7000','max_price'=>'7000']);
        Service::create(['name'=>'Лечение пульпита многокорневого зуба (пломба свет. отверждения)','description'=>'Лечение пульпита многокорневого зуба (пломба светового отверждения)','duration'=>'30','category'=>'Терапевтическая стоматология','price'=>'8000','max_price'=>'8000']);

        Service::create(['name'=>'Лечение периодонтита 1-корневого зуба (пломба хим. отверждения)','description'=>'Лечение пульпита 1-корневого зуба (пломба химического отверждения)','duration'=>'30','category'=>'Терапевтическая стоматология','price'=>'6500','max_price'=>'6500']);
        Service::create(['name'=>'Лечение периодонтита 1-корневого зуба (пломба свет. отверждения)','description'=>'Лечение пульпита 1-корневого зуба (пломба светового отверждения)','duration'=>'30','category'=>'Терапевтическая стоматология','price'=>'7000','max_price'=>'7000']);
        Service::create(['name'=>'Лечение периодонтита многокорневого зуба (пломба хим. отверждения)','description'=>'Лечение пульпита многокорневого зуба (пломба химического отверждения)','duration'=>'30','category'=>'Терапевтическая стоматология','price'=>'8000','max_price'=>'8000']);
        Service::create(['name'=>'Лечение периодонтита многокорневого зуба (пломба свет. отверждения)','description'=>'Лечение пульпита многокорневого зуба (пломба светового отверждения)','duration'=>'30','category'=>'Терапевтическая стоматология','price'=>'9000','max_price'=>'9000']);

        Service::create(['name'=>'Анкерный штиф','description'=>'Анкерный штиф','duration'=>'30','category'=>'Терапевтическая стоматология','price'=>'1000','max_price'=>'1000']);
        Service::create(['name'=>'Стекловолоконный штифт','description'=>'Стекловолоконный штифт','duration'=>'30','category'=>'Терапевтическая стоматология','price'=>'1500','max_price'=>'1500']);
        Service::create(['name'=>'Худож. реставрация зубов','description'=>'Художественная реставрация зубов в зависимости от сложности','duration'=>'30','category'=>'Эстетическая стоматология','price'=>'8000','max_price'=>'12000']);
        Service::create(['name'=>'Адгезивный мостик','description'=>'Адгезивный мостик','duration'=>'30','category'=>'Эстетическая стоматология','price'=>'10000','max_price'=>'10000']);
        Service::create(['name'=>'Отбеливание зубов профессиональное','description'=>'Отбеливание зубов профессиональное','duration'=>'30','category'=>'Эстетическая стоматология','price'=>'30000','max_price'=>'30000']);
        Service::create(['name'=>'Внутрипульпарное отбеливание (эндоотбеливание)','description'=>'Внутрипульпарное отбеливание (эндоотбеливание)','duration'=>'30','category'=>'Эстетическая стоматология','price'=>'3000','max_price'=>'3000']);
        Service::create(['name'=>'Стальная коронка','description'=>'Стальная коронка','duration'=>'30','category'=>'Ортопедические стоматологические услуги','price'=>'4000','max_price'=>'4000']);
        Service::create(['name'=>'Литой зуб','description'=>'Литой зуб','duration'=>'30','category'=>'Ортопедические стоматологические услуги','price'=>'4000','max_price'=>'4000']);
        Service::create(['name'=>'Фасетка','description'=>'Фасетка','duration'=>'30','category'=>'Ортопедические стоматологические услуги','price'=>'7000','max_price'=>'7000']);
        Service::create(['name'=>'Пластмассовая коронка','description'=>'Пластмассовая коронка','duration'=>'30','category'=>'Ортопедические стоматологические услуги','price'=>'7000','max_price'=>'7000']);
        Service::create(['name'=>'Комбинированная коронка','description'=>'Комбинированная коронка','duration'=>'30','category'=>'Ортопедические стоматологические услуги','price'=>'7000','max_price'=>'7000']);
        Service::create(['name'=>'Металлокерамическая коронка','description'=>'Металлокерамическая коронка','duration'=>'30','category'=>'Ортопедические стоматологические услуги','price'=>'14000','max_price'=>'14000']);
        Service::create(['name'=>'Коронка с плазменным покрытием','description'=>'Коронка с плазменным покрытием','duration'=>'30','category'=>'Ортопедические стоматологические услуги','price'=>'8500','max_price'=>'8500']);
        Service::create(['name'=>'Штифтовый зуб','description'=>'Штифтовый зуб','duration'=>'30','category'=>'Ортопедические стоматологические услуги','price'=>'7000','max_price'=>'7000']);
        Service::create(['name'=>'Культевая вкладка','description'=>'Культевая вкладка','duration'=>'30','category'=>'Ортопедические стоматологические услуги','price'=>'5000','max_price'=>'5000']);
        Service::create(['name'=>'Пайка','description'=>'Пайка','duration'=>'30','category'=>'Ортопедические стоматологические услуги','price'=>'500','max_price'=>'500']);
        Service::create(['name'=>'Снятие слепка на 1-2 коронки Альгинатными массами','description'=>'Снятие слепка на 1-2 коронки Альгинатными массами','duration'=>'30','category'=>'Ортопедические стоматологические услуги','price'=>'500','max_price'=>'500']);
        Service::create(['name'=>'Реставрация фасетки','description'=>'Реставрация фасетки','duration'=>'30','category'=>'Ортопедические стоматологические услуги','price'=>'3000','max_price'=>'3000']);
        Service::create(['name'=>'Снятие двойного оттиска','description'=>'Снятие двойного оттиска','duration'=>'30','category'=>'Ортопедические стоматологические услуги','price'=>'1200','max_price'=>'1200']);
        Service::create(['name'=>'Снятие слепка с изготовлением диагностической модели','description'=>'Снятие слепка с изготовлением диагностической модели','duration'=>'30','category'=>'Ортопедические стоматологические услуги','price'=>'1500','max_price'=>'1500']);
        Service::create(['name'=>'Цельнолитая коронка зуба','description'=>'Цельнолитая коронка зуба','duration'=>'30','category'=>'Ортопедические стоматологические услуги','price'=>'6000','max_price'=>'6000']);
        Service::create(['name'=>'Фиксация коронки на цемент','description'=>'Фиксация коронки на цемент','duration'=>'30','category'=>'Ортопедические стоматологические услуги','price'=>'500','max_price'=>'500']);
        Service::create(['name'=>'Фиксация металлокерамической коронки','description'=>'Фиксация металлокерамической коронки','duration'=>'30','category'=>'Ортопедические стоматологические услуги','price'=>'800','max_price'=>'800']);
        Service::create(['name'=>'Индивид. литье','description'=>'Индивидуальное литье','duration'=>'30','category'=>'Ортопедические стоматологические услуги','price'=>'500','max_price'=>'500']);
        Service::create(['name'=>'Индивид. литье металлокерамика','description'=>'Индивидуальное литье металлокерамика','duration'=>'30','category'=>'Ортопедические стоматологические услуги','price'=>'1200','max_price'=>'1200']);
        Service::create(['name'=>'Снятие коронки','description'=>'Снятие коронки','duration'=>'30','category'=>'Ортопедические стоматологические услуги','price'=>'500','max_price'=>'500']);

        Service::create(['name'=>'Полный съемный протез','description'=>'Полный съемный протез','duration'=>'30','category'=>'Съемное протезирование','price'=>'23000','max_price'=>'25000']);
        Service::create(['name'=>'Частичный съемный протез','description'=>'Частичный съемный протез','duration'=>'30','category'=>'Съемное протезирование','price'=>'23000','max_price'=>'23000']);
        Service::create(['name'=>'Микропротез','description'=>'Микропротез','duration'=>'30','category'=>'Съемное протезирование','price'=>'7000','max_price'=>'7000']);
        Service::create(['name'=>'Перебазировка','description'=>'Перебазировка','duration'=>'30','category'=>'Съемное протезирование','price'=>'6000','max_price'=>'6000']);
        Service::create(['name'=>'Починка базиса протеза','description'=>'Починка базиса протеза','duration'=>'30','category'=>'Съемное протезирование','price'=>'2000','max_price'=>'2000']);
        Service::create(['name'=>'Приварка 1 зуба на протез','description'=>'Приварка 1 зуба на протез','duration'=>'30','category'=>'Съемное протезирование','price'=>'2000','max_price'=>'2000']);
        Service::create(['name'=>'Приварка одного кламмера на протез','description'=>'Приварка одного кламмера на протез','duration'=>'30','category'=>'Съемное протезирование','price'=>'1500','max_price'=>'1500']);
        Service::create(['name'=>'Бюгельный протез','description'=>'Бюгельный протез','duration'=>'30','category'=>'Съемное протезирование','price'=>'36000','max_price'=>'36000']);
        Service::create(['name'=>'Индивидуальная ложка','description'=>'Индивидуальная ложка','duration'=>'30','category'=>'Съемное протезирование','price'=>'1200','max_price'=>'1200']);
        Service::create(['name'=>'Армирование протеза','description'=>'Армирование протеза','duration'=>'30','category'=>'Съемное протезирование','price'=>'5000','max_price'=>'5000']);
        Service::create(['name'=>'Каппа для исправления прикуса','description'=>'Каппа для исправления прикуса','duration'=>'30','category'=>'Съемное протезирование','price'=>'8000','max_price'=>'8000']);
        Service::create(['name'=>'Пластина для исправления прикуса','description'=>'Пластина для исправления прикуса','duration'=>'30','category'=>'Съемное протезирование','price'=>'166000','max_price'=>'166000']);
        Service::create(['name'=>'Кламмер на частичный съемный протез','description'=>'Кламмер на частичный съемный протез','duration'=>'30','category'=>'Съемное протезирование','price'=>'1000','max_price'=>'1000']);
        Service::create(['name'=>'Цельнолитой кламмер','description'=>'Цельнолитой кламмер','duration'=>'30','category'=>'Съемное протезирование','price'=>'2000','max_price'=>'2000']);
        Service::create(['name'=>'Безметалловый бюгельный протез','description'=>'Безметалловый бюгельный протез','duration'=>'30','category'=>'Съемное протезирование','price'=>'60000','max_price'=>'60000']);
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
