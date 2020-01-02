<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UsersController extends Controller
{
    //
    public function __construct()
    {
        # code...
        $this->middleware('auth',[
            'except' => ['show','create','store']
        ]);

        $this->middleware('guest',[
            'only' => ['create']
        ]);
    }

    public function create()
    {
        # code...
        return view('users.create');
    }

    public function show(User $user)
    {
        # code...
        return view('users.show',compact('user'));
    }

    public function store(Request $request)
    {
        # code...
        $this->validate($request,[
            'name'=>'required|max:50',
            'email'=>'required|email|unique:users|max:255',
            'password'=>'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);

        Auth::login($user);
        session()->flash('success','欢迎，您将这里开启一段新的旅程~');
        return redirect()->route('users.show',[$user]);
    }

    public function destroy()
    {
        # code...
        Auth::logout();
        session()->flash('success','您已成功退出!');
        return redirect ('login');
    }

    public function edit(User $user)
    {
        # code...
        $this->authorize('update',$user);
        return view('users.edit',compact('user'));
    }

    public function update(User $user,Request $request)
        {
            # code...
            $this->authorize('update',$user);
            $this->validate($request,[
                'name'=>'required|max:50',
                'password'=>'nullable|confirmed|min:6',
            ]);

            $data = [];
            $data['name'] = $request->name;
            if ($request->password){
                $data['password'] = $request->password;
            }
            $user->update($data);

            session()->flash('success','个人资料更新成功!');
            return redirect()->route('users.show',$user->id);

        }

}
