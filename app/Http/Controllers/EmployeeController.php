<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Position;
use Illuminate\Http\Request;
use App\User;
//Importing laravel-permission models
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    /**
     * EmployeeController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth',]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::latest()->paginate(15);
        return view('employees.index',compact('employees'));
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

        $positions = $request['positions'];

        if(isset($positions)){
            $employee->positions()->attach($positions);
        }

        if(request()->createUser){

            $this->validate($request, [
                'email'=>'required|email|unique:users',
                'password'=>'required|min:6|confirmed'
            ]);

            $user = User::create([
                'name'=>request()->name,
                'email'=>request()->email,
                'password'=>request()->password
            ]);

            $permissions = $request['permissions'];

            if($permissions!=null){

                $p_all = Permission::all();//Get all permissions

                foreach ($p_all as $p) {
                    $user->revokePermissionTo($p); //Remove all permissions associated with role
                }

                foreach ($permissions as $permission) {
                    $p = Permission::where('id', '=', $permission)->firstOrFail(); //Get corresponding form //permission in db
                    $user->givePermissionTo($p);  //Assign permission to role
                }
            }
            $user->assignRole('staff');
            $user->employee()->save($employee);

        }

        //Redirect to the users.index view and display message
        return redirect()->route('users.index')
            ->with('flash_message',
                'User successfully added.');


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
    public function edit($id)
    {


        $employee = Employee::findOrFail($id);
        
        return view('employees.edit', compact('employee', 'user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
          $employee = Employee::findOrFail($request['employee.id']);
          $hasAccount = $request['hasAccount'];

          if($hasAccount){
              $permissions = $request['permissions'];
              $user = null;

              if($employee->user_id!=null){
                  $user = User::findOrFail($employee->user_id);
                  $user->fill($request['user']);
                  $user->save();
              }else{
                  $user = User::create([
                      'name'=>$request['employee.name'],
                      'email'=>$request['user.email'],
                      'password'=>$request['user.email']
                  ]);
              }

              $p_all = Permission::all();//Get all permissions
              foreach ($p_all as $p) {
                  $user->revokePermissionTo($p); //Remove all permissions associated with user
              }
              foreach ($permissions as $permission) {
                  $p = Permission::where('id', '=', $permission)->firstOrFail(); //Get corresponding form //permission in db
                  $user->givePermissionTo($p);  //Assign permission to user
              }
              
              $employee->fill($request['employee']);
              $employee->save();
              $user->save();
              $user->employee()->save($employee);

          }else{
              $employee->fill($request['employee']);
              if($employee->user_id!=null){
                  $user = User::findOrFail($employee->user_id);
                  $employee->user_id = null;
                  $user->delete();
              }
              $employee->save();
          }


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
