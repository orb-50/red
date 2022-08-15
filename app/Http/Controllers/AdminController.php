<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Comment;
use App\Models\ticket;
use App\Models\Category;

class AdminController extends Controller
{
    public function edit(User $user,$id){
        Gate::authorize('administrator',Auth::user());
        $user=User::where("id",$id)->first();
        return view("adminedit",compact("user"));
    }

    public function update(Request $request,$id){
        Gate::authorize('administrator',Auth::user());
        $user=User::where("id",$id)->first();
        // $request->validate(
        //     [
        //         'name' => 'required|string|max:255',
        //         'email' => ['required','string','max:255',Rule::unique('users')->ignore($user->id)],
        //         'password' => 'required|string|confirmed|min:8',
        //         'role' => 'required'
        //     ]
        // );

        // $user->name=$request->name;
        // $user->AspiringJob=$request->AspiringJob;
        // $user->email=$request->email;
        // $user->role=$request->role;
        // $user->password=Hash::make($request->password);
        // $user->save();
        $validated = $request->validate([
            'name' => 'required',
            'AspiringJob'=>'required',
            'email' => ['required','string','max:255',Rule::unique('users')->ignore($user->id)],
            'image'=>'nullable|image|max:1024',
            'password' => 'nullable|min:8|confirmed',
            'role' => 'required'
        ]);
        $param=[
            "name"=>$validated["name"],
            "AspiringJob"=>$validated["AspiringJob"],
            "email"=>$validated["email"],
            "role"=>$validated["role"]
        ];
        if($validated["password"]!=null){
            $param['password']=Hash::make($validated["password"]);
        }
        // 更新する前に一回取得
        
        if(request()->hasFile('image')) {
            if($user->image!="user_default.jpg"){
                $oldimage='public/images/'.$user->image;
                Storage::delete($oldimage);
            }
            $name = request()->file('image')->getClientOriginalName();
            $image = date('Ymd_His').'_'.$name;
            request()->file('image')->storeAs('public/images', $image);
            //imageファイル名を追加
            $param['image']=$image;
        }
        $up=User::where("id",$id)->update($param);
        // 更新後にもう一回取得
        $user=User::where("id",$id)->first();
        return redirect()->route('usermanagement');
    }

    public function delete($id){
        $user=User::where("id",$id)->first();
        DB::transaction(function ()use($user) {
            $user->delete();
            ticket::where("user_id",$user->id)->delete();
            Comment::where("user_id",$user->id)->delete();
        });
        return redirect()->route('userlist');
    }

    public function category(User $user){
        Gate::authorize('administrator',Auth::user());
        $categories=Category::all();
        return view("category",compact("categories"));
    }
}
