<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    public function useredit(Request $request,$id){
        Gate::authorize('edit',$id);
        $user=User::where("id",$id)->first();
        return view('useredit', compact('user'));
    }

    public function usereditupdate(Request $request,$id){
        Gate::authorize('edit',$id);
        $user=User::where("id",$id)->first();
        $validated = $request->validate([
            'name' => 'required',
            'AspiringJob'=>'required',
            'email' => ['required','string','max:255',Rule::unique('users')->ignore($user->id)],
            'image'=>'nullable|image|max:1024',
            'password' => 'nullable|min:8|confirmed',
        ]);
        $param=[
            "name"=>$validated["name"],
            "AspiringJob"=>$validated["AspiringJob"],
            "email"=>$validated["email"],
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
        return view('useredit', compact('user'));
    }
    public function userlist(Request $request){
        $users=User::get();
        $user3=[];
        $user2=[];
        $user1=[];
        foreach($users as $user){
            if ($user->role==3){
                array_push($user3,$user);
            }
            else if ($user->role==2) {
                array_push($user2,$user);
            }
            else if ($user->role==1) {
                array_push($user1,$user);
            }
        };
        return view('userlist', compact('user1','user2','user3'));
    }

    public function userlistticket(Request $request,$id){

        if (Gate::allows('user',$request)){
            $ticket=Ticket::where("user_id",$id)->where("open","1")->get();
            
        }

        else if (Gate::allows('stuff',$request)){
            $ticket=Ticket::where("open","1")->where("open","2")->where("user_id",$id)->get();
        }

        else if (Gate::allows('administrator',$request)){
            $ticket=Ticket::where("user_id",$id)->get();
        }
        $tickets = new LengthAwarePaginator(
            $ticket->forPage($request->page, 7), // 現在のページのsliceした情報(現在のページ, 1ページあたりの件数)
            $ticket->count(), // 総件数
            7,
            null, // 現在のページ(ページャーの色がActiveになる)
            ['path' => $request->url()] // ページャーのリンクをOptionのpathで指定
            );
        $categories=Category::all();
        return view('userlistticket',compact("tickets","categories"));
    }

    public function usermanagement(){
        $users=User::get();
        $user3=[];
        $user2=[];
        $user1=[];
        foreach($users as $user){
            if ($user->role==3){
                array_push($user3,$user);
            }
            else if ($user->role==2) {
                array_push($user2,$user);
            }
            else if ($user->role==1) {
                array_push($user1,$user);
            }
        };
        return view('usermanagement',compact('user1','user2','user3'));
    }
}
