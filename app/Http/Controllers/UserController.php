<?php

namespace App\Http\Controllers;

use App\User;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$user = User::paginate(10);

        $user = DB::table('users as u')
                ->select('u.id', 'u.name', 'u.email',  'u.adress', 'u.phone', 'r.name as rol', 'i.user_id as invoice')
                ->leftJoin('invoices as i', 'u.id', '=', 'i.user_id')
                ->leftJoin('model_has_roles as m', 'm.model_id', '=', 'u.id')
                ->leftJoin('roles as r', 'r.id', 'm.role_id')
                ->groupBy('u.id')
                ->get();
        $role = Role::all();

        return view('Admin.user.index', compact('user', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::all();

        return view('Admin.user.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name'     => ucwords($request['name']),
            'email'    => ucfirst($request['email']),
            'adress'   => $request['adress'],
            'phone'    => $request['phone'], 
            'password' => Hash::make($request['password'])
        ]);
        
        //return $user;

        $user->syncRoles($request->role);
   
        $user->save();

        return redirect()->action('UserController@index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $role = Role::all();
       
        return view('Admin.user.edit', compact('user', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name     = $request->name;
        $user->adress   = $request->adress;
        $user->phone    = $request->phone;

        if($request->password) {
            $user->password = Hash::make($request->password); 
        }

        $user->syncRoles($request->role);
        $user->save();

        return redirect()->action('UserController@index');
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        $user->delete();
        
        return redirect()->action('UserController@index')->with('eliminar', 'ok');
    }

    public function role_user($id){
        
        /*$info = DB::select('SELECT mhr.role_id
                            FROM users as u
                            INNER JOIN model_has_roles as mhr on u.id = mhr.model_id
                            WHERE u.id = ? ', [$id]
        );*/
        
        $info = DB::table('users as u')
        ->select('m.role_id')
        ->join('model_has_roles as m', 'm.model_id', '=', 'u.id')
        ->where('u.id', '=', $id)
        ->get();
        return $info;
    }
}
