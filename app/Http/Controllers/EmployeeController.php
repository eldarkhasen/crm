<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use App\User;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    /**
     * EmployeeController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth','isAdmin','hasPerToEmp']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gender=[
            '1' => 'Не указано',
            '2' => 'Мужской',
            '3' => 'Женский'
        ];

        $user = new User();

        if(request()->createUser){
            $this->validate($request, [
                'name'=>'required|max:120',
                'email'=>'required|email|unique:users',
                'password'=>'required|min:6|confirmed'
            ]);
            $user = User::create([
                'name'=>request()->name,
                'email'=>request()->email,
                'password'=>\request()->password
            ]);
        }

        $this->validate($request, [
            'name'=>'required|max:120',
            'surname'=>'required|max:120',
            'patronymic'=>'required|max:120',
            'phone'=>'required|',
            'birth_date'=>'required'
        ]);

        $employee = Employee::create([
            'name'=>request()->name,
            'surname'=>request()->surname,
            'patronymic'=>request()->patronymic,
            'phone'=>request()->phone,
            'birth_date'=>request()->birth_date,
            'gender'=> $gender[request()->gender]
        ]);
        $roles = $request['roles'];

        if(isset($roles)){
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $employee->assignRole($role_r); //Assigning role to user
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
