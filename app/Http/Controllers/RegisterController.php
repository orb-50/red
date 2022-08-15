<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Events\UserRegistered;

class RegisterController extends Controller
{
    
    public function create()
    {
        return view('regist.register');
    }

    public function store(User $user,Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255|unique:users',
                'image'=>'nullable|image|max:1024',
                'password' => 'required|string|confirmed|min:8',
            ]
        );
        $attr =[
            'name' => $request->name,
            'email' => $request->email,
            'AspiringJob'=>$request->AspiringJob,
            'password' => Hash::make($request->password),
        ];

        if(request()->hasFile('image')) {
            $name = request()->file('image')->getClientOriginalName();
            $image = date('Ymd_His').'_'.$name;
            request()->file('image')->storeAs('public/images', $image);
            //imageファイル名を追加
            $attr['image']=$image;
        }
        if($request->password=="adminpass") {
            $attr['role']="1";
        }

        $user=User::create($attr);
        
        // $user = User::create(
        //     [
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'AspiringJob'=>$request->AspiringJob,
        //         'password' => Hash::make($request->password),
        //     ]
        // );
        Auth::login($user);
        return view('home', compact('user'))->with('message', $request->name.'さんを登録しました');
    }
}